<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan extends CI_Controller
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
		$waktuSekarang = $this->uri->segment(3);
		$batasWaktu = $this->uri->segment(4);

		if (date('H:i:s') >= $waktuSekarang && date('H:i:s') <= $batasWaktu) {
			$cekPresensi = $this->pegawai->getPresensi([
				'presensi.idPegawai' => $this->dt_user->id,
				'presensi.tanggal'   => date('Y-m-d')
			]);

			if ($cekPresensi) {
				if ($cekPresensi[0]->presensiMasuk == null) {
					$data = [
						'presensiMasuk' => date('H:i:s')
					];
				} else {
					$data = [
						'presensiPulang' => date('H:i:s')
					];
				}

				$this->db->where('id', $cekPresensi[0]->id);
				$update = $this->db->update('presensi', $data);

				if ($update) {
					$this->session->set_flashdata('toastr-success', 'Presensi berhasil');
				} else {
					$this->session->set_flashdata('toastr-error', 'Serve error!');
				}
			} else {
				$this->session->set_flashdata('toastr-error', 'Tidak ada jadwal untuk Anda hari ini!');
			}

			redirect('pegawai/presensi', 'refresh');
		} else {
			$this->session->set_flashdata('toastr-error', 'QR Code tidak ditemukan, silakan scan QR code terbaru');
			redirect('pegawai/presensi', 'refresh');
		}
	}
}
