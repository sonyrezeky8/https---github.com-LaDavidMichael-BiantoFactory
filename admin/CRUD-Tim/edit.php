<?php
session_start();
include('../includes/config.php');
error_reporting(0);
?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Edit Data</font>
	</center>

	<hr>

	<?php
	//jika sudah mendapatkan parameter GET id dari URL
	if (isset($_GET['id'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$id = $_GET['id'];

		//query ke database SELECT tabel artikel berdasarkan id = $id
		$select = mysqli_query($koneksidb, "SELECT * FROM team WHERE id='$id'") or die(mysqli_error($koneksidb));

		//jika hasil query = 0 maka muncul pesan error
		if (mysqli_num_rows($select) == 0) {
			echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
			exit();
			//jika hasil query > 0
		} else {
			//membuat variabel $data dan menyimpan data row dari query
			$data = mysqli_fetch_assoc($select);
		}
	}
	?>

	<?php
	//jika tombol simpan di tekan/klik
	if (isset($_POST['submit'])) {


		$id = $_POST['id'];

		//query ke database SELECT tabel artikel berdasarkan id = $id
		$query = mysqli_query($koneksidb, "SELECT * FROM team WHERE id='$id'") or die(mysqli_error($koneksidb));

		// ini untuk "fetch" data dari db gais
		// jadi bisa diambil pake arah panah (->)
		$data = mysqli_fetch_object($query);
		$path = getcwd() . "/assets/images/" . $data->fotosampul;

		unlink($path); // ini proses delete file nya gais

		$target_dir = "assets/images/";
		$target_file = $target_dir . basename($_FILES["foto"]["name"]);

		/**
		 * ini untuk upload filenya gais
		 */
		$upload = move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

		/**
		 * jika file nya gagal di upload gais, maka dia berhenti gais
		 * dengan perintah die() itu gais
		 */
		if (!$upload) {
			print_r([$upload, $_FILES["foto"]["error"]]);

			die();
		}
		
		$nama			= $_POST['nama'];
		$jabatan		= $_POST['jabatan'];
		$deskripsi      = $_POST['deskripsi'];
		$foto			= $_FILES['foto']["name"];

		$sql = mysqli_query($koneksidb, "UPDATE team SET nama='$nama', jabatan='$jabatan', deskripsi='$deskripsi', foto='$foto' WHERE id='$id'") or die(mysqli_error($koneksidb));

		if ($sql) {
			echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampiltim";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
		}
	}


	?>
	<form action="dashboard.php?page=edittim&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
		
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Nama</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Jabatan</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="jabatan" class="form-control" value="<?php echo $data['jabatan']; ?>" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi</label>
			<div class="col-md-6 col-sm-6">
				<!-- <input type="text" name="deskripsi" class="form-control"  required> -->
				<textarea name="deskripsi" class="form-control"> <?php echo $data['deskripsi']; ?> </textarea>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Foto </label>
			<div class="col-md-6 col-sm-6">
				<img src="assets/images/<?php echo $data['foto']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
				<input type="file" name="foto" class="form-control">
			</div>
		</div>

		<div class="item form-group">
			<div class="col-md-6 col-sm-6 offset-md-3">
				<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
				<a href="dashboard.php?page=tampiltim" class="btn btn-warning">Kembali</a>
			</div>
		</div>
	</form>
</div>