<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_Location extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function edit($id)
	{

		$data['location'] = $this->get_project_by_id($id);
		$this->load->view('edit_location_page', $data);
	}


	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'namaLokasi' => $this->input->post('namaLokasi'),
			'provinsi' => $this->input->post('provinsi'),
			'kota' => $this->input->post('kota'),
			'negara' => $this->input->post('negara'),
		);

		$url = "http://localhost:8080/location/" . $id;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Menggunakan metode HTTP PUT
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Data yang dikirim dalam format JSON
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json', // Set Content-Type ke JSON
		));

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ($http_code == 200) {
			redirect('welcome');
		} else {
			echo "Error: Gagal memperbarui data. Kode HTTP: " . $http_code;
		}
	}



	private function get_project_by_id($id)
	{
		$url = "http://localhost:8080/location/".$id;

		// Mengirimkan POST request
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
			'namaLokasi' => $data['namaLokasi'],
			'provinsi' => $data['provinsi'],
			'kota' => $data['kota'],
			'negara' => $data['negara'],
		);
	}
}
