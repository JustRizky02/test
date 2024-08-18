<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Lokasi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
	<h2>Tambah Lokasi</h2>
	<form id="formTambahLocation" action="<?= site_url('Post_Location'); ?>" method="POST">
		<div class="form-group">
			<label for="id">ID</label>
			<input type="text" name="id" class="form-control" id="id" placeholder="ID" readonly>
		</div>
		<div class="form-group">
			<label for="namaLokasi">Nama Lokasi</label>
			<input type="text" name="namaLokasi" class="form-control" id="namaLokasi" placeholder="Masukkan nama lokasi" required>
		</div>
		<div class="form-group">
			<label for="kota">Kota</label>
			<input type="text" name="kota" class="form-control" id="kota" placeholder="Masukkan nama kota" required>
		</div>
		<div class="form-group">
			<label for="provinsi">Provinsi</label>
			<input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="Masukkan nama provinsi" required>
		</div>
		<div class="form-group">
			<label for="negara">Negara</label>
			<input type="text" name="negara" class="form-control" id="negara" placeholder="Masukkan nama negara" required>
		</div>
		<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
		<a href="<?= site_url(''); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
