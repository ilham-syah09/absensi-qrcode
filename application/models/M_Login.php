<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Login extends CI_Model
{
    function cek($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        $data = $query->row();

        if ($data) {
            if (password_verify($password, $data->password)) {
                if ($data->level == 1) {
                    $role = 'admin';
                } else {
                    $role = 'user';
                }
                $login        =    array(
                    'is_logged_in'    => true,
                    'username'        => $username,
                    'id'              => $data->id,
                    'role'            => $role
                );
                if ($login) {
                    $this->session->set_userdata('log_' . $role, $login);
                    $this->session->set_userdata($login);
                    return $role;
                }
            } else {
                return 'Username atau Password Salah!!';
            }
        } else {
            return 'Username atau Password Salah!!';
        }
    }
}

/* End of file MLogin.php */