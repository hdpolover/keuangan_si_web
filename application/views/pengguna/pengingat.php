<div class="row">
	<div class="col-12">
		<h2 class="page-title ml-0">Pengingat</h2>
		<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah"><i
				class="material-icons mr-2">notification_add</i> Tambah</button>
	</div>
</div>
<div class="row">
	<?php if(!empty($pengingat)):?>
	<?php foreach($pengingat as $key => $val):?>
	<div class="col-md-4">
		<div class="card h-100 mb-4">
			<div class="card-body">
				<div class="d-flex justify-content-between">
					<h5><?= $val->nama;?></h5>
					<h5><?= date("d F Y", $val->tanggal);?></h5>
				</div>
				<p class="card-text h3 mb-4">Rp. <?= number_format($val->tagihan);?></p>
				<?php if($val->bulanan == 1):?>
				<button type="button" class="btn btn-warning btn-sm waves-effect waves-light float-right ml-2"
					data-toggle="modal" data-target="#bulanan-matikan-<?= $val->id;?>">matikan pengingat bulanan</button>
				<?php else:?>
				<button type="button" class="btn btn-info btn-sm waves-effect waves-light float-right ml-2"
					data-toggle="modal" data-target="#bulanan-<?= $val->id;?>">ingatkan tiap bulan</button>
				<?php endif;?>
				<?php if($val->status == 0):?>
				<span class="badge badge-warning">Belum Dibayar</span>
				<?php endif;?>
				<?php if ($val->status == 1):?>
				<span class="btn btn-text-success btn-sm waves-effect waves-light float-right">Sudah Dibayar</span>
				<?php else:?>
				<button type="button" class="btn btn-secondary btn-sm waves-effect waves-light float-right"
					data-toggle="modal" data-target="#bayar-<?= $val->id;?>">bayar</button>
				<?php endif;?>
				<?php if(time() > $val->tanggal):?>
					<small class="text-danger" style="position: absolute; bottom: 10px; left: 20px">Tagihan ini melebihi batas waktu pengingat, segera bayar tagihan
						anda</small>
				<?php endif;?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="bayar-<?= $val->id;?>" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Bayar tagihan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="material-icons">close</i>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= site_url('pengguna/pengingat_bayar');?>" method="post">
						<input type="hidden" name="id" value="<?= $val->id;?>">
						<input type="hidden" name="nama" value="<?= $val->nama;?>">
						<input type="hidden" name="nominal" value="<?= $val->tagihan;?>">
						<input type="hidden" name="kategori" value="1">
						<input type="hidden" name="keterangan" value="Pembayaran tagihan rutin">
						<p>Jika anda sudah membayar pengingat ini, anda dapat mengubah status pengingat menjadi sudah
							dibayarkan!</p>
						<div class="modal-footer px-0">
							<button type="button" class="btn btn-text-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Sudah dibayar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="bulanan-<?= $val->id;?>" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Pengingat bulanan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="material-icons">close</i>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= site_url('pengguna/pengingat_bulanan');?>" method="post">
						<input type="hidden" name="id" value="<?= $val->id;?>">
						<p>Nonaktifkan pengingat bulanan untuk tagihan ini? setiap bulannya saat mendekati tanggal pengingat tagihan akan otomatis berubah kedalam status belum dibayar.</p>
						<div class="modal-footer px-0">
							<button type="button" class="btn btn-text-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Aktifkan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="bulanan-matikan-<?= $val->id;?>" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Pengingat bulanan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="material-icons">close</i>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= site_url('pengguna/pengingat_bulanan_mati');?>" method="post">
						<input type="hidden" name="id" value="<?= $val->id;?>">
						<p>Non-Aktifkan pengingat bulanan untuk tagihan ini?</p>
						<div class="modal-footer px-0">
							<button type="button" class="btn btn-text-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Non-Aktifkan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach;?>
	<?php else:?>
	<div class="col text-center mt-5">
		<h3>Belum ada pengingat apapun!</h3>
	</div>
	<?php endif;?>
</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Tambah data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="material-icons">close</i>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('pengguna/pengingat_tambah');?>" method="post">
					<div class="form-group">
						<label for="inputNama" class="input-label">Nama pengingat <small
								class="text-danger">*</small></label>
						<input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" required>
					</div>
					<div class="form-group">
						<label for="validationCustomUsername">Nominal <small class="text-danger">*</small></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupPrepend">Rp.</span>
							</div>
							<input type="number" class="form-control" id="validationCustomUsername" name="nominal"
								placeholder="Nominal" aria-describedby="inputGroupPrepend" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputTanggal" class="input-label">Tanggal <small
								class="text-danger">*</small></label>
						<input type="date" class="form-control mb-0" name="tanggal" id="inputTanggal"
							placeholder="Tanggal" required>
						<small class="text-muted">Atur tanggal pengingat ini akan aktif</small>
					</div>
					<div class="modal-footer px-0">
						<button type="button" class="btn btn-text-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
