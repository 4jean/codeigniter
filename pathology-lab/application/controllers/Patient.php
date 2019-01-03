<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Patient extends CI_Controller
{

    protected $post_check;

    function __construct()
    {
        parent::__construct();
        $this->post_check = $_SERVER['REQUEST_METHOD'];
    }

    /***default function, redirects to login page if no patient logged in yet***/
    public function index()
    {
        if ($this->session->userdata('patient_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('patient_login') == 1)
            redirect(base_url() . 'patient/dashboard', 'refresh');
    }

    /***patient DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('patient_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = ('Patient Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /*Get Patient Name with ajax request*/
    /**
     *
     */
    function fetch()
    {
        $result = [];
        $data = $this->crud_model->typeahead();
        foreach ($data as $row) {
            $result[] = $row['name'];
        }
        echo json_encode($result);
    }

    /**
     *
     */
    function report()
    {
        if ($this->session->userdata('patient_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'report';
        $page_data['page_title'] = ('My Reports');
        $this->load->view('backend/index', $page_data);
    }

    /**
     * @param $report_id
     */
    function view_report($report_id)
    {
        if ($this->session->userdata('patient_login') != 1)
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
        if ($this->session->userdata('patient_login') != 1)
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
    function manage_profile($param1 = '')
    {
        if ($this->session->userdata('patient_login') != 1)
            redirect(base_url(), 'refresh');

        $patient_id = $this->session->userdata('patient_id');

        /*Update Profile Info*/
        if ($param1 == 'update' && $this->post_check === 'POST') {
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $this->crud_model->update('patient', ['patient_id' => $patient_id], $data);

            $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
            redirect(base_url() . 'patient/manage_profile', 'refresh');
        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = ('Manage Profile');
        $this->load->view('backend/index', $page_data);
    }

}
