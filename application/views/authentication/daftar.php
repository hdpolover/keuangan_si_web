<div class="alpha-app">
	<div class="container">
		<div class="login-container">
			<div class="row justify-content-center row align-items-center">
				<div class="col-lg-5 col-md-6">
					<div class="card login-box">
						<div class="card-body">
							<h5 class="card-title">Daftarkan akun anda</h5>
							<form action="<?= site_url('authentication/proses_daftar');?>" method="post"
								autocomplete="off">
								<div class="form-group">
									<label for="inputNama">Nama <small class="text-danger">*</small></label>
									<input type="text" class="form-control" id="inputNama" name="nama" placeholder="Nama" required>
								</div>
								<div class="form-group">
									<label for="inputEmail">Email <small class="text-danger">*</small></label>
									<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
								</div>
								<div class="form-group">
									<label for="InputPassword">Password <small class="text-danger">*</small></label>
									<input type="password" class="form-control" id="InputPassword" name="password" minlength="8" placeholder="Password" required>
								</div>
								<div class="form-group">
									<label for="inputCpassword">Konfirmasi Password <small class="text-danger">*</small></label>
									<input type="password" class="form-control" id="inputCpassword" name="password_conf" minlength="8" placeholder="Konfirmasi Password" required>
								</div>
								<div class="d-flex justify-content-between">
									<a href="<?= site_url('login');?>" class="btn btn-text-secondary m-r-sm">Masuk</a>
									<button type="submit" class="btn btn-primary" id="send-button">Daftar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
