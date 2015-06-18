<div id="<?=$id?>" data-validated="false" class="gcaptcha <?=$class?>"></div>
<script type="text/javascript">
  var recaptcha;
  var onloadCallback = function() {
    recaptcha = grecaptcha.render('<?=$id?>', {
      sitekey: '<?=$settings->site_key?>',
      callback: function(response) {
        jQuery.post('/?ACT=<?=$action_id?>', {response: response, csrf_token: '{csrf_token}'}, function(res) {
          jQuery('#<?=$id?>').attr('data-validated', res.success);
          jQuery('#<?=$id?>').trigger({type: 'validated', success: res.success});
        }, 'json');
      }
    });
  };
  <?php if($disable_form_submission === 'yes'): ?>
  (function($) {
    $('#<?=$id?>').closest('form').on('submit', function(e) {
      if($('#<?=$id?>').attr('data-validated') == 'false') {
        e.preventDefault();
      }
    });
  })(jQuery);
  <?php endif; ?>
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
