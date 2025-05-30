<?php
	include 'header.php';
	include 'koneksi.php'; 
?>

<div class="container">	
	<br/>
	<div class="col-md-4 col-md-offset-4">
		<?php 
			if(isset($_GET['pesan'])){
				if($_GET['pesan'] == "username_sudah_terdaftar"){
		?>
					<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						Username Sudah Terdaftar!
					</div>
				<?php
					}else if($_GET['pesan'] == "data_belum_lengkap"){
				?>
						<div class="alert alert-danger fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							Data Belum Lengkap!
						</div>
					<?php
						}
			}
		?>	
		<div class="panel">
			<div class="panel-heading">
				<h4>Daftar Member</h4>
			</div>
			<div class="panel-body">
				<form method="post" action="daftar_aksi.php">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukkan nama ..">
					</div>	
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" placeholder="Masukkan username ..">
					</div>	
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" placeholder="Masukkan password ..">
					</div>	
					<div class="form-group">
						<label>HP</label>
						<input type="text" class="form-control" name="hp" placeholder="Masukkan no.hp ..">
					</div>	
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat ..">
					</div>	
					<tr>
					        <td colspan="2" align="center">Sudah Punya akun? <a href="form_login.php"><b>Login</b></a></td>
				        </tr>
                        <br/>
					<input type="submit" class="btn btn-primary" value="Daftar">	
				</form>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>