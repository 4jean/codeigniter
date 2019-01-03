<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{


    //Default function, redirects to logged in user area
    /**
     * Check Authentication
     */
    public function index()
    {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');

        if ($this->session->userdata('technician_login') == 1)
            redirect(base_url() . 'technician/dashboard', 'refresh');

        if ($this->session->userdata('patient_login') == 1)
            redirect(base_url() . 'patient/dashboard', 'refresh');

        $this->load->view('backend/login');
    }


    /**
     *Validating login from form
     */
    function validate_login()
    {
        $name_email = $this->input->post('name_email');
        $password = $this->input->post('password');
        $data_type = filter_var($name_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        //Verify Password
        $hash_user_type = $this->crud_model->get_pass($name_email, $data_type);
        $hash_user_type = explode(' ', $hash_user_type);
        $hash = $hash_user_type[0];
        $user_type = $hash_user_type[1];
        $password_verify = password_verify($password, $hash);
        if (!$password_verify) {
            $this->session->set_flashdata('login_error', 'Invalid Login');
            redirect(base_url() . 'login', 'refresh');
        }

        // Checking login credential for user
        $query = $this->db->get_where($user_type, [$data_type => $name_email]);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $user_id = $user_type . '_id';
            $this->session->set_userdata($user_type . '_login', '1');
            $this->session->set_userdata($user_type . '_id', $row->$user_id);
            $this->session->set_userdata('user_id', $row->$user_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', $user_type);
            //print_r($this->session->userdata());
            redirect(base_url() . $user_type . '/dashboard', 'refresh');
        }
    }


    /**
     *PASSWORD RESET BY EMAIL
     */
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    /**
     * Reset Password
     */
    function reset_password()
    {
        $email = $this->input->post('email');
        //resetting user password here
        $new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);

        $reset_account_type = $this->crud_model->verify_email($email, $new_password);
        if ($reset_account_type) {
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $reset_account_type, $email);
            $this->session->set_flashdata('reset_success', ('New Password Sent to your email'));
            redirect(base_url() . 'login/forgot_password', 'refresh');
        } else {
            $this->session->set_flashdata('reset_error', 'Password reset failed');
            redirect(base_url() . 'login/forgot_password', 'refresh');
        }
    }

        /*******LOGOUT FUNCTION ****** */
        function logout()
        {
            $this->session->sess_destroy();
            $this->session->set_flashdata('logout_notification', 'logged_out');
            redirect(base_url() . 'login', 'refresh');
        }
}