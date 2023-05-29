<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Login extends CI_Model
{
    function cek($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('admin');
        $data = $query->row();

        if ($data) {
            if (password_verify($password, $data->password)) {
                $login        =    array(
                    'is_logged_in'    => true,
                    'username'        => $username,
                    'id'              => $data->id,
                    'role'            => 'admin'
                );
                if ($login) {
                    $this->session->set_userdata('log_admin', $login);
                    $this->session->set_userdata($login);
                    return 'admin';
                }
            } else {
                return 'Username atau Password Salah!!';
            }
        } else {
            $this->db->where('nip', $username);
            $query = $this->db->get('pegawai');
            $data = $query->row();

            if ($data) {
                if (password_verify($password, $data->password)) {
                    $user_agent = $this->input->user_agent();

                    $this->db->where('user_agent', $user_agent);
                    $userAgentReady = $this->db->get('pegawai')->row();

                    if ($userAgentReady) {
                        if ($userAgentReady->id == $data->id) {
                            $login        =    array(
                                'is_logged_in'    => true,
                                'username'        => $username,
                                'id'              => $data->id,
                                'role'            => 'pegawai'
                            );
                            if ($login) {
                                $this->session->set_userdata('log_pegawai', $login);
                                $this->session->set_userdata($login);
                                return 'pegawai';
                            }
                        } else {
                            return 'Access denied!!';
                        }
                    } else {
                        if ($data->user_agent == NULL) {
                            $this->db->where('id', $data->id);
                            $this->db->update('pegawai', ['user_agent' => $user_agent]);

                            $login        =    array(
                                'is_logged_in'    => true,
                                'username'        => $username,
                                'id'              => $data->id,
                                'role'            => 'pegawai'
                            );
                            if ($login) {
                                $this->session->set_userdata('log_pegawai', $login);
                                $this->session->set_userdata($login);
                                return 'pegawai';
                            }
                        } else {
                            if ($user_agent == $data->user_agent) {
                                $login        =    array(
                                    'is_logged_in'    => true,
                                    'username'        => $username,
                                    'id'              => $data->id,
                                    'role'            => 'pegawai'
                                );
                                if ($login) {
                                    $this->session->set_userdata('log_pegawai', $login);
                                    $this->session->set_userdata($login);
                                    return 'pegawai';
                                }
                            } else {
                                return 'Access denied!!';
                            }
                        }
                    }
                } else {
                    return 'Username atau Password Salah!!';
                }
            } else {
                return 'Username atau Password Salah!!';
            }
        }
    }
}

/* End of file MLogin.php */