<div class="row">
	<div class="col-12">
		<h2 class="page-title">Pengguna</h2>
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
								<th scope="col">Nama</th>
								<th scope="col">Email</th>
								<th scope="col">Terakhir login</th>
								<th scope="col">Total Keuangan</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($pengguna)):?>
							<?php $no = 1; foreach($pengguna as $key => $val):?>
							<tr>
								<th scope="row"><?= $no++;?></th>
								<td><?= $val->nama;?></td>
								<td><?= $val->email;?></td>
								<td><?= date("d F Y - H:i", $val->log_time);?></td>
								<td>Rp. <?= number_format($this->M_admin->get_nominal($val->user_id));?></td>
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
