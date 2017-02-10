<?php
Class Tccs_model extends CI_Model
{
function getInbox()
{
  $this->db->select('ID,ReceivingDateTime,SMSCNumber,SenderNumber,TextDecoded,UDH');
  $this->db->from('inbox');
  $this->db->order_by('ID','desc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function callInboxWithUDH($UDH)
{
  $this->db->select('ID,ReceivingDateTime,SMSCNumber,SenderNumber,TextDecoded,UDH');
  $this->db->from('inbox');
  $this->db->where('UDH',$UDH);
  $this->db->limit(1);
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function callOutboxWithUDH($UDH)
{
  $this->db->select('ID,SendingDateTime,SenderID,DestinationNumber,TextDecoded');
  $this->db->from('outbox');
  $this->db->where('UDH',$UDH);
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function callOutboxMultipartWithID($ID)
{
  $this->db->select('ID,TextDecoded,UDH');
  $this->db->from('outbox_multipart');
  $this->db->where('ID',$ID);
  $this->db->order_by('SequencePosition','asc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function getContacts()
{
  $this->db->select('co.contact_id,co.contact_name,co.contact_number,co.contact_email,co.contact_address,co.contact_date,co.contact_status,gp.groups_id,gp.groups_name');
  $this->db->from('contacts co');
  $this->db->join('groups gp', 'co.contact_group_id = gp.groups_id', 'left');
  $this->db->where('co.contact_status','1');
  $this->db->order_by('co.contact_id','desc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function getAllContacts()
{
  $this->db->select('co.contact_id,co.contact_name,co.contact_number,co.contact_email,co.contact_address,co.contact_date,co.contact_status,gp.groups_id,gp.groups_name');
  $this->db->from('contacts co');
  $this->db->join('groups gp', 'co.contact_group_id = gp.groups_id', 'left');
  $this->db->order_by('co.contact_id','desc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function getGroups()
{
  $this->db->from('groups');
  $this->db->order_by('groups_id','desc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function getOutbox()
{
  $this->db->select('ID,SendingDateTime,SenderID,DestinationNumber,TextDecoded,UDH');
  $this->db->from('outbox');
  $this->db->order_by('ID','asc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function getSentItems()
{
  $this->db->select('ID,SendingDateTime,SMSCNumber,DestinationNumber,TextDecoded');
  $this->db->from('sentitems');
  $this->db->order_by('ID','desc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function getInfo()
{
  $this->db->select('ID,IMEI,Signal,Battery,Sent,Received,Send,Receive');
  $this->db->from('phones');
  $this->db->order_by('ID','desc');
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function getContactData()
{
  $this->db->from('contacts');
  $this->db->where('contact_id', $this->input->post('id'));
  $this->db->limit('1');
  $query = $this->db->get();
  return $query->row();
}
 /*function login($username, $password)
 {
   $this->db->select('*');
   $this->db->from('sippeers');
   $this->db->where('device_username', $username);
   $this->db->where('password', MD5($password));
   $this->db->limit(1);

   $query = $this->db->get();

   if($query->num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
*/
function addContact()
{
  $data = array(
    'contact_group_id' => $this->input->post('add_contact_group_id'),
    'contact_name' => $this->input->post('add_contact_name'),
    'contact_number' => $this->input->post('add_contact_number'),
    'contact_email' => $this->input->post('add_contact_email'),
    'contact_address' => $this->input->post('add_contact_address'),
    'contact_status' => $this->input->post('add_contact_status')
  );
  
  //start the transaction
  $this->db->trans_begin();
  $res = $this->db->insert('contacts', $data);  
  //make transaction complete
  $this->db->trans_complete();
  //check if transaction status TRUE or FALSE
  if ($this->db->trans_status() === FALSE) {
      //if something went wrong, rollback everything
      $this->db->trans_rollback();
      return FALSE;
  } else {
      //if everything went right, commit the data to the database
      $this->db->trans_commit();
      return $res;
  }
  
}

function editContact()
{
  $data = array(
    'contact_group_id' => $this->input->post('edit_contact_group_id'),
    'contact_name' => $this->input->post('edit_contact_name'),
    'contact_number' => $this->input->post('edit_contact_number'),
    'contact_email' => $this->input->post('edit_contact_email'),
    'contact_address' => $this->input->post('edit_contact_address'),
    'contact_status' => $this->input->post('edit_contact_status'),
    'contact_date' => date('Y-m-d H:i:s')
  );
  $this->db->where('contact_id',$this->input->post('edit_contact_id'));
  $res = $this->db->update('contacts', $data);
  return $res;
}

function deleteInboxMessage($id)
{
  $this->db->where('ID', $id);
  $this->db->delete('inbox');
}

function deleteSentMessage($id)
{
  $this->db->where('ID', $id);
  $this->db->delete('sentitems');
}

function deleteContact($id)
{
  $this->db->where('contact_id', $id);
  $this->db->delete('contacts');
}

function insertOutbox($data)
{
  //start the transaction
  $this->db->trans_begin();
  $res = $this->db->insert('outbox', $data);
  $id = $this->db->insert_id();
  //make transaction complete
  $this->db->trans_complete();
  //check if transaction status TRUE or FALSE
  if ($this->db->trans_status() === FALSE) {
      //if something went wrong, rollback everything
      $this->db->trans_rollback();
      return FALSE;
  } else {
      //if everything went right, commit the data to the database
      $this->db->trans_commit();
      return $id;
  }
}

function insertMultipart($data)
{
  //start the transaction
  $this->db->trans_begin();
  $res = $this->db->insert('outbox_multipart', $data);  
  //make transaction complete
  $this->db->trans_complete();
  //check if transaction status TRUE or FALSE
  if ($this->db->trans_status() === FALSE) {
      //if something went wrong, rollback everything
      $this->db->trans_rollback();
      return FALSE;
  } else {
      //if everything went right, commit the data to the database
      $this->db->trans_commit();
      return TRUE;
  }
}

function stopSMSService($contact)
{
  $data = array(
    'contact_status' => '0'
  );
  $this->db->where('contact_number',$contact);
  $res = $this->db->update('contacts', $data);
}

function getGroupContacts()
{
  $this->db->select('contact_number');
  $this->db->from('contacts');
  $this->db->where('contact_group_id',$this->input->post('group_id'));
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function exportContacts($arr_data)
{
  $error = '';
  foreach($arr_data as $record)
  {
    $data = array(
      'contact_number' => $record['A'],
      'contact_name' => $record['B'],
      'contact_email' => $record['C'],
      'contact_address' => $record['D'],
      'contact_status' => (string)$record['E'],
      'contact_group_id' => $this->input->post('group_id')
      );
   $this->db->insert('contacts', $data);
   $error = $this->db->_error_message();
   if(!empty($error))
   return '<span style="color:red">'.$error.'</span>';
  }
  if(empty($error))
  {
  	$error = 'Upload Success.';
  	return '<span style="color:green">'.$error.'</span>';
  }
}

function getSettings()
{
  $this->db->from('settings');
  $this->db->limit(1);
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return $query->result_array();
  }
  else
  {
    return false;
  }
}

function saveSettings()
{
  $data = array(
    'settings_ussdcode' => $this->input->post('ussdcode'),
    'settings_option' => $this->input->post('ussdoption'),
    'settings_optoutmsg' => trim($this->input->post('optoutmsg')),
    'settings_date' => date('Y-m-d H:i:s')
    );
  $this->db->where('settings_id',$this->input->post('settingid'));
  $res = $this->db->update('settings', $data);
  return $res;
}

function addGroup()
{
  $data = array(    
    'groups_name' => $this->input->post('add_group_name')    
  );
  
  //start the transaction
  $this->db->trans_begin();
  $res = $this->db->insert('groups', $data);  
  //make transaction complete
  $this->db->trans_complete();
  //check if transaction status TRUE or FALSE
  if ($this->db->trans_status() === FALSE) {
      //if something went wrong, rollback everything
      $this->db->trans_rollback();
      return FALSE;
  } else {
      //if everything went right, commit the data to the database
      $this->db->trans_commit();
      return $res;
  }
}

function getGroupData()
{
  $this->db->from('groups');
  $this->db->where('groups_id', $this->input->post('id'));
  $this->db->limit('1');
  $query = $this->db->get();
  return $query->row();
}

function editGroup()
{
  $data = array(
    'groups_name' => $this->input->post('edit_group_name'),
    'groups_date' => date('Y-m-d H:i:s')
  );
  $this->db->where('groups_id',$this->input->post('edit_group_id'));
  $res = $this->db->update('groups', $data);
  return $res;
}

function deleteGroup($id)
{
  $this->db->where('groups_id', $id);
  $this->db->delete('groups');
}

function checkGroupInContacts($id)
{
  $this->db->select('contact_group_id');
  $this->db->from('contacts');
  $this->db->where('contact_group_id',$id);
  $query = $this->db->get();
  if($query->num_rows() > 0)
  {
    return true;
  }
  else
  {
    return false;
  }
}


}
?>