<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model
{

    /**
     * Crud_model constructor.
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     * Clears Cache
     */
    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /**
     * Get Settings by type
     * @param $type
     * @return mixed
     */
    function get_settings($type)
    {
        return $this->db->get_where('settings', array('type' => $type))->row()->description;
    }


    /**
     * \Get Hashed Password of Users
     * @param $name_email
     * @param $data_type
     * @return bool|string
     */
    function get_pass($name_email, $data_type)
    {
        $data = [$data_type => $name_email];

        // Checking credential for Technician
        $query = $this->db->get_where('technician' , $data);
        if ($query->num_rows() > 0)
        {
            $password_hash = $query->row()->password;
            $user_type = $query->row()->account_type;
            return $password_hash.' '.$user_type;
        }

        // Checking credential for Admin
        $query = $this->db->get_where('admin' , $data);
        if ($query->num_rows() > 0)
        {
            $password_hash = $query->row()->password;
            $user_type = $query->row()->account_type;
            return $password_hash.' '.$user_type;
        }

        // Checking credential for Patient
        $query = $this->db->get_where('patient' , $data);
        if ($query->num_rows() > 0)
        {
            $password_hash = $query->row()->password;
            $user_type = $query->row()->account_type;
            return $password_hash.' '.$user_type;
        }

  return false;

    }

    /**
     * Verify User Email
     * @param $email
     * @param $new_password
     * @return bool|string
     */
    function verify_email($email, $new_password)
    {
        $data = ['email' => $email];

        // Checking credential for admin
        $query = $this->db->get_where('admin' , $data);
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'admin';
            $this->db->where($data);
            $this->db->update('admin' , ['password' => password_hash($new_password, PASSWORD_DEFAULT)]);

          return $reset_account_type;
        }

        // Checking credential for Technician
        $query = $this->db->get_where('technician' , $data);
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'technician';
            $this->db->where($data);
            $this->db->update('technician' , ['password' => password_hash($new_password, PASSWORD_DEFAULT)]);

            return $reset_account_type;
        }

        // Checking credential for Patient
        $query = $this->db->get_where('patient' , $data);
        if ($query->num_rows() > 0)
        {
            $reset_account_type     =   'patient';
            $this->db->where($data);
            $this->db->update('patient' , ['password' => password_hash($new_password, PASSWORD_DEFAULT)]);

            return $reset_account_type;
        }

        return false;
    }

    function typeahead()
    {
        return $this->db->get('patient')->result_array();
    }

    /**
     * @param $table
     * @param array $data
     * @param string $row
     * @return mixed
     */
    function get_db($table, $data = [], $row ='')
    {
        if(!empty($row) && !empty($data))
        {
            return $this->db->get_where($table, $data)->row()->$row;
        }
        if(!empty($row) && empty($data))
        {
            return $this->db->select($row)->get($table)->result_array();
        }
        if(!empty($data))
        {
            return $this->db->get_where($table, $data)->result_array();
        }
        return $this->db->get($table)->result_array();
    }

    public function create($table, $data)
    {
        $this->db->insert($table, $data);
        $id = $this->db->insert_id();
        return $this->find($table, $id);
    }

    public function get($table, $where)
    {
        return $this->db->get_where($table, $where)->result();
    }

    public function find($table, $id)
    {
        return $this->db->get_where($table, [$table.'_id' => $id])->row();
    }

    public function update($table, $where, $data)
    {
        return $this->db->where($where)->update($table, $data);
    }

    public function delete($table, $id)
    {
        return $this->db->delete($table, [$table.'_id' => $id]);
    }

    public function getWith($table, array $with, $where=[])
    {
        if($where){
            $recs = $this->db->get_where($table, $where)->result_array();
        }
        else{
            $recs = $this->db->get($table)->result_array();
        }
        $d = $recs;

        foreach($recs as $k => $rec){
            foreach($with as $w){
                $id = $w.'_id';
                $d[$k][$w] = $this->db->get_where($w, [$id => $rec[$id]])->row();
            }
        }

        return $d;
    }

}