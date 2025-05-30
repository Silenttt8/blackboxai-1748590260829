<?php
	include 'header.php';
	include 'koneksi.php'; 
?>

<div class="container">
	<br/>
		<div class="col-md-4 col-md-offset-4">
			<?php 
				if(isset($_GET['pesan'])){
					if($_GET['pesan'] == "berhasil_daftar"){
			?>
						<div class="alert alert-success fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							Pendaftaran Berhasil! Silahkan Login
						</div>		
					<?php
						}else if($_GET['pesan'] == "gagal_login"){
					?>
							<div class="alert alert-danger fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Username atau Password Salah!
							</div>
						<?php
							}else if($_GET['pesan'] == "berhasil_logout"){
						?>
								<div class="alert alert-success fade in">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									Logout Berhasil!
								</div>
							<?php
								}else if($_GET['pesan'] == "akses_ditolak"){
							?>
									<div class="alert alert-danger fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										Silahkan Login Terlebih Dahulu!
									</div>
			<?php
									}
				}
			?>				
			
			<form action="login_aksi.php" method="post">
				<div class="panel">
                <div class="panel-heading">
				<h4>Login</h4>
			</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" placeholder="Masukkan username ..">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" placeholder="Masukkan password ..">
						</div>
                        <tr>
					        <td colspan="2" align="center">Belum Punya akun ? <a href="form_daftar.php"><b>Daftar</b></a></td>
				        </tr>
                        <br/>
						<input type="submit" class="btn btn-primary" value="Log In">				
					</div>
					<br/>
				</div>
			</form>

		</div>
	</div>
<?php include 'footer.php'; ?>