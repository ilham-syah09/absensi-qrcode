<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Scan extends CI_Controller
{

	public function index()
	{
		$data = [
			'title'     => 'Scan QR Code Presensi',
		];

		$this->load->view('scan', $data);
	}

	public function generateQRCode()
	{
		$waktuSekarang      = date('H:i:s');
		$batasWaktu         = date('H:i:s', strtotime("$waktuSekarang + 3 minute"));
		$namaFile           = "qrcode-" . date('YmdHis') . ".png";
		$url                = "pegawai/scan/$waktuSekarang/$batasWaktu";
		$params['data']     = base_url($url);
		$params['level']    = 'H';
		$params['size']     = 10;
		$params['savename'] = "file/$namaFile";

		$this->load->library('Ciqrcode');
		$this->ciqrcode->generate($params);

		$fileDb = $this->db->get('file')->row();

		if ($fileDb->nama != null) {
			$this->db->where('id', $fileDb->id);
			$update = $this->db->update('file', ['nama' => $namaFile]);

			if ($update) {
				unlink(FCPATH . 'file/' . $fileDb->nama);
			}
		} else {
			$this->db->where('id', $fileDb->id);
			$update = $this->db->update('file', ['nama' => $namaFile]);
		}

		echo json_encode(base_url("file/$namaFile?$waktuSekarang"));
	}
}

/* End of file Scan.php */
