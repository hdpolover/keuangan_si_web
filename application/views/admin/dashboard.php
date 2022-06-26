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
						<h5 class="card-title">Total Pengguna</h5>
						<div class="info-card-text">
							<h3>Rp. <?= number_format($statistik['pengguna']);?></h3>
						</div>
						<div class="info-card-icon">
							<i class="material-icons">people</i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="card info-card info-success">
					<div class="card-body">
						<h5 class="card-title">Total Keuangan</h5>
						<div class="info-card-text">
							<h3><?= number_format($statistik['keuangan']);?></h3>
							<span class="info-card-helper">Pemasukan, Pengeluaran dan Tabungan</span>
						</div>
						<div class="info-card-icon">
							<i class="material-icons-outlined">account_balance_wallet</i>
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
