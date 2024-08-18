<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test-SEI</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<style>
		/* CSS Flexbox untuk tabel responsif */
		.table-responsive {
			display: flex;
			flex-direction: column;
		}
		.table-responsive table {
			width: 100%;
			display: flex;
			flex-direction: column;
		}
		.table-responsive thead {
			display: flex;
			flex-direction: column;
		}
		.table-responsive tbody {
			display: flex;
			flex-direction: column;
		}
		.table-responsive tr {
			display: flex;
			width: 100%;
			justify-content: space-between;
		}
		.table-responsive th, .table-responsive td {
			flex: 1;
			text-align: center;
			padding: 8px;
		}
		.table-responsive th {
			background-color: #343a40;
			color: white;
		}
		.table-responsive td {
			background-color: #f8f9fa;
		}
		/* Toast notification styling */
		.toast {
			position: fixed;
			top: 20px;
			right: 20px;
			min-width: 300px;
		}
	</style>
</head>
<script>
	function showToast(message, type) {
		const toast = document.createElement('div');
		toast.className = `toast align-items-center text-white bg-${type} border-0`;
		toast.role = 'alert';
		toast.ariaLive = 'assertive';
		toast.ariaAtomic = 'true';

		toast.innerHTML = `
			<div class="d-flex">
				<div class="toast-body">
					${message}
				</div>
				<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		`;

		document.body.appendChild(toast);

		const bootstrapToast = new bootstrap.Toast(toast);
		bootstrapToast.show();

		// Hapus toast setelah selesai tampil
		toast.addEventListener('hidden.bs.toast', () => {
			toast.remove();
		});
	}

	function deleteItem(id, type) {
		if (confirm('Are you sure?')) {
			var xhr = new XMLHttpRequest();
			var url = type === 'project' ? '<?= site_url('welcome/delete_project/'); ?>' : '<?= site_url('welcome/delete_location/'); ?>';
			xhr.open('POST', url + id, true);
			xhr.setRequestHeader('Content-Type', 'application/json');
			xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					console.log("Status:", xhr.status); // Log status HTTP
					console.log("Response Text:", xhr.responseText); // Log respons dari server

					try {
						var response = JSON.parse(xhr.responseText);
						console.log("Parsed Response:", response); // Log hasil parsing JSON

						if (xhr.status === 200 && response.success === true) {
							var row = document.querySelector('tr[data-id="' + id + '"]');
							row.parentNode.removeChild(row);
							showToast('Data ' + (type === 'project' ? 'proyek' : 'lokasi') + ' berhasil dihapus', 'success');
						} else {
							showToast('Gagal menghapus data ' + (type === 'project' ? 'proyek' : 'lokasi'), 'danger');
						}
					} catch (e) {
						console.error("Error parsing JSON:", e); // Log jika terjadi kesalahan parsing
						showToast('Terjadi kesalahan pada respons server', 'danger');
					}
				}
			};
			xhr.onerror = function() {
				console.error("Network or server error"); // Log jika ada kesalahan jaringan
				showToast('Terjadi kesalahan jaringan atau server', 'danger');
			};
			xhr.send();
		}
	}

	function deleteProject(id) {
		deleteItem(id, 'project');
	}

	function deleteLocation(id) {
		deleteItem(id, 'location');
	}
</script>


<body>
<div class="container mt-5">
	<h2>Tabel Proyek</h2>
	<a href="<?= base_url('project'); ?>" class="btn btn-primary mb-3">
		<i class="fas fa-plus-circle"></i> Tambah Proyek
	</a>

	<div class="table-responsive">
		<table>
			<thead>
			<tr>
				<th>ID</th>
				<th>Name Proyek</th>
				<th>Client</th>
				<th>Pimpinan</th>
				<th>Tgl. Mulai</th>
				<th>Tgl. Selesai</th>
				<th>Keterangan</th>
				<th>Dibuat</th>
				<th>Aksi</th>
			</tr>
			</thead>
			<tbody>
			<?php if(!empty($proyek)): ?>
				<?php foreach($proyek as $p): ?>
					<tr data-id="<?php echo $p['id']; ?>">
						<td><?php echo $p['id']; ?></td>
						<td><?php echo $p['namaProyek']; ?></td>
						<td><?php echo $p['client']; ?></td>
						<td><?php echo $p['pimpinanProyek']; ?></td>
						<td><?php echo $p['tglMulai']; ?></td>
						<td><?php echo $p['tglSelesai']; ?></td>
						<td><?php echo $p['keterangan']; ?></td>
						<td><?php echo $p['createdAt']; ?></td>
						<td>
							<a href="<?= base_url('Edit_Project/edit/'.$p['id']); ?>" class="btn btn-warning btn-sm">
								<i class="fas fa-edit"></i> Edit
							</a>

							<button class="btn btn-danger btn-sm" onclick="deleteProject(<?php echo $p['id']; ?>)">
								<i class="fas fa-trash-alt"></i> Delete
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="9">No data found</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="container mt-5">
	<h2>Tabel Lokasi</h2>
	<a href="<?= site_url('location'); ?>" class="btn btn-primary mb-3">
		<i class="fas fa-plus-circle"></i> Tambah Lokasi
	</a>
	<div class="table-responsive">
		<table>
			<thead>
			<tr>
				<th>ID</th>
				<th>Name Lokasi</th>
				<th>Kota</th>
				<th>Provinsi</th>
				<th>Negara</th>
				<th>Dibuat</th>
				<th>Aksi</th>
			</tr>
			</thead>
			<tbody>
			<?php if(!empty($location)): ?>
				<?php foreach($location as $p): ?>
					<tr data-id="<?php echo $p['id']; ?>">
						<td><?php echo $p['id']; ?></td>
						<td><?php echo $p['namaLokasi']; ?></td>
						<td><?php echo $p['kota']; ?></td>
						<td><?php echo $p['provinsi']; ?></td>
						<td><?php echo $p['negara']; ?></td>
						<td><?php echo $p['createdAt']; ?></td>
						<td>
							<a href="<?= base_url('Edit_Location/edit/'.$p['id']); ?>" class="btn btn-warning btn-sm">
								<i class="fas fa-edit"></i> Edit
							</a>

							<button class="btn btn-danger btn-sm" onclick="deleteProject(<?php echo $p['id']; ?>)">
								<i class="fas fa-trash-alt"></i> Delete
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="9">No data found</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Tambahkan JavaScript Bootstrap dan FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
