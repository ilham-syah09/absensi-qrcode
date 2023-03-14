<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
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
		$data = [
			'title'   => 'Jadwal',
			'page'    => 'admin/jadwal',
			'sidebar' => 'admin/sidebar',
			'navbar'  => 'admin/navbar',
			'shift'   => $this->admin->getShift(),
			'jadwal'  => $this->admin->getJadwal()
		];

		$this->load->view('index', $data);
	}

	public function getPegawai()
	{
		// $shift = $this->input->get('shift');
		$awal = $this->input->get('tanggalAwal');
		$akhir = $this->input->get('tanggalAkhir');

		$this->db->where([
			'tanggal >=' => $awal,
			'tanggal <=' => $akhir
		]);

		$this->db->group_by('idPegawai');

		$jadwal = $this->db->get('presensi')->result();

		if (!$jadwal) {
			$pegawai = $this->admin->getPegawai(['pegawai.status' => 1]);
		} else {
			foreach ($jadwal as $dt) {
				$this->db->where('pegawai.id !=', $dt->idPegawai);
			}

			$pegawai = $this->admin->getPegawai(['pegawai.status' => 1]);
		}

		$res = [
			'pegawai' => $pegawai
		];

		echo json_encode($res);
	}

	public function add()
	{
		$data = [
			'idShift'      => $this->input->post('idShift'),
			'tanggalAwal'  => $this->input->post('tanggalAwal'),
			'tanggalAkhir' => $this->input->post('tanggalAkhir')
		];

		$pegawai = $this->input->post('idPegawai');

		$begin = new DateTime($this->input->post('tanggalAwal'));
		$end = new DateTime($this->input->post('tanggalAkhir'));
		$end->modify('+1 day');

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);

		if ($pegawai) {
			$this->db->insert('jadwal', $data);
			$insert_id = $this->db->insert_id();

			$presensi = [];

			if ($insert_id) {
				foreach ($period as $dt) {
					foreach ($pegawai as $idPeg) {
						array_push($presensi, [
							'idJadwal' => $insert_id,
							'idPegawai' => $idPeg,
							'tanggal' => $dt->format('Y-m-d')
						]);
					}
				}

				if (count($presensi) != 0) {
					$this->db->insert_batch('presensi', $presensi);
				}

				$this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('toastr-error', 'Data gagal ditambahkam');
			}
		} else {
			$this->session->set_flashdata('toastr-error', 'Pegawai tidak boleh kosong!');
		}

		redirect('admin/jadwal', 'refresh');
	}

	public function getListPegawai($id)
	{
		$this->db->select('pegawai.nama');
		$this->db->join('pegawai', 'pegawai.id = presensi.idPegawai', 'inner');

		$this->db->where('presensi.idJadwal', $id);
		$this->db->group_by('presensi.idPegawai');
		$this->db->order_by('pegawai.nama', 'asc');

		$data = $this->db->get('presensi')->result();

		echo json_encode($data);
	}

	public function delete($id)
	{
		$this->db->where([
			'idJadwal' => $id
		]);

		$this->db->group_start();
		$this->db->where('presensiMasuk !=', null);
		$this->db->or_where('presensiPulang !=', null);
		$this->db->or_where('izin !=', null);
		$this->db->group_end();

		$cek = $this->db->get('presensi')->row();

		if (!$cek) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('jadwal');

			if ($delete) {
				$this->db->where('idJadwal', $id);
				$this->db->delete('presensi');

				$this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
			} else {
				$this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
			}
		} else {
			$this->session->set_flashdata('toastr-error', 'Jadwal sudah digunakan, tidak bisa dihapus!');
		}

		redirect('admin/jadwal', 'refresh');
	}

	public function getListPegawaiEdit()
	{
		$id = $this->input->get('id');
		$shift = $this->input->get('shift');
		$tanggalAwal = $this->input->get('tanggalAwal');
		$tanggalAkhir = $this->input->get('tanggalAkhir');

		$this->db->select('pegawai.id');
		$this->db->join('pegawai', 'pegawai.id = presensi.idPegawai', 'inner');

		$this->db->where('presensi.idJadwal', $id);
		$this->db->group_by('presensi.idPegawai');
		$this->db->order_by('pegawai.nama', 'asc');

		$data = $this->db->get('presensi')->result();

		$pegawaiReady = [];

		foreach ($data as $d) {
			$pegawaiReady[] = $d->id;
		}

		$this->db->where([
			'tanggal >='  => $tanggalAwal,
			'tanggal <='  => $tanggalAkhir,
			'idJadwal !=' => $id
		]);

		$this->db->group_by('idPegawai');

		$jadwal = $this->db->get('presensi')->result();

		if (!$jadwal) {
			$pegawai = $this->admin->getPegawai(['pegawai.status' => 1]);
		} else {
			foreach ($jadwal as $dt) {
				$this->db->where('pegawai.id !=', $dt->idPegawai);
			}

			$pegawai = $this->admin->getPegawai(['pegawai.status' => 1]);
		}

		$res = [
			'pegawaiReady' => $pegawaiReady,
			'pegawai' => $pegawai
		];

		echo json_encode($res);
	}

	public function edit()
	{
		$id = $this->input->post('idJadwal');
		$data = [
			'idShift'      => $this->input->post('idShift'),
			'tanggalAwal'  => $this->input->post('tanggalAwal'),
			'tanggalAkhir' => $this->input->post('tanggalAkhir')
		];

		$this->db->where([
			'idJadwal' => $id
		]);

		$this->db->group_start();
		$this->db->where('presensiMasuk !=', null);
		$this->db->or_where('presensiPulang !=', null);
		$this->db->or_where('izin !=', null);
		$this->db->group_end();

		$cek = $this->db->get('presensi')->row();

		if (!$cek) {
			$pegawai = $this->input->post('idPegawai');

			$begin = new DateTime($this->input->post('tanggalAwal'));
			$end = new DateTime($this->input->post('tanggalAkhir'));
			$end->modify('+1 day');

			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($begin, $interval, $end);

			if ($pegawai) {
				$this->db->where('idJadwal', $id);
				$delete = $this->db->delete('presensi');

				if ($delete) {
					$this->db->where('id', $id);
					$update = $this->db->update('jadwal', $data);

					$presensi = [];

					if ($update) {
						foreach ($period as $dt) {
							foreach ($pegawai as $idPeg) {
								array_push($presensi, [
									'idJadwal' => $id,
									'idPegawai' => $idPeg,
									'tanggal' => $dt->format('Y-m-d')
								]);
							}
						}

						if (count($presensi) != 0) {
							$this->db->insert_batch('presensi', $presensi);
						}

						$this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
					} else {
						$this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
					}
				} else {
					$this->session->set_flashdata('toastr-error', 'Server Error');
				}
			} else {
				$this->session->set_flashdata('toastr-error', 'Pegawai tidak boleh kosong!');
			}
		} else {
			$this->session->set_flashdata('toastr-error', 'Jadwal sudah digunakan, tidak bisa diedit!');
		}

		redirect('admin/jadwal', 'refresh');
	}
}

/* End of file Jadwal.php */
