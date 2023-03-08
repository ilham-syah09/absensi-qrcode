<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('log_admin'))) {
			$this->session->set_flashdata('toastr-error', 'Anda Belum Login');
			redirect('auth', 'refresh');
		}

		$this->db->where('id', $this->session->userdata('id'));
		$this->dt_user = $this->db->get('admin')->row();

		$this->load->model('M_Admin', 'admin');
	}

	public function index()
	{
		$th_ini = $this->uri->segment(3);
		$bln_ini = $this->uri->segment(4);

		if (!$th_ini) {
			$th_ini = $this->admin->getTahunIni();
		}

		if (!$bln_ini) {
			$bln_ini = $this->admin->getBulanIni($th_ini);
		}

		$data = [
			'title'           => 'Presensi',
			'sidebar'         => 'admin/sidebar',
			'navbar'          => 'admin/navbar',
			'page'            => 'admin/presensi',
			'tahun'           => $this->admin->getTahun(),
			'presensiHariIni' => $this->admin->getPresensi(date('Y'), date('m'), date('d')),
			'riwayatPresensi' => $this->admin->getPresensi($th_ini, $bln_ini),
			'th_ini'          => $th_ini,
			'bln_ini'         => $bln_ini
		];

		$this->load->view('index', $data);
	}

	public function list($tanggal)
	{
		$shiftMaster = $this->admin->getShift();
		$shift = [];

		foreach ($shiftMaster as $key => $sm) {
			$shift[$sm->id] = $shiftMaster[$key];
		}

		$data = [
			'title'    => 'List Presensi Pegawai',
			'sidebar'  => 'admin/sidebar',
			'navbar'   => 'admin/navbar',
			'page'     => 'admin/list_presensi',
			'shift'    => $shift,
			'presensi' => $this->admin->getListPresensi($tanggal),
			'tanggal'  => $tanggal
		];

		$this->load->view('index', $data);
	}

	public function detail($id)
	{
		$shiftMaster = $this->admin->getShift();
		$shift = [];

		foreach ($shiftMaster as $key => $sm) {
			$shift[$sm->id] = $shiftMaster[$key];
		}

		$data = [
			'title'    => 'Detail Presensi Pegawai',
			'sidebar'  => 'admin/sidebar',
			'navbar'   => 'admin/navbar',
			'page'     => 'admin/detail_presensi',
			'shift'    => $shift,
			'presensi' => $this->admin->getDetailPresensi($id),
		];

		$this->load->view('index', $data);
	}

	public function izin($status, $id)
	{
		$data = [
			'statusIzin' => $status
		];

		$this->db->where('id', $id);
		$update = $this->db->update('presensi', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Izin berhasil ' . $status);
		} else {
			$this->session->set_flashdata('toastr-error', 'Izin berhasil ' . $status);
		}

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
}

/* End of file Presensi.php */
