<style>
  form .form-field {
    padding: 0;
    margin: 0 10px 10px 15px;
  }

  form .form-field:last-child {
    margin-bottom: 0;
  }

  form .form-field .note {
    display: block;
    padding: 0;
    margin-top: 2px;
    font-size: 10px;
    font-style: italic;
  }

  form .form-field .required {
    color: red;
    font-style: italic;
  }
</style>

<p>
  To obtain the necessary keys, please visit <a href="http://www.google.com/recaptcha/admin">Google reCaptcha</a> and follow the steps provided.
</p>
<pre>
  <?php print_r($gcaptcha_settings); ?>
</pre>

<?=form_open($action_url, '', $form_hidden)?>

<?php
  if(!empty($gcaptcha_settings)) {
    echo form_hidden('gcaptcha_settings_id', $gcaptcha_settings->gcaptcha_settings_id);
  }
?>

<div class="form-field">
  <label for="site_key">Site Key <span class="required">*</span></label>
  <?=form_input(array(
    'name' => 'site_key',
    'id' => 'site_key',
    'value' => (!empty($gcaptcha_settings)) ? $gcaptcha_settings->site_key : '',
    'maxlength' => '250'
  ))?>
</div>

<div class="form-field">
  <label for="secret_key">Secret Key <span class="required">*</span></label>
  <?=form_input(array(
    'name' => 'secret_key',
    'id' => 'secret_key',
    'value' => (!empty($gcaptcha_settings)) ? $gcaptcha_settings->secret_key : '',
    'maxlength' => '250'
  ))?>
  <p class="note">This key is for communication between your site and Google. Be sure to keep it a secret.</p>
</div>


<div class="tableFooter">
    <div class="tableSubmit">
        <?=form_submit(array('name' => 'submit', 'value' => lang('submit'), 'class' => 'submit'))?>
    </div>
</div>

<?=form_close()?>
