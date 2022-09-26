<div class="row">
	<div class="col-12">
		<h2 class="page-title ml-0">Dashboard</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-3 col-md-3">
		<div class="card info-card">
			<div class="card-body">
				<h5 class="card-title">Total Tabungan</h5>
				<div class="info-card-text">
					<h3>Rp. <?= number_format($statistik['tabungan']);?></h3>
					<!-- <span class="info-card-helper">Selama <?= $statistik['lama'];?> hari</span> -->
				</div>
				<div class="info-card-icon">
					<i class="material-icons">account_balance_wallet</i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
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
	<div class="col-lg-3 col-md-3">
		<div class="card info-card info-success">
			<div class="card-body">
				<h5 class="card-title">Total Pemasukan</h5>
				<div class="info-card-text">
					<h3>Rp. <?= number_format($statistik['pemasukan']);?></h3>
					<!-- <span class="info-card-helper">Selama <?= $statistik['lama'];?></span> -->
				</div>
				<div class="info-card-icon">
					<i class="material-icons">attach_money</i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="card info-card info-warning">
			<div class="card-body">
				<h5 class="card-title">Total Pengeluaran</h5>
				<div class="info-card-text">
					<h3>Rp. <?= number_format($statistik['pengeluaran']);?></h3>
					<!-- <span class="info-card-helper">Selama <?= $statistik['lama'];?></span> -->
				</div>
				<div class="info-card-icon">
					<i class="material-icons">paid</i>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Pemasukan</h5>
				<div id="chartGraphKeuangan"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Pengeluaran</h5>
				<div id="chartGraphKeuanganPengeluaran"></div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		var graphKeuangan = {
			chart: {
				type: 'area'
			},
			series: [{
				data: [<?= implode(',', $arrChartPemasukan['nominal']) ?>]
			}],
			stroke: {
				curve: 'smooth'
			},
			xaxis: {
				categories: [<?= implode(',', $arrChartPemasukan['nominal']) ?>]
			}
		};
		var graphKeuanganPengeluaran = {
			chart: {
				type: 'area'
			},
			series: [{
				data: [<?= implode(',', $arrChartPengeluaran['nominal']) ?>]
			}],
			stroke: {
				curve: 'smooth'
			},
			xaxis: {
				categories: [<?= implode(',', $arrChartPengeluaran['nominal']) ?>]
			}
		};

		var chartGraphKeuangan = new ApexCharts(document.querySelector("#chartGraphKeuangan"), graphKeuangan);
		chartGraphKeuangan.render();

		var chartGraphKeuanganPengeluaran = new ApexCharts(document.querySelector("#chartGraphKeuanganPengeluaran"), graphKeuanganPengeluaran);
		chartGraphKeuanganPengeluaran.render();
	})

</script>
