<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Technician extends CI_Controller
{

    protected $post_check;
    function __construct()
    {
        parent::__construct();
        $this->post_check = $_SERVER['REQUEST_METHOD'];
    }

    /**
     *
     */
    public function index()
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('technician_login') == 1)
            redirect(base_url() . 'technician/dashboard', 'refresh');
    }

    /***technician DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = ('Technician Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param string $param1
     * @param string $param2
     */
    function report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $technician_id = $this->session->userdata('user_id');

        if ($param1 == 'create' && $this->post_check === 'POST') {
            $data['name'] = $this->input->post('name');
            $data['patient_id'] = $this->input->post('patient_id');
            $data['technician_id'] = $technician_id;
            $data['ref_no'] = 'PLRS-' . rand(00000, 99999);
            $data['description'] = $this->input->post('description');
            $data['date'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->create('report', $data);

            $this->session->set_flashdata('flash_message', 'Data Added Successfully');
            redirect(base_url() . 'technician/report', 'refresh');
        }

        if ($param1 == 'update' && $this->post_check === 'POST') {
            $report_id = $param2;

            $data['name'] = $this->input->post('name');
            $data['patient_id'] = $this->input->post('patient_id');
            $data['technician_id'] = $technician_id;
            $data['description'] = $this->input->post('description');
            $data['date'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->update('report', ['report_id' => $report_id], $data);

            $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
            redirect(base_url() . 'technician/report', 'refresh');
        }

        if ($param1 == 'delete') {
            $report_id = $param2;

            $this->crud_model->delete('report', $report_id);

            $this->session->set_flashdata('flash_message', 'Data Deleted Successfully');
            redirect(base_url() . 'technician/report', 'refresh');
        }

        $page_data['page_name'] = 'report';
        $page_data['page_title'] = ('Manage Reports');
        $this->load->view('backend/index', $page_data);
    }

    /**
     *
     */
    function add_report()
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'add_report';
        $page_data['page_title'] = ('Add Report');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param $param1
     */
    function edit_report($param1)
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['report_id'] = $param1;
        $page_data['page_name'] = 'edit_report';
        $page_data['page_title'] = ('Edit Report');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param string $param1
     * @param string $param2
     */
    function test($param1 = '', $param2 ='')
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $technician_id = $this->session->userdata('user_id');

        if ($param1 == 'create' && $this->post_check === 'POST') {
            $data['name'] = $this->input->post('name');
            $data['report_id'] = $this->input->post('report_id');
            $data['patient_id'] = $this->input->post('patient_id');
            $data['technician_id'] = $technician_id;
            $data['result'] = $this->input->post('test_result');
            $data['comments'] = $this->input->post('comments');
            $data['date'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->create('test', $data);

            $this->session->set_flashdata('flash_message', 'Data Added Successfully');
            redirect(base_url() . 'technician/test', 'refresh');
        }

        if ($param1 == 'update' && $this->post_check === 'POST') {
            $test_id = $param2;

            $data['name'] = $this->input->post('name');
            $data['report_id'] = $this->input->post('report_id');
            $data['patient_id'] = $this->input->post('patient_id');
            $data['technician_id'] = $technician_id;
            $data['result'] = $this->input->post('test_result');
            $data['comments'] = $this->input->post('comments');
            $data['date'] = date('d/m/Y', strtotime('now'));
            $this->crud_model->update('test', ['test_id' => $test_id], $data);

            $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
            redirect(base_url() . 'technician/test', 'refresh');
        }

        if ($param1 == 'delete') {
            $test_id = $param2;

            $this->crud_model->delete('test', $test_id);

            $this->session->set_flashdata('flash_message', 'Data Deleted Successfully');
            redirect(base_url() . 'technician/test', 'refresh');
        }

        $page_data['page_name'] = 'test';
        $page_data['page_title'] = ('Medical Lab Tests');
        $this->load->view('backend/index', $page_data);
    }

    /**
     *
     */
    function add_test()
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'add_test';
        $page_data['page_title'] = ('New Lab Test');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param $param1
     */
    function edit_test($param1)
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['test_id'] = $param1;
        $page_data['page_name'] = 'edit_test';
        $page_data['page_title'] = ('Edit Lab Test');
        $this->load->view('backend/index', $page_data);
    }

    /**
     *
     */
    function patient()
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'patient';
        $page_data['page_title'] = ('List of Patients');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param $report_id
     */
    function view_report($report_id)
    {
        if ($this->session->userdata('technician_login') != 1)
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
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        if($this->post_check === 'POST'){
            $pdf_data = $this->input->post('data');
            $to_email = $this->session->userdata('email');
            $this->email_model->send_report($report_id, $pdf_data, $to_email);
            echo 'Email Sent Successfully';
        }

    }

    /**
     * @param string $param1
     */
    function manage_profile($param1 = '')
    {
        if ($this->session->userdata('technician_login') != 1)
            redirect(base_url(), 'refresh');

        $technician_id = $this->session->userdata('technician_id');

        if ($param1 == 'update' && $this->post_check === 'POST') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $this->crud_model->update('technician', ['technician_id' => $technician_id], $data);

            $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
            redirect(base_url() . 'technician/manage_profile', 'refresh');
        }

        if ($param1 == 'change_password' && $this->post_check === 'POST') {

            $password = $this->input->post('password');
            $hash = $this->crud_model->get_db('technician', ['technician_id' => $technician_id], 'password');

            $password_verify = password_verify($password, $hash);
            if (!$password_verify) {
                $this->session->set_flashdata('error_message', 'Invalid password');
                redirect(base_url() . 'technician/manage_profile', 'refresh');
            }

            $new_password = $this->input->post('new_password');
            $confirm_new_password = $this->input->post('confirm_new_password');

            if ($new_password == $confirm_new_password) {
                $data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
                $this->crud_model->update('technician', ['technician_id' => $technician_id], $data);
                $this->session->set_flashdata('flash_message', 'Password Changed Successfully');
                redirect(base_url() . 'technician/manage_profile', 'refresh');
            } else {
                $this->session->set_flashdata('error_message', 'Password Mismatch');
                redirect(base_url() . 'technician/manage_profile', 'refresh');
            }

        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = ('Manage Profile');
        $this->load->view('backend/index', $page_data);
    }
}
