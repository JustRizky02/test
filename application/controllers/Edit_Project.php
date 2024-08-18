<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_Project extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function edit($id)
	{
		$data['proyek'] = $this->get_project_by_id($id);
		$this->load->view('edit_project_page', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'namaProyek' => $this->input->post('namaProyek'),
			'client' => $this->input->post('client'),
			'pimpinanProyek' => $this->input->post('pimpinanProyek'),
			'tglMulai' => $this->input->post('tglMulai'),
			'tglSelesai' => $this->input->post('tglSelesai'),
			'keterangan' => $this->input->post('keterangan'),
		);

		$url = "http://localhost:8080/proyek/" . $id;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
		));

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ($http_code == 200) {
			redirect('welcome');
		} else {
			echo "Error: Gagal memperbarui data proyek. Kode HTTP: " . $http_code;
		}
	}

	private function get_project_by_id($id)
	{
		$url = "http://localhost:8080/proyek/".$id;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
		));

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$data = json_decode($response, true);
		return array(
			'id' => $id,
			'namaProyek' => $data['namaProyek'],
			'client' => $data['client'],
			'pimpinanProyek' => $data['pimpinanProyek'],
			'tglMulai' => $data['tglMulai'],
			'tglSelesai' => $data['tglSelesai'],
			'keterangan' => $data['keterangan'],
		);
	}
}
