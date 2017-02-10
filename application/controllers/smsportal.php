<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class SMSPortal extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('Tccs_model');
   $this->load->library('session');
   $sess = $this->session->userdata('logged_in');
   if($sess['login'] != TRUE)
   		redirect('login', 'refresh');
 }

function index()
{	
	$data = '';
	$res = $this->Tccs_model->getAllContacts();
	if($res)
		$data['contacts'] = $res;
	$grp = $this->Tccs_model->getGroups();
	if($grp)
		$data['groups'] = $grp;
	$this->load->view('header');
	$this->load->view('contacts_view', $data);
	$this->load->view('footer');
   
}

function export()
{	
	if(!empty($_FILES['upload']['name'])){
		$ext = end(explode(".", $_FILES['upload']['name']));
		$ext = strtolower($ext);
		if($ext == 'xls' || $ext == 'xlsx' || $ext == 'csv')
		{
			$file = $_FILES['upload']['tmp_name'];
			//load the excel library
			$this->load->library('excel');
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
			 $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			 $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			 $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			 //header will/should be in row 1 only. 
			 if ($row == 1) {
			 $header[$row][$column] = $data_value;
			 } else {
			 $arr_data[$row][$column] = $data_value;
			 }
			}
			$res = $this->Tccs_model->exportContacts($arr_data);
			$this->session->set_flashdata('error',$res);
			redirect('smsportal');
		}else{
			$this->session->set_flashdata('error','<span style="color:red">File format should be .xls, .xlsx or .csv</span>');
			redirect('smsportal');
		}		
	}else{
		$this->session->set_flashdata('error','<span style="color:red">Please select Excel file</span>');
		redirect('smsportal');
	}
}

function inbox()
{	
	$data = '';
	$inboxsms = array();
	$res = $this->Tccs_model->getInbox();
	foreach($res as $row)
	{
		if($row['UDH'] != '')
		{
			$omitlast2digits = substr($row['UDH'], 0, -2);
			// call the inpox with udh and assign in to array and increment 1value again call until get 0 results.

			for($i=1;$i<11;$i++)
			{
				$adddigit = str_pad($i, 2, '0', STR_PAD_LEFT);
				$addlast2digits = $omitlast2digits.$adddigit;
				$udhres = $this->Tccs_model->callInboxWithUDH($addlast2digits);
				if($udhres)
				{					
					if($i==1){
						$lastsms = array();
						//$lastsms[''] = $udhres[];
						$lastsms['ID'] = $udhres[0]['ID'];
				        $lastsms['ReceivingDateTime'] = $udhres[0]['ReceivingDateTime'];
				        $lastsms['SMSCNumber'] = $udhres[0]['SMSCNumber'];
				        $lastsms['SenderNumber'] = $udhres[0]['SenderNumber'];
				        $lastsms['TextDecoded'] = $udhres[0]['TextDecoded'];
				        $lastsms['UDH'] = $udhres[0]['UDH'];
					}else{//print_r($lastsms);
						$lastsms['TextDecoded'] .= $udhres[0]['TextDecoded'];
					}
				}else{
					$inboxsms[] = $lastsms;
					unset($lastsms);
					break;
				}
				
			}
		}else{
			$inboxsms[] = $row;	
		}
	}
	$inboxsms = array_map("unserialize", array_unique(array_map("serialize", $inboxsms)));
	if($res)
		$data['inbox'] = $inboxsms;
	$this->load->view('header');
	$this->load->view('device_view', $data);
	$this->load->view('footer');   
}

function outbox()
{	
	$data = '';
	$res = $this->Tccs_model->getOutbox();
	for($i=0;$i<=count($res);$i++)
	{
		if($res[$i]['UDH'] != '')
		{
			$udhres = $this->Tccs_model->callOutboxMultipartWithID($res[$i]['ID']);
			if($udhres){
				foreach($udhres as $record)
				{
					$res[$i]['TextDecoded'] .= $record['TextDecoded'];
				}
			}
		}
	}
	if($res)
		$data['outbox'] = $res;
	$this->load->view('header');
	$this->load->view('outbox_view', $data);
	$this->load->view('footer');   
}

function sentitems()
{	
	$data = '';
	$res = $this->Tccs_model->getSentItems();
	if($res)
		$data['sentitems'] = $res;
	$this->load->view('header');
	$this->load->view('sentitems_view', $data);
	$this->load->view('footer');
   
}

function info()
{
	$data = '';
	$res = $this->Tccs_model->getInfo();
	if($res)
		$data['info'] = $res;
	$this->load->view('header');
	$this->load->view('info_view',$data);
	$this->load->view('footer');
}

function logout()
{
	$this->session->unset_userdata('logged_in');
	//session_destroy();
	redirect('login', 'refresh');
}

public function addcontact()
{
	if($this->input->post('add_contact_number')){
		$res = $this->Tccs_model->addContact();
		if($res)
			echo json_encode(array("status" => TRUE));
		else
			echo json_encode(array("status" => FALSE));
	}
	else{
		echo json_encode(array("status" => FALSE));
	}
}

public function contactdetails()
{
	if($this->input->post('id') != ''){
		$res = $this->Tccs_model->getContactData();
		echo json_encode($res);
	}
	else{
		echo json_encode(array("status" => FALSE));
	}
}

public function editcontact()
{
	if($this->input->post('edit_contact_number')){
		$res = $this->Tccs_model->editContact();
		if($res)
			echo json_encode(array("status" => TRUE));
		else
			echo json_encode(array("status" => FALSE));
	}
	else{
		echo json_encode(array("status" => FALSE));
	}
}

public function deleteinbox()
{
	if($this->input->post('id'))
	{
		$this->Tccs_model->deleteInboxMessage($this->input->post('id'));
		echo json_encode(array("status" => TRUE));
	}
}

public function deletesent()
{
	if($this->input->post('id'))
	{
		$this->Tccs_model->deleteSentMessage($this->input->post('id'));
		echo json_encode(array("status" => TRUE));
	}
}

public function deletecontact()
{
	if($this->input->post('id'))
	{
		$this->Tccs_model->deleteContact($this->input->post('id'));
		echo json_encode(array("status" => TRUE));
	}
}

public function sendsms()
{
	$data = '';
	$res = $this->Tccs_model->getContacts();
	if($res)
		$data['contacts'] = $res;
	$grp = $this->Tccs_model->getGroups();
	if($grp)
		$data['groups'] = $grp;
	$this->load->view('header');
	$this->load->view('sendsms_view',$data);
	$this->load->view('footer');
}

public function scheduledsms()
{
	$data = '';
	$res = $this->Tccs_model->getContacts();
	if($res)
		$data['contacts'] = $res;
	$grp = $this->Tccs_model->getGroups();
	if($grp)
		$data['groups'] = $grp;
	$this->load->view('header');
	$this->load->view('scheduledsms_view',$data);
	$this->load->view('footer');
}

public function settings()
{
	$data = '';
	$res = $this->Tccs_model->getSettings();
	if($res)
		$data['settings'] = $res;
	$this->load->view('header');
	$this->load->view('settings_view',$data);
	$this->load->view('footer');
}

public function savesettings()
{
	if($this->input->post('send'))
	{
		$res = $this->Tccs_model->saveSettings();
		if($res)
		{
			$this->session->set_flashdata('error','<span style="color:green">Update Success.</span>');
		}else{
			$this->session->set_flashdata('error','<span style="color:red">Update Failed.</span>');
		}
	}
	redirect('smsportal/settings');
}

public function balance()
{
	$this->load->view('header');
	$this->load->view('balance_view');
	$this->load->view('footer');
}

public function checkbalance()
{
	$res = $this->Tccs_model->getSettings();
	if($res && !empty($res[0]['settings_ussdcode']) && !empty($res[0]['settings_option']) )
	{
		$_POST['direct'] = 'smsportal/balance';
		$_POST['contact_id'] = $res[0]['settings_ussdcode'];
		$_POST['smscontent'] = $res[0]['settings_option'];
		$this->load->library('../controllers/sms_inject');
		$this->sms_inject->mass_sms();

	}else{
		$this->session->set_flashdata('error','<span style="color:red">Please Set the USSD code and USSD option in settings.</span>');
	}
	redirect('smsportal/balance');
}

public function groups()
{
	$grp = $this->Tccs_model->getGroups();
	if($grp)
		$data['groups'] = $grp;
	$this->load->view('header');
	$this->load->view('groups_view',$data);
	$this->load->view('footer');
}

public function creategroup()
{
	if($this->input->post('add_group_name')){
		$res = $this->Tccs_model->addGroup();
		if($res)
			echo json_encode(array("status" => TRUE));
		else
			echo json_encode(array("status" => FALSE));
	}
	else{
		echo json_encode(array("status" => FALSE));
	}
}

public function groupdetails()
{
	if($this->input->post('id') != ''){
		$res = $this->Tccs_model->getGroupData();
		echo json_encode($res);
	}
	else{
		echo json_encode(array("status" => FALSE));
	}
}

public function editgroup()
{
	if($this->input->post('edit_group_id')){
		$res = $this->Tccs_model->editGroup();
		if($res)
			echo json_encode(array("status" => TRUE));
		else
			echo json_encode(array("status" => FALSE));
	}
	else{
		echo json_encode(array("status" => FALSE));
	}
}

public function deletegroup()
{
	if($this->input->post('id'))
	{
		//check in contacts for group
		$res = $this->Tccs_model->checkGroupInContacts($this->input->post('id'));
		if($res)
		{
			echo json_encode(array("status" => 'exist'));
		}else{
			$this->Tccs_model->deleteGroup($this->input->post('id'));
			echo json_encode(array("status" => TRUE));
		}
		
	}else{
		echo json_encode(array("status" => FALSE));
	}
}









}

