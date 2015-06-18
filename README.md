# GCaptcha

Just another Google reCAPTCHA add-on for custom Expression Engine forms.

## Requirements
1. Expression Engine
2. jQuery
3. [Google reCAPTCHA](https://www.google.com/recaptcha/admin) keys.

## Installation
1. Download the add-on [add-on](https://github.com/hadefication/gcaptcha/archive/master.zip).
2. Extract the contents.
3. Copy/Move contents (gcaptcha folder) to system/expressionengine/third_party.
4. Login to EE CPanel (Add-Ons > Module > Gcaptcha) and install the add-on.

## Setting up the keys
1. Login to EE CPanel and navigate to Add-Ons > Module and click on Gcaptcha module. This will redirect you to the settings page.
2. In the settings page enter the <code>Site Key</code> and <code>Secret Key</code> which can be obtained [here](https://www.google.com/recaptcha/admin)
3. And save changes.

## Showing the reCAPTCHA
Use <code>{exp:gcaptcha:field}</code> tag to show the reCAPTCHA field. Below are the tag params:

- <code>id</code> = the selector id of the field. Defaults to <code>gcaptcha</code>.
- <code>class</code> = class that you want to add to the field element.
- <code>prevent_form_submission</code> = <code>yes/no</code>, defaults to <code>yes</code>. Prevents the form to be submitted if the reCAPTCHA field is not yet validated. Set to <code>no</code> to remove the script.

## How it works
Just add the tag <code>{exp:gcaptcha:field}</code> to your form and you are good to go. The tag will inject a jQuery script that prevents the form to be submitted if the reCAPTCHA field is not yet validated.

The field will also trigger an event whenever the form is validated. Just listen to **validated** event via **id** selector, example:
<pre>
  jQuery('#gcaptcha').on('validated', function(event) {
    // Your awesome code here...
    // event.success - true/false, reCAPTCHA validation response from google
  });
</pre>

The field also has an attribute named **data-validated** where it is false by default and will change to true once the field is validated.
