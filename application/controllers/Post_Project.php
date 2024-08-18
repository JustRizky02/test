<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_Project extends CI_Controller {

	public function index()
	{
		// Mengambil data dari form
		$data = array(
			'id' => $this->input->post('id'),
			'namaProyek' => $this->input->post('namaProyek'),
			'client' => $this->input->post('client'),
			'pimpinanProyek' => $this->input->post('pimpinanProyek'),
			'tglMulai' => $this->input->post('tglMulai'),
			'tglSelesai' => $this->input->post('tglSelesai'),
			'keterangan' => $this->input->post('keterangan')
		);

		// Mengubah data menjadi JSON
		$jsonData = json_encode($data);

		// URL endpoint untuk mengirimkan data proyek baru
		$url = "http://localhost:8080/proyek";

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
			redirect('welcome?status=success&message=Proyek berhasil ditambahkan.');
		} else {
			redirect('Post_Project?status=error&message=Gagal menambahkan proyek. Status: ' . $httpCode);
		}
	}
}
