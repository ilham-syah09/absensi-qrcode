<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alat extends CI_Controller
{
	public function getQueue()
	{
		$this->db->order_by('id', 'desc');
		$queue = $this->db->get('queue', 1)->row();

		if ($queue) {
			echo 'Ada queue';
		} else {
			echo 'Tidak ada queue';
		}
	}

	public function kirimGambar()
	{
		$this->db->order_by('id', 'desc');
		$queue = $this->db->get('queue', 1)->row();

		if ($queue) {
			$upload_foto = $_FILES['imageFile']['name'];

			if ($upload_foto) {
				$this->load->library('upload');
				$config['upload_path']   = './upload/presensi';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = '10240';
				$config['remove_spaces'] = TRUE;
				$config['detect_mime']   = TRUE;
				$config['encrypt_name']  = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('imageFile')) {
					echo $this->upload->display_errors();
				} else {
					$upload_data = $this->upload->data();

					$data = [
						$queue->act => $upload_data['file_name'],
					];

					$this->db->where('id', $queue->idPresensi);
					$update = $this->db->update('presensi', $data);

					if ($update) {
						$this->db->where('id', $queue->id);
						$this->db->delete('queue');

						echo 'Sukses upload gambar';
					} else {
						echo 'Maaf, upload gambar gagal!';
					}
				}
			}
		} else {
			echo 'Tidak ada data!';
		}
	}

	public function pass()
	{
		echo password_hash('superadmin', PASSWORD_BCRYPT);
	}
}

/* End of file Alat.php */
