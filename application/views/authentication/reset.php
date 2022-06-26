<div class="alpha-app">
	<div class="container">
		<div class="login-container">
			<div class="row justify-content-between row align-items-center">
				<div class="col-lg-5 col-md-6">
					<div class="card login-box">
						<div class="card-body">
							<h4 class="text-secondary mb-4">Reset password</h4>
							<form action="<?= site_url('authentication/proses_reset');?>" method="post"
								autocomplete="off">
                                <input type="hidden" name="user_id" value="<?= $user_id;?>">  
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" value="<?= $email;?>" readonly>
								</div>
								<div class="form-group">
									<label for="InputPassword">Password <small class="text-danger">*</small></label>
									<input type="password" class="form-control" id="InputPassword" name="password" minlength="8" placeholder="Password" required>
								</div>
								<div class="form-group">
									<label for="inputCpassword">Konfirmasi Password <small class="text-danger">*</small></label>
									<input type="password" class="form-control" id="inputCpassword" name="password_conf" minlength="8" placeholder="Konfirmasi Password" required>
								</div>
								<div class="d-flex mb-3 justify-content-end">
									<button type="submit" class="btn btn-primary" id="send-button">Ubah password</button>
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