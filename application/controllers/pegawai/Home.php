<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_pegawai'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_user = $this->db->get('pegawai')->row();

        $this->load->model('M_Pegawai', 'pegawai');
    }

    public function index()
    {
        $presensiHariIni = $this->pegawai->getPresensi([
            'presensi.idPegawai' => $this->dt_user->id,
            'presensi.tanggal'   => date('Y-m-d'),
        ]);

        if ($presensiHariIni) {
            $allJadwal = $this->pegawai->getPresensi([
                'presensi.idPegawai' => $this->dt_user->id,
                'presensi.idJadwal' => $presensiHariIni[0]->idJadwal
            ]);

            $shift = $this->pegawai->getShiftJoin([
                'jadwal.id' => $presensiHariIni[0]->idJadwal
            ]);
        } else {
            $allJadwal = false;
            $shift = false;
        }

        $data = [
            'title'   => 'Dashboard Pegawai',
            'sidebar' => 'pegawai/sidebar',
            'page'    => 'pegawai/dashboard',
            'navbar'  => 'pegawai/navbar',
            'presensiHariIni' => $presensiHariIni,
            'allJadwal' => $allJadwal,
            'shift' => $shift
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Home.php */