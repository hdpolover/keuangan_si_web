<div class="alpha-app">
	<div class="container">
		<div class="login-container">
			<div class="row justify-content-between row align-items-center">
				<div class="col-lg-5 col-md-6">
					<div class="card login-box">
						<div class="card-body">
							<h4 class="text-secondary mb-4">Lupa password</h4>
							<form action="<?= site_url('authentication/proses_lupa');?>" method="post"
								autocomplete="off">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" placeholder="Email" required>
                                    <h6 class="font-weight-light">Silakan masukan email akun untuk mendapatkan link recovery.</h6>
								</div>
								<div class="d-flex mb-3 justify-content-end">
									<button type="submit" class="btn btn-primary" id="send-button">Kirim link</button>
								</div>
								<div class="d-flex">
									<small><a href="<?= site_url('login');?>">Masuk ke akun anda?</a></small>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>