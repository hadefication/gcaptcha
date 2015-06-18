<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gcaptcha {

  private $return_data	= '';
  private $google_url = "https://www.google.com/recaptcha/api/siteverify";

  function __construct() {

  }

  function field() {
    $vars = array();
    ee()->load->dbforge();

    $gcaptcha_settings = ee()->db->select('*')->from('gcaptcha_settings')->limit(1)->get();
    $vars['settings'] = ($gcaptcha_settings->num_rows() > 0) ? $gcaptcha_settings->result_object()[0] : array();
    $vars['action_id'] = ee()->functions->fetch_action_id('Gcaptcha', 'site_verify');
    $vars['id'] = ee()->TMPL->fetch_param('id', 'gcaptcha');
    $vars['class'] = ee()->TMPL->fetch_param('class');

    return ee()->load->view('field', $vars, TRUE);
  }

  function site_verify() {
    ee()->load->dbforge();
    $gcaptcha_settings = ee()->db->select('*')->from('gcaptcha_settings')->limit(1)->get();
    $gcaptcha_settings = ($gcaptcha_settings->num_rows() > 0) ? $gcaptcha_settings->result_object()[0] : array();
    $response = ee()->input->post('response', TRUE);
    $url = $this->google_url."?secret=".$gcaptcha_settings->secret_key."&response=".$response;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_TIMEOUT, 15);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    $curl_data = curl_exec($curl);

    curl_close($curl);

    exit($curl_data);
  }
}

/* End of file mod.gcaptcha.php */
/* Location: ./system/expressionengine/third_party/gcaptcha/mod.gcaptcha.php */
