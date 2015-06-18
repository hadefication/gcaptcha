<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gcaptcha_mcp {

  function __construct() {

  }

  /**
   * Module Settings page/form
   */
  function index() {
    ee()->load->helper('form');
    ee()->load->dbforge();

    $gcaptcha_settings = ee()->db->select('*')->from('gcaptcha_settings')->limit(1)->get();

    ee()->view->cp_page_title = lang('gcaptcha_module_page_title');

    $vars['action_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=gcaptcha'.AMP.'method=save';
    $vars['form_hidden'] = NULL;
    $vars['gcaptcha_settings'] = ($gcaptcha_settings->num_rows() > 0) ? $gcaptcha_settings->result_object()[0] : array();

    return ee()->load->view('index', $vars, TRUE);
  }

  /**
   * Save settings
   */
  function save() {
    ee()->load->dbforge();
    ee()->load->library('form_validation');
    ee()->form_validation->set_rules('site_key', 'lang:site_key_required', 'required');
    ee()->form_validation->set_rules('secret_key', 'lang:secret_key_required', 'required');
    $gs = ee()->db->select('*')->from('gcaptcha_settings')->limit(1)->get();
    $gs = ($gs->num_rows() > 0) ? $gs->result_object()[0] : array();

    if(ee()->form_validation->run()==FALSE) {
      ee()->session->set_flashdata('message_error', ee()->form_validation->error_string());
    } else {

      $id = ee()->input->post('gcaptcha_settings_id', TRUE);
      $site_key = ee()->input->post('site_key', TRUE);
      $secret_key = ee()->input->post('secret_key', TRUE);

      if(!empty($id)) {
        ee()->db->update(
          'gcaptcha_settings',
          array(
            'site_key'  => $site_key,
            'secret_key' => $secret_key
          ),
          array(
            'gcaptcha_settings_id' => $id
          )
        );
        if(ee()->db->affected_rows()) {
          ee()->session->set_flashdata('message_success', lang('changes_saved'));
        } else {
          if(!empty($gs) && $gs->site_key === $site_key && $gs->secret_key === $secret_key) {
            ee()->session->set_flashdata('message_success', lang('changes_saved'));
          } else {
            ee()->session->set_flashdata('message_error', lang('save_error').ee()->db->affected_rows());
          }
        }
      } else {
        ee()->db->insert(
          'gcaptcha_settings',
          array(
            'site_key'  => $site_key,
            'secret_key' => $secret_key
          )
        );
        if(ee()->db->insert_id()) {
          ee()->session->set_flashdata('message_success', lang('changes_saved'));
        } else {
          ee()->session->set_flashdata('message_error', lang('save_error'));
        }
      }
    }
    ee()->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=gcaptcha');
  }

}

/* End of file mcp.gcaptcha.php */
/* Location: ./system/expressionengine/third_party/gcaptcha/mcp.gcaptcha.php */
