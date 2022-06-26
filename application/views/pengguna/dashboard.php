<div class="row">
	<div class="col-12">
		<h2 class="page-title ml-0">Dashboard</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-md-12">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="card info-card">
					<div class="card-body">
						<h5 class="card-title">Total Tabungan</h5>
						<div class="info-card-text">
							<h3>Rp. <?= number_format($statistik['tabungan']);?></h3>
							<span class="info-card-helper">Selama <?= $statistik['lama'];?></span>
						</div>
						<div class="info-card-icon">
							<i class="material-icons">account_balance_wallet</i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="card info-card info-info">
					<div class="card-body">
						<h5 class="card-title">Pengingat aktif</h5>
						<div class="info-card-text">
							<h3><?= number_format($statistik['pengingat']);?></h3>
						</div>
						<div class="info-card-icon">
							<i class="material-icons-outlined">notifications_active</i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="card info-card info-success">
					<div class="card-body">
						<h5 class="card-title">Total Pemasukan</h5>
						<div class="info-card-text">
							<h3>Rp. <?= number_format($statistik['pemasukan']);?></h3>
							<span class="info-card-helper">Selama <?= $statistik['lama'];?></span>
						</div>
						<div class="info-card-icon">
							<i class="material-icons">attach_money</i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="card info-card info-warning">
					<div class="card-body">
						<h5 class="card-title">Total Pengeluaran</h5>
						<div class="info-card-text">
							<h3>Rp. <?= number_format($statistik['pengeluaran']);?></h3>
							<span class="info-card-helper">Selama <?= $statistik['lama'];?></span>
						</div>
						<div class="info-card-icon">
							<i class="material-icons">paid</i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Pengeluaran Bulan ini <span class="text-danger">in progress</span></h5>
				<div class="card-info"><a href="#" class="btn btn-xs btn-text-dark"><i
							class="material-icons">refresh</i></a></div>
				<div id="dash-chart-1"><svg></svg></div>
			</div>
		</div>
	</div>
</div>
