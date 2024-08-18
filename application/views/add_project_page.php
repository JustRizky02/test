<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Proyek</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
	<h2>Tambah Proyek</h2>
	<form id="formTambahProyek" action="<?= site_url('Post_Project'); ?>" method="POST">
		<!-- Form fields seperti yang sudah ada -->
		<div class="form-group">
			<label for="id">ID</label>
			<input type="text" class="form-control" id="id" placeholder="Masukan ID" name="id" readonly>
		</div>
		<div class="form-group">
			<label for="namaProyek">Nama Proyek</label>
			<input type="text" class="form-control" id="namaProyek" placeholder="Masukkan nama proyek" name="namaProyek">
		</div>
		<div class="form-group">
			<label for="client">Client</label>
			<input type="text" class="form-control" id="client" placeholder="Masukkan nama client" name="client">
		</div>
		<div class="form-group">
			<label for="pimpinanProyek">Pimpinan</label>
			<input type="text" class="form-control" id="pimpinanProyek" placeholder="Masukkan nama pimpinan proyek" name="pimpinanProyek">
		</div>
		<div class="form-group">
			<label for="tglMulai">Tanggal Mulai</label>
			<input type="date" class="form-control" id="tglMulai" name="tglMulai">
		</div>
		<div class="form-group">
			<label for="tglSelesai">Tanggal Selesai</label>
			<input type="date" class="form-control" id="tglSelesai" name="tglSelesai">
		</div>
		<div class="form-group">
			<label for="keterangan">Keterangan</label>
			<textarea class="form-control" id="keterangan" rows="3" placeholder="Tambahkan keterangan" name="keterangan"></textarea>
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
