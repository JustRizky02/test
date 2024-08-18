<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_Location extends CI_Controller {

	public function index()
	{
		// Mengambil data dari form
		$data = array(
			'id' => $this->input->post('id'),
			'namaLokasi' => $this->input->post('namaLokasi'),
			'kota' => $this->input->post('kota'),
			'provinsi' => $this->input->post('provinsi'),
			'negara' => $this->input->post('negara')
		);

		// Mengubah data menjadi JSON
		$jsonData = json_encode($data);

		// URL endpoint untuk mengirimkan data lokasi baru
		$url = "http://localhost:8080/location";

		// Mengirimkan POST request
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($jsonData)
		));

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		// Redirect dengan query string untuk mengirimkan pesan
		if ($httpCode == 200 || $httpCode == 201) {
			redirect('welcome?status=success&message=Lokasi berhasil ditambahkan.');
		} else {
			redirect('Post_Location?status=error&message=Gagal menambahkan lokasi. Status: ' . $httpCode);
		}
	}
}
