<div class="alpha-app">
	<div class="container">
		<div class="login-container">
			<div class="row justify-content-between row align-items-center">
				<div class="col-lg-7 col-md-6">
				</div>
				<div class="col-lg-5 col-md-6">
					<div class="card login-box">
						<div class="card-body">
							<h4 class="text-secondary mb-4">Selamat Datang</h4>
							<?php if($verifikasi == 1):?>
								<div class="alert alert-soft-primary">
									Harap melakukan verifikasi email, dengan mengakses link yang telah dikirim ke email anda terlebih dahulu!
								</div>
							<?php endif;?>
							<form action="<?= site_url('authentication/proses_login');?>" method="post"
								autocomplete="off">
								<div class="form-group">
									<label for="email">Email/Username</label>
									<input type="text" class="form-control" id="email" name="email" placeholder="Email/Username" required>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" minlength="8" name="password" placeholder="Password" required>
								</div>
								<div class="d-flex mb-3 justify-content-between">
									<a href="<?= site_url('daftar');?>" class="btn btn-text-secondary m-r-sm">Daftar
										akun baru</a>
									<button type="submit" class="btn btn-primary" id="send-button">Masuk</button>
								</div>
								<!-- <div class="d-flex">
									<small><a href="<?= site_url('lupa');?>">Lupa password?</a></small>
								</div> -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
