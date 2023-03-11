<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pegawai extends CI_Model
{
	public function getShift()
	{
		$this->db->order_by('jamMasuk', 'asc');

		return $this->db->get('shift')->result();
	}

	public function getShiftJoin($where)
	{
		$this->db->select('shift.*');
		$this->db->join('shift', 'shift.id = jadwal.idShift', 'inner');

		$this->db->where($where);

		return $this->db->get('jadwal')->row();
	}

	public function getTahunIni()
	{
		$this->db->select('YEAR(tanggal) as tahun');
		$this->db->order_by('tahun', 'desc');
		$this->db->limit(1);

		$data = $this->db->get('presensi')->row();
		return $data->tahun;
	}

	public function getBulanIni($tahun)
	{
		$this->db->select('MONTH(tanggal) as bulan');
		$this->db->where('YEAR(tanggal)', $tahun);

		$this->db->order_by('bulan', 'desc');
		$this->db->limit(1);

		$data = $this->db->get('presensi')->row();
		return $data->bulan;
	}

	public function getTahun()
	{
		$this->db->select('YEAR(tanggal) as tahun');
		$this->db->group_by('tahun');
		$this->db->order_by('tahun', 'desc');

		return $this->db->get('presensi')->result();
	}

	public function getPresensi($where)
	{
		$this->db->select('presensi.*, jadwal.idShift');
		$this->db->join('jadwal', 'jadwal.id = presensi.idJadwal', 'inner');

		$this->db->where($where);
		$this->db->order_by('presensi.tanggal', 'asc');

		return $this->db->get('presensi')->result();
	}

	public function getDetailPresensi($id)
	{
		$this->db->select('presensi.*, jadwal.idShift');
		$this->db->join('jadwal', 'jadwal.id = presensi.idJadwal', 'inner');

		$this->db->where('presensi.id', $id);
		return $this->db->get('presensi')->row();
	}
}

/* End of file M_Pegawai.php */
