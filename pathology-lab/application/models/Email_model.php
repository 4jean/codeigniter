<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model
{

    /**
     * Email_model constructor.
     */
    function __construct()
	{
		parent::__construct();
        $this->load->library('phpmailer');
        $this->load->library('smtp');
	}

    /**
     * @param string $new_password
     * @param string $account_type
     * @param string $email
     * @return bool
     */
    function password_reset_email($new_password = '', $account_type = '', $email = '')
	{
		$query = $this->db->get_where($account_type, array('email' => $email));
		if ($query->num_rows() > 0) {

			$email_msg = "Your account type is : " . $account_type . '<br />';
			$email_msg .= "Your password is : " . $new_password . '<br />';

			$email_sub = "Password reset request ";
			$email_to = $email;
			$this->send_email($email_msg, $email_sub, $email_to);
			return true;
		} else {
			return false;
		}
	}

    /**
     * @param $report_id
     * @param $pdf_file
     * @param $to_email
     */
    function send_report($report_id, $pdf_file, $to_email)
    {
        $data['report_id'] = $report_id;
        $report_data = $this->db->get_where('report', $data);
        foreach ($report_data as $row):
            $patient_id = $row['patient_id'];
            $patient_name = $this->db->get_where('patient', ['patient_id' => $patient_id])->row()->name;
            $ref_no = $row['ref_no'];
            $report_id = $row['report_id'];

        $dirname = base_url().'/media/files/'.$patient_id;

        /*Check for a directory with the user's ID*/
        if (!is_dir($dirname))
        {
            mkdir($dirname, 0777, true);
        }

        $the_recipient_name = preg_replace("/[\s]/", "_", $patient_name);

            $file_url = base_url()."media/files/".$patient_id."/".$the_recipient_name ."_".strtoupper($report_id).".pdf";
        file_put_contents($file_url, $pdf_file);

            $subject = "MEDICAL LAB REPORT FOR ".$patient_name.' ('.$ref_no.')';
            $message = "Dear ".$patient_name.",<br><br>Kindly find attached your medical report. <br><br><br>Kind Regards<br>";


        $this->send_email($message, $subject, $to_email, $file_url);
endforeach;
    }

	/***custom email sender****/
	function send_email($msg = NULL, $sub = NULL, $to = NULL, $file = NULL)
	{
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = $this->get_email_host();
		$mail->Port = 465; // or 587
		$mail->IsHTML(true);
		$mail->Username = $this->get_system_email();
		$mail->Password = $this->get_system_email_password();
		$mail->SetFrom($this->get_system_email(), $this->get_system_name());
		$mail->Subject = $sub;
		$mail->Body = $msg;
		$mail->AddAddress($to);
        if($file!= null){
            $mail->addAttachment($file);
        }
		$mail->Send();
	}

    /**
     * @return mixed
     */
    function get_system_email()
	{
		return $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
	}

    /**
     * @return mixed
     */
    function get_system_email_password()
	{
		return $this->db->get_where('settings', array('type' => 'system_password'))->row()->description;
	}

    /**
     * @return mixed
     */
    function get_system_name()
	{
		return $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
	}

    /**
     * @return mixed
     */
    function get_email_host()
	{
		return $this->db->get_where('settings', array('type' => 'system_host'))->row()->description;
	}
}