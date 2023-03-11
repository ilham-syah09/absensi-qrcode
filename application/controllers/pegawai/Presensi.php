<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
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
		$th_ini  = $this->uri->segment(3);
		$bln_ini = $this->uri->segment(4);

		if (!$th_ini) {
			$th_ini = $this->pegawai->getTahunIni();
		}
		if (!$bln_ini) {
			$bln_ini = $this->pegawai->getBulanIni($th_ini);
		}

		$shiftMaster = $this->pegawai->getShift();
		$shift       = [];

		foreach ($shiftMaster as $key => $sm) {
			$shift[$sm->id] = $shiftMaster[$key];
		}

		$data = [
			'title'           => 'Presensi',
			'sidebar'         => 'pegawai/sidebar',
			'navbar'          => 'pegawai/navbar',
			'page'            => 'pegawai/presensi',
			'shift'           => $shift,
			'presensiHariIni' => $this->pegawai->getPresensi([
				'presensi.idPegawai' => $this->dt_user->id,
				'presensi.tanggal'   => date('Y-m-d')
			]),
			'presensi' => $this->pegawai->getPresensi([
				'presensi.idPegawai'      => $this->dt_user->id,
				'YEAR(presensi.tanggal)'  => $th_ini,
				'MONTH(presensi.tanggal)' => $bln_ini
			]),
			'tahun'   => $this->pegawai->getTahun(),
			'th_ini'  => $th_ini,
			'bln_ini' => $bln_ini
		];

		$this->load->view('index', $data);
	}

	public function detail($id)
	{
		$shiftMaster = $this->pegawai->getShift();
		$shift       = [];

		foreach ($shiftMaster as $key => $sm) {
			$shift[$sm->id] = $shiftMaster[$key];
		}

		$data = [
			'title'    => 'Detail Presensi',
			'sidebar'  => 'pegawai/sidebar',
			'navbar'   => 'pegawai/navbar',
			'page'     => 'pegawai/detail_presensi',
			'shift'    => $shift,
			'presensi' => $this->pegawai->getDetailPresensi($id),
		];

		$this->load->view('index', $data);
	}

	public function izin()
	{
		$document = $_FILES['document']['name'];

		if ($document) {
			$this->load->library('upload');
			$config['upload_path']   = './upload/izin';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			// $config['max_size']             = 3072; // 3 mb
			$config['remove_spaces'] = TRUE;
			$config['detect_mime']   = TRUE;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('document')) {
				$this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
				redirect('pegawai/presensi', 'refresh');
			} else {
				$upload_data = $this->upload->data();

				$data = [
					'izin'       => date('H:i:s'),
					'alasanIzin' => $this->input->post('alasan'),
					'document'   => $upload_data['file_name'],
					'statusIzin' => 'Menunggu'
				];

				$this->db->where('id', $this->input->post('id'));
				$update = $this->db->update('presensi', $data);

				if ($update) {
					$this->session->set_flashdata('toastr-success', 'Permohonan izin berhasil');
				} else {
					$this->session->set_flashdata('toastr-error', 'Serve error!');
				}
			}
		} else {
			$this->session->set_flashdata('toastr-error', 'Document tidak oleh kosong!');
		}

		redirect('pegawai/presensi', 'refresh');
	}
}

/* End of file Presensi.php */
