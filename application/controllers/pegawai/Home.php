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

        $hari = [1, 2, 3, 4, 5, 6, 7];
        $hariLibur = [];

        if ($presensiHariIni) {
            $allJadwal = [];
            $shift = [];
            foreach ($groupJadwal as $jadwal) {
                $allJadwal[$jadwal->idJadwal] = $this->pegawai->getPresensi([
                    'presensi.idPegawai' => $this->dt_user->id,
                    'presensi.idJadwal' => $jadwal->idJadwal
                ]);

                $cekHari = date('N', strtotime($allJadwal[$jadwal->idJadwal][0]->tanggal));

                for ($h = 1; $h <= $cekHari; $h++) {
                    $cekIndex = array_search($h, $hariLibur);

                    if ($cekIndex !== true) {
                        $hariLibur[$h] = date('d M Y', strtotime('-' . ($cekHari - $h) . ' day', strtotime($allJadwal[$jadwal->idJadwal][0]->tanggal)));
                    }
                }

                if ($cekHari < 7) {
                    for ($h = 7; $h >= $cekHari; $h--) {
                        $cekIndex = array_search($h, $hariLibur);
                        if ($cekIndex !== true) {
                            $hariLibur[$h] = date('d M Y', strtotime('+' . ($h - $cekHari) . ' day', strtotime($allJadwal[$jadwal->idJadwal][0]->tanggal)));
                        }
                    }
                }

                // foreach ($allJadwal[$jadwal->idJadwal] as $key => $presensi) {
                //     $cekHari = date('N', strtotime($presensi->tanggal));

                //     if (($key + 1) < count($allJadwal[$jadwal->idJadwal])) {
                //         if ($cekHari > 1) {
                //             for ($h = 1; $h <= $cekHari; $h++) {
                //                 $cekIndex = array_search($h, $hariLibur);

                //                 if ($cekIndex !== true) {
                //                     $hariLibur[$h] = date('d M Y', strtotime('-' . ($cekHari - $h) . ' day', strtotime($presensi->tanggal)));
                //                 }
                //             }
                //         } else {
                //             $cekIndex = array_search($cekHari, $hariLibur);

                //             if ($cekIndex !== true) {
                //                 $hariLibur[$cekHari] = date('d M Y', strtotime($presensi->tanggal));
                //             }
                //         }
                //     } else {
                //         for ($h = 1; $h <= $cekHari; $h++) {
                //             $cekIndex = array_search($h, $hariLibur);

                //             if ($cekIndex !== true) {
                //                 $hariLibur[$h] = date('d M Y', strtotime('-' . ($cekHari - $h) . ' day', strtotime($presensi->tanggal)));
                //             }
                //         }

                //         if ($cekHari < 7) {
                //             for ($h = 7; $h >= $cekHari; $h--) {
                //                 $cekIndex = array_search($h, $hariLibur);
                //                 if ($cekIndex !== true) {
                //                     $hariLibur[$h] = date('d M Y', strtotime('+' . ($h - $cekHari) . ' day', strtotime($presensi->tanggal)));
                //                 }
                //             }
                //         } else {
                //             $cekIndex = array_search($cekHari, $hariLibur);

                //             if ($cekIndex !== true) {
                //                 $hariLibur[$cekHari] = date('d M Y', strtotime($presensi->tanggal));
                //             }
                //         }
                //     }
                // }

                foreach ($allJadwal[$jadwal->idJadwal] as $key => $presensi) {
                    $cekH = date('N', strtotime($presensi->tanggal));

                    $index = array_search($cekH, $hari);

                    if ($index !== false) {
                        unset($hariLibur[$cekH]);
                    }
                }

                $shift[$jadwal->idJadwal] = $this->pegawai->getShiftJoin([
                    'jadwal.id' => $jadwal->idJadwal
                ]);
            }
        } else {
            $allJadwal = false;
            $shift = false;
        }

        $data = [
            'title'           => 'Dashboard Pegawai',
            'sidebar'         => 'pegawai/sidebar',
            'page'            => 'pegawai/dashboard',
            'navbar'          => 'pegawai/navbar',
            'presensiHariIni' => $presensiHariIni,
            'groupJadwal'     => $groupJadwal,
            'allJadwal'       => $allJadwal,
            'shift'           => $shift,
            'hariLibur'       => $hariLibur
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Home.php */