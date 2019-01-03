<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{

    protected  $post_check;
    function __construct()
    {
        parent::__construct();
        $this->post_check = $_SERVER['REQUEST_METHOD'];
        $this->load->model('sms_model');
    }


    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = ('Admin Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param string $param1
     * @param string $param2
     */
    function technician($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create' && $this->post_check === 'POST') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['date_added'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->create('technician', $data);

            $this->session->set_flashdata('flash_message', 'Data Added Successfully');
            //$this->email_model->account_opening_email('student', $data['email']);
            redirect(base_url() . 'admin/technician', 'refresh');

        }

        if ($param1 == 'update' && $this->post_check === 'POST') {
            $password = $this->input->post('password');
            $technician_id = $param2;
            if ($password != '') {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['date_added'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->update('technician', ['technician_id'=> $technician_id], $data);

            $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
            redirect(base_url() . 'admin/technician', 'refresh');
        }

        if ($param1 == 'delete') {
            $technician_id = $param2;
            $this->crud_model->delete('technician', $technician_id);
        }

        $page_data['page_name'] = 'technician';
        $page_data['page_title'] = ('Manage Technician');
        $this->load->view('backend/index', $page_data);

    }

    /**
     * add_technician
     */
    function add_technician()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'add_technician';
        $page_data['page_title'] = ('Add Technician');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param string $param1
     */
    function edit_technician($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $technician_id = $param1;

        $page_data['technician_id'] = $technician_id;
        $page_data['page_name'] = 'edit_technician';
        $page_data['page_title'] = ('Edit Technician');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param string $param1
     * @param string $param2
     */
    function patient($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create' && $this->post_check === 'POST') {
            $passcode = rand(00000000, 99999999);
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['password'] = password_hash($passcode, PASSWORD_DEFAULT);
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['age'] = $this->input->post('age');
            $data['gender'] = $this->input->post('gender');
            $data['date_added'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->create('patient', $data);

            //send passcode by sms
            $message = 'Dear '. $data['name'].', An account has been created for you on our website, login to the Patients\' portal with your name and this passcode - '. $passcode.' Thank you. Medical Pathology Lab';
            $this->sms_model->send_sms($message, $data['phone']);


            $this->session->set_flashdata('flash_message', 'Data Added Successfully');
            redirect(base_url() . 'admin/patient', 'refresh');

        }

        if ($param1 == 'update' && $this->post_check === 'POST') {
            $password = $this->input->post('password');
            $patient_id = $param2;
            if ($password != '') {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['date_added'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->update('patient', ['patient_id' => $patient_id], $data);

            $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
            redirect(base_url() . 'admin/patient', 'refresh');
        }

        if ($param1 == 'delete') {
            $patient_id = $param2;
            $this->crud_model->delete('patient', $patient_id);
        }

        $page_data['page_name'] = 'patient';
        $page_data['page_title'] = ('Manage patient');
        $this->load->view('backend/index', $page_data);

    }

    /**
     *
     */
    function add_patient()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'add_patient';
        $page_data['page_title'] = ('Add patient');
        $this->load->view('backend/index', $page_data);
    }

    /**
     *
     */
    function report()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'report';
        $page_data['page_title'] = 'Medical Lab Reports';
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param $report_id
     */
    function view_report($report_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['report_id'] = $report_id;
        $page_data['page_name'] = 'view_report';
        $page_data['page_title'] = 'Medical Lab Report';
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param $report_id
     */
    function send_report($report_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->post_check === 'POST') {
            $pdf_data = $this->input->post('data');
            $to_email = $this->session->userdata('email');
            $this->email_model->send_report($report_id, $pdf_data, $to_email);
            echo 'Email Sent Successfully';
        }
    }

    /**
     * @param string $param1
     */
    function edit_patient($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $patient_id = $param1;

        $page_data['patient_id'] = $patient_id;
        $page_data['page_name'] = 'edit_patient';
        $page_data['page_title'] = ('Edit patient');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param string $param1
     */
    function system_settings($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($param1 == 'update') {

            $set_fields = ['system_name', 'address', 'phone', 'skin_colour', 'system_email', 'system_password', 'system_host', 'twilio_sender_phone_number', 'twilio_account_sid', 'twilio_auth_token'];

            foreach($set_fields as $sf){
                $data['description'] = $this->input->post($sf);
                $this->crud_model->update('settings', ['type' => $sf], $data);
            }

            $this->session->set_flashdata('flash_message', 'Data Updated');
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }

        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = 'System Settings';
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param string $param1
     */
    function manage_profile($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $admin_id = $this->session->userdata('admin_id');

        if ($param1 == 'update' && $this->post_check === 'POST') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $this->crud_model->update('admin', ['admin_id' => $admin_id], $data);
        }

        if ($param1 == 'change_password' && $this->post_check === 'POST') {

            $password = $this->input->post('password');
            $hash = $this->crud_model->get_db('admin', ['admin_id' => $admin_id], 'password');

            $password_verify = password_verify($password, $hash);
            if (!$password_verify) {
                $this->session->set_flashdata('error_message', 'Invalid password');
                redirect(base_url() . 'admin/manage_profile', 'refresh');
            }

            $new_password = $this->input->post('new_password');
            $confirm_new_password = $this->input->post('confirm_new_password');

            if($new_password == $confirm_new_password){
                $data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
                $this->crud_model->update('admin', ['admin_id' => $admin_id], $data);
                $this->session->set_flashdata('flash_message', 'Password Changed Successfully');
                redirect(base_url() . 'admin/manage_profile', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Password Mismatch');
                redirect(base_url() . 'admin/manage_profile', 'refresh');
            }

        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = ('Manage Profile');
        $this->load->view('backend/index', $page_data);
    }

}