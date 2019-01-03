<?php


class Auth_test extends TestCase
{

    public function setUp()
    {
        $this->resetInstance();
        $this->db = $this->CI->load->database('default', TRUE);
        $this->db->trans_begin();
        $DB = $this->db;
        $this->request->setCallablePreConstructor(
            function () use ($DB) {
                load_class_instance('db', $DB);
            }
        );

        $this->CI->load->library('User');
        $this->user = $this->CI->user;
        $this->CI->load->model('Crud_model');
        $this->crud_model = $this->CI->crud_model;
        $this->CI->load->library('Session');
        $this->session = $this->CI->session;
    }

    public function tearDown()
    {
        $this->db->trans_rollback();
        parent::tearDown();
    }

   /* public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $CI =& get_instance();
        $CI->load->library('Session');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->session = $this->CI->session;
    }*/

    public function test_index()
    {
        $this->request('GET', '');
        $this->assertResponseCode(200);
    }

    public function test_user_log_in()
    {
        $this->request('POST', 'login/validate_login', ['name_email' => 'admin@admin.com', 'password' => 'admin']);
        $this->assertRedirect('admin/dashboard');
    }

    public function test_user_log_in_failed()
    {
        $this->request('POST', 'login/validate_login', ['name_email' => 'admin@admin.com', 'password' => 'admins']);
        $this->assertRedirect('login');
    }

    public function test_admin_user()
    {
       $this->be('admin');
        $output = $this->request('GET', 'admin/dashboard');
        $this->assertContains('Admin Dashboard', $output);
    }

    public function test_create_user()
    {
        $user = $this->create_user('admin');
        $this->assertEquals('admin', $user->account_type);
    }

    protected function be($user_type)
    {
        $user = $this->create_user($user_type);
        $user_type_id = $user_type.'_id';
        $data = [$user_type.'_login' => 1, $user_type.'_id' => $user->$user_type_id, 'user_id' => $user->$user_type_id, 'name' => $user->name, 'login_type' => $user_type];
        return $this->session->set_userdata($data);
    }

    protected function create_user($user_type)
    {
        if(!in_array($user_type, $this->valid_users())){
            return FALSE;
        }
        return $this->crud_model->create($user_type, $this->user->getUserData($user_type));
    }

    protected function valid_users()
    {
        return ['patient', 'admin', 'technician'];
    }
}