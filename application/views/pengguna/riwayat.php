<div class="row">
	<div class="col-12">
		<h2 class="page-title">Riwayat</h2>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<div class="table-container">
					<table class="table table-bordered table-hover w-100" id="myTable">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th scope="col">Tanggal</th>
								<th scope="col">Kategori</th>
								<th scope="col">Keperluan</th>
								<th scope="col">Nominal</th>
								<th scope="col">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($keuangan)):?>
							<?php $no = 1; foreach($keuangan as $key => $val):?>
							<tr>
								<th scope="row"><?= $no++;?></th>
								<th>
									<?php if($val->kategori == 2):?>
                                        <span class="badge badge-success text-white">Pemasukan</span>
									<?php elseif($val->kategori == 1):?>
                                        <span class="badge badge-warning">Pengeluaran</span>
									<?php elseif($val->kategori == 3):?>
                                        <span class="badge badge-info text-white">Tabungan</span>
									<?php else:?>
                                        <span class="badge badge-secondary text-white">Tidak diketahui</span>
									<?php endif;?>
								</th>
								<td><?= $val->nama;?></td>
								<td><?= date("d F Y", $val->created_at);?></td>
								<td>Rp. <?= number_format($val->nominal);?></td>
								<td><?= $val->keterangan;?></td>
							</tr>
							<?php endforeach;?>
							<?php endif;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
