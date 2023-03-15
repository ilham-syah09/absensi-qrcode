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
        $tanggal =  date('Y-m-d');

        $this->db->select('presensi.id, presensi.idJadwal, jadwal.idShift');
        $this->db->join('jadwal', 'jadwal.id = presensi.idJadwal', 'inner');

        $this->db->where([
            'presensi.idPegawai'     => $this->dt_user->id,
            'jadwal.tanggalAwal <='  => $tanggal,
            'jadwal.tanggalAkhir >=' => $tanggal
        ]);

        $this->db->group_by('presensi.idJadwal');
        $this->db->order_by('jadwal.tanggalAwal', 'asc');

        $groupJadwal = $this->db->get('presensi')->result();

        $presensiHariIni = $this->pegawai->getPresensi([
            'presensi.idPegawai' => $this->dt_user->id,
            'presensi.tanggal'   => $tanggal,
        ]);

        if ($presensiHariIni) {
            $allJadwal = [];
            $shift = [];
            foreach ($groupJadwal as $jadwal) {
                $allJadwal[$jadwal->idJadwal] = $this->pegawai->getPresensi([
                    'presensi.idPegawai' => $this->dt_user->id,
                    'presensi.idJadwal' => $jadwal->idJadwal
                ]);

                $shift[$jadwal->idJadwal] = $this->pegawai->getShiftJoin([
                    'jadwal.id' => $jadwal->idJadwal
                ]);
            }
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
            'groupJadwal' => $groupJadwal,
            'allJadwal' => $allJadwal,
            'shift' => $shift
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Home.php */