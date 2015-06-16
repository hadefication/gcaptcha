<div id="gcaptcha-<?=$settings->gcaptcha_settings_id?>" class="gcaptcha"></div>
<script type="text/javascript">
  var recaptcha;
  var onloadCallback = function() {
    recaptcha = grecaptcha.render('<?=$settings->gcaptcha_settings_id?>', {
      sitekey: '<?=$settings->site_key?>',
      callback: function(response) {
        // console.log(grecaptcha);

        // console.log(grecaptcha.getResponse(recaptcha));
        /*
        jQuery.post(
          'https://www.google.com/recaptcha/api/siteverify',
          {secret: '', response: response},
          function(data) {
            console.log(data);
          },
          'json'
        );
        */

        jQuery.ajax({
          url: 'https://www.google.com/recaptcha/api/siteverify',
          data: {secret: '6Lcg5gYTAAAAAJK-z1Z4cBz1b674n4wo8kICqOCS', response: response},
          crossDomain: true,
          type: 'POST',
          dataType: 'json',
          success: function(data) {
            console.log(data);
          }
        });
      }
    });
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
