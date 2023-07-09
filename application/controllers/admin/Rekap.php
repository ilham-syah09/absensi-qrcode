<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('log_admin'))) {
			$this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
			redirect('auth', 'refresh');
		}

		$this->db->where('id', $this->session->userdata('id'));
		$this->dt_user = $this->db->get('admin')->row();

		$this->load->model('M_Admin', 'admin');
	}

	public function index($th_ini = null, $bln_ini = null)
	{
		if (!$th_ini) {
			$th_ini = $this->admin->getTahunIni();
		}
		if (!$bln_ini) {
			$bln_ini = $this->admin->getBulanIni($th_ini);
		}

		$data = [
			'title'   => 'Rekap Bulanan',
			'sidebar' => 'admin/sidebar',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/rekap',
			'tahun'   => $this->admin->getTahun(),
			'pegawai' => $this->admin->getPegawai(),
			'th_ini'  => $th_ini,
			'bln_ini' => $bln_ini
		];

		$this->load->view('index', $data);
	}
}

/* End of file Rekap.php */
