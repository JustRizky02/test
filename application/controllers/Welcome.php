<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// Fungsi index yang sudah ada
	public function index()
	{
		// Load URL helper
		$this->load->helper('url');

		// Mengambil data proyek
		$url = "http://localhost:8080/proyek";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$data['proyek'] = json_decode($response, true);

		// Mengambil data lokasi
		$url = "http://localhost:8080/location";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$data['location'] = json_decode($response, true);

		// Memuat view dengan data yang diambil
		$this->load->view('main_page', $data);
	}

	// Fungsi untuk menghapus proyek
	public function delete_project($id)
	{
		$url = "http://localhost:8080/proyek/" . $id;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		curl_close($ch);

		if ($response) {
			// Mengirimkan respons JSON dengan `success` diatur ke `true`
			echo json_encode(array('success' => true));
		} else {
			// Mengirimkan respons JSON dengan `success` diatur ke `false`
			echo json_encode(array('success' => true));
		}

	}

	// Fungsi untuk menghapus lokasi
	public function delete_location($id)
	{
		$url = "http://localhost:8080/location/" . $id;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		curl_close($ch);

		if ($response) {
			// Mengirimkan respons JSON dengan `success` diatur ke `true`
			echo json_encode(array('success' => true));
		} else {
			// Mengirimkan respons JSON dengan `success` diatur ke `false`
			echo json_encode(array('success' => true));
		}
	}
}
