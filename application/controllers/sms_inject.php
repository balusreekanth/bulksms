<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * sms_inject
 * 
 * @package   gammu smsd class
 * @author    SipCo systems
 * @license   Distributed under GNU/GPL
 * @version   0.1
 * @access    public
 */

class sms_inject extends CI_Controller 
{
    private $error, $msg, $dest, $udh, $msg_part, $sendingDateTime, $global_settings; //msg_part array of couple udh + msg
    
    /**
     * sms_inject::__construct()
     * @usage object constructor 
     * @param mysql link resource $res
     * @return void
     */
    function __construct() //throw mysql resource as argument
    {
        parent::__construct();
        $this->load->model('Tccs_model');
        $this->load->library('session');
        $sess = $this->session->userdata('logged_in');
        if($sess['login'] != TRUE)
            redirect('login', 'refresh');
        $this->udh=array(
        'udh_length'=>'05', //sms udh lenth 05 for 8bit udh, 06 for 16 bit udh
        'identifier'=>'00', //use 00 for 8bit udh, use 08 for 16bit udh
        'header_length'=>'03', //length of header including udh_length & identifier
        'reference'=>'00', //use 2bit 00-ff if 8bit udh, use 4bit 0000-ffff if 16bit udh
        'msg_count'=>1, //sms count
        'msg_part'=>1 //sms part number
        );
        $this->msg_part=array();
        $this->error=array();
    }
    
    
    /**
     * sms_inject::mass_sms()
     * @usage tell gammu-smsd to send one sms to many recipient
     * @param string $msg
     * @param array $dest
     * @param string $sender
     * @return void
     */
    function mass_sms()
    {
        if($this->input->post('group_id'))
        {
            $cont = $this->Tccs_model->getGroupContacts();
            if($cont)
            {
                $dest = array();
                foreach($cont as $row)
                {
                    $dest[] = $row['contact_number'];
                }
            }
        }else{
            $dest = $this->input->post('contact_id');
        }
        $msg = $this->input->post('smscontent');        
        $sender='Program';
        $sendingDateTime = $this->input->post('sendingDateTime');
        $sendingDateTime .= ':00';
        if(!$dest)
        {
            $this->error[]='No destination number defined';
            return false;
        }
        $this->msg=$msg;
        $this->create_msg();
        if(!is_array($dest))
        {
            $type = 'single';
            $res = $this->send_sms($msg,$dest,$sender,$sendingDateTime,$type);
            if($res)
                $this->session->set_flashdata('error','<span style="color:green">Message Sent.</span>');
            else
                $this->session->set_flashdata('error','<span style="color:red">Message Fail.</span>');
        }
        else
        {
            $type = 'bulk';
            foreach($dest as $dst)
            {
                $res = $this->send_sms($msg,$dst,$sender,$sendingDateTime,$type);
            }
            if($res)
                $this->session->set_flashdata('error','<span style="color:green">Message Sent.</span>');
            else
                $this->session->set_flashdata('error','<span style="color:red">Message Fail.</span>');
        }
        if($this->input->post('direct'))
            redirect($this->input->post('direct'));
        else
            redirect('smsportal/sendsms');
    }
    
    
    /**
     * sms_inject::send_sms()
     * @usage tell gammu-smsd to send sms to sepcified phone number
     * @param string $msg
     * @param string $dest
     * @param string $sender
     * @return false if error
     */
    function send_sms($msg,$dest,$sender='',$sendingDateTime='',$type)
    {
        if(!$dest)
        {
            $this->error[]='No destination number defined';
            return false;
        }
        $this->msg=$msg;
        $this->dest=$dest;
        $this->sendingDateTime=$sendingDateTime;
        $this->create_msg();
        //uncomment to get preview
        //echo "<pre>Destination : $this->dest\nSender : $sender\nMessage :\n";print_r($this->msg_part);
        $res = $this->inject($sender);
            return $res;
    }
    
    
    /**
     * sms_inject::inject()
     * @usage insert previously created sms part to database
     * @param string $sender
     * @return void
     */
    private function inject($sender='')
    {
        $multipart=(count($this->msg_part) > 1)?'true':'false';
        $id='';
        foreach($this->msg_part as $number => $sms)
        {
            if($number==1)
            {
                $data = array(
                    'UDH' => $sms['udh'],
                    'SendingDateTime' => $this->sendingDateTime,
                    'DestinationNumber' => $this->dest,
                    'TextDecoded' => $sms['msg'],
                    'MultiPart' => $multipart,
                    'CreatorID' => $sender
                    );
                $id = $this->Tccs_model->insertOutbox($data);
            }
            else
            {
                $data = array(
                    'UDH' => $sms['udh'],
                    'SequencePosition' => $number,
                    'TextDecoded' => $sms['msg'],
                    'ID' => $id
                    );
                $this->Tccs_model->insertMultipart($data);
            }
        }
        if(!empty($id))
            return true;
        else
            return false;
    }
    
    
    /**
     * sms_inject::create_msg()
     * @usage create sms message (and create udh if sms is multipart)
     * @return void
     */
    private function create_msg()
    {
        $x=1;
        if(strlen($this->msg)<=160) //if single sms, send without udh
        {
            $this->msg_part[$x]['udh']='';
            $this->msg_part[$x]['msg']=$this->msg;
        }
        else //if multipart sms, split into 153 character each part
        {
            $msg=str_split($this->msg,153);
            $ref=mt_rand(1,255);
            $this->udh['msg_count']=$this->dechex_str(count($msg));
            $this->udh['reference']=$this->dechex_str($ref);
            foreach($msg as $part)
            {
                $this->udh['msg_part']=$this->dechex_str($x);
                $this->msg_part[$x]['udh']=implode('',$this->udh);
                $this->msg_part[$x]['msg']=$part;
                $x++;
            }
        }
    }
    
    
    /**
     * sms_inject::dechex_str()
     * @usage convert decimal to zerofilled hexadecimal
     * @param integer $ref
     * @return 2 digit hexa-decimal in string format
     */
    private function dechex_str($ref)
    {
        return ($ref <= 15 )?'0'.dechex($ref):dechex($ref);
    }
}
?>