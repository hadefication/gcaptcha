<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gcaptcha_upd {

  var $version = '1.0';

  function install() {
    ee()->load->dbforge();

    $data = array(
      'module_name' => 'Gcaptcha' ,
      'module_version' => $this->version,
      'has_cp_backend' => 'y',
      'has_publish_fields' => 'n'
    );

    ee()->db->insert('modules', $data);

    $data = array(
      'class'     => 'Gcaptcha' ,
      'method'    => 'site_verify'
    );

    ee()->db->insert('actions', $data);

    $fields = array(
      'gcaptcha_settings_id'   => array('type' => 'int', 'constraint' => '10', 'unsigned' => TRUE, 'auto_increment' => TRUE),
      'site_key' => array('type' => 'varchar', 'constraint' => '250'),
      'secret_key'    => array('type' => 'varchar', 'constraint' => '250')
    );

    ee()->dbforge->add_field($fields);
    ee()->dbforge->add_key('gcaptcha_settings_id', TRUE);

    ee()->dbforge->create_table('gcaptcha_settings');

    return TRUE;
  }

  function uninstall() {
    ee()->load->dbforge();

    ee()->db->select('module_id');
    $query = ee()->db->get_where('modules', array('module_name' => 'Gcaptcha'));

    ee()->db->where('module_id', $query->row('module_id'));
    ee()->db->delete('module_member_groups');

    ee()->db->where('module_name', 'Gcaptcha');
    ee()->db->delete('modules');

    ee()->db->where('class', 'Gcaptcha');
    ee()->db->delete('actions');

    ee()->dbforge->drop_table('gcaptcha_settings');

    return TRUE;
  }


  function update($current = '') {
      return FALSE;
  }

}

/* End of file upd.gcaptcha.php */
/* Location: ./system/expressionengine/third_party/gcaptcha/upd.gcaptcha.php */
