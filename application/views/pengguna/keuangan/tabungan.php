<div class="row">
	<div class="col-12">
		<h2 class="page-title ml-0">Keuangan</h2>
		<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah"><i
				class="material-icons mr-2">add_card</i> Tambah</button>
	</div>
</div>
<br>
<br>
<div class="row mb-3">
	<div class="col">
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="<?= site_url('pengguna/keuangan?p=pemasukan');?>" class="btn btn-info">Pemasukan</a>
			<a href="<?= site_url('pengguna/keuangan?p=pengeluaran');?>" class="btn btn-info">Pengeluaran</a>
			<a href="<?= site_url('pengguna/keuangan?p=tabungan');?>" class="btn btn-primary">Tabungan</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header px-5 pt-2">
				<form action="<?= current_url();?>" method="post">
					<div class="d-flex justify-content-between align-items-center w-50">
						<input type="text" class="form-control mb-0"  name="periode" placeholder="Masukkan periode" style="width: 60%;">
						<button type="submit" class="btn btn-sm btn-info ml-3">tampil</button>
						<?php if($this->input->post('periode')):?>
							<a href="<?= current_url();?>" class="btn btn-sm btn-light ml-3">reset</a>
							<span style="display: flex; width: 100%; margin-left: 15px;">Menampilkan data periode <?= $this->input->post('periode');?></span>
						<?php else:?>
							<span style="width: 100%"></span>
						<?php endif;?>
					</div>
				</form>
			</div>
			<div class="card-body">
				<div class="table-container">
					<table class="table table-bordered table-hover w-100" id="myTable">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="8%">Action</th>
								<th scope="col">Tanggal</th>
								<th scope="col">Keperluan</th>
								<th scope="col">Nominal</th>
								<th scope="col">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php $total = 0; if(!empty($keuangan)):?>
							<?php $no = 1; foreach($keuangan as $key => $val):?>
							<tr>
								<th scope="row"><?= $no++;?></th>
								<td class="text-center">
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
										data-target="#edit-<?= $val->id;?>" style="min-width: 0px;"><i
											class="material-icons"
											style="font-size: 15px; padding: 5px;"
																	onclick="changeKategoriEdit(3,<?= $val->id;?>)">edit</i></button>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
										data-target="#delete-<?= $val->id;?>" style="min-width: 0px;"><i
											class="material-icons"
											style="font-size: 15px; padding: 5px;">delete</i></button>
								</td>
								<td><?= date("d F Y", $val->created_at);?></td>
								<td><?= $val->nama;?></td>
								<td>Rp. <?= number_format($val->nominal);?></td>
								<td><?= $val->keterangan;?></td>

								<div class="modal fade" id="delete-<?= $val->id;?>" tabindex="-1" role="dialog"
									aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Hapus data</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<i class="material-icons">close</i>
												</button>
											</div>
											<div class="modal-body">
												<form
													action="<?= site_url('pengguna/keuangan_hapus/'.$this->input->get('p'));?>"
													method="post">
													<input type="hidden" name="id" value="<?= $val->id;?>">
													<p>Apakah anda yakin ingin menghapus data <b><?= $val->nama;?></b>!
													</p>
													<div class="modal-footer px-0">
														<button type="button" class="btn btn-text-secondary"
															data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-danger" id="send-button">Hapus</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>

								<div class="modal fade" id="edit-<?= $val->id;?>" tabindex="-1" role="dialog"
									aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Edit catatan
													keuangan</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<i class="material-icons">close</i>
												</button>
											</div>
											<div class="modal-body">
												<form
													action="<?= site_url('pengguna/keuangan_edit/'.$this->input->get('p'));?>"
													method="post">
													<input type="hidden" name="id" value="<?= $val->id;?>">
													<div class="row">
														<div class="col-md-6 col-sm-12">
															<div class="form-group">
																<label for="inputNama" class="input-label">Keperluan <small
																		class="text-danger">*</small></label>
																<input type="text" class="form-control" name="nama"
																	id="inputNama" value="<?= $val->nama;?>" required>
															</div>
															<div class="form-group">
																<label for="validationCustomUsername">Nominal <small
																		class="text-danger">*</small></label>
																<div class="input-group">
																	<div class="input-group-prepend">
																		<span class="input-group-text"
																			id="inputGroupPrepend">Rp.</span>
																	</div>
																	<input type="number" class="form-control"
																		id="validationCustomUsername" name="nominal"
																		value="<?= $val->nominal;?>"
																		aria-describedby="inputGroupPrepend" required>
																</div>
															</div>
															<div class="form-group">
																<label for="inputKeterangan"
																	class="input-label">Keterangan <small
																		class="text-secondary">(optional)</small></label>
																<textarea class="form-control" name="keterangan"
																	id="inputKeterangan"
																	rows="4"><?= $val->keterangan;?></textarea>
															</div>
														</div>
														<div class="col-md-6 col-sm-12">
															<label for="inputKategori">Kategori <small
																	class="text-danger">*</small></label>
															<input type="hidden" id="inputKategori-<?= $val->id;?>"
																name="kategori" value="1">
															<div class="custom-control custom-radio pl-0">
																<label class="btn btn-primary"
																	id="kategoriPemasukan-<?= $val->id;?>"
																	onclick="changeKategoriEdit(2,<?= $val->id;?>)">
																	Pemasukan
																</label>
															</div>
															<div class="custom-control custom-radio pl-0">
																<label class="btn btn-text-primary"
																	id="kategoriPengeluaran-<?= $val->id;?>"
																	onclick="changeKategoriEdit(1,<?= $val->id;?>)">
																	Pengeluaran
																</label>
															</div>
															<div class="custom-control custom-radio pl-0">
																<label class="btn btn-text-primary"
																	id="kategoriTabungan-<?= $val->id;?>"
																	onclick="changeKategoriEdit(3,<?= $val->id;?>)">
																	Tabungan
																</label>
															</div>
														</div>
													</div>
													<div class="modal-footer px-0">
														<button type="button" class="btn btn-text-secondary"
															data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-info" id="send-button">Edit</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>

							</tr>
							<?php $total += $val->nominal; endforeach;?>
							<?php endif;?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4"></th>
								<th scope="col">Rp. <?= number_format($total);?></th>
								<th scope="col"></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Tambah catatan keuangan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="material-icons">close</i>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('pengguna/keuangan_tambah/'.$this->input->get('p'));?>" method="post">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label for="inputNama" class="input-label">Keperluan <small
										class="text-danger">*</small></label>
								<input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama"
									required>
							</div>
							<div class="form-group">
								<label for="validationCustomUsername">Nominal <small
										class="text-danger">*</small></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroupPrepend">Rp.</span>
									</div>
									<input type="number" class="form-control" id="validationCustomUsername"
										name="nominal" placeholder="Nominal" aria-describedby="inputGroupPrepend"
										required>
								</div>
							</div>
							<div class="form-group">
								<label for="inputKeterangan" class="input-label">Keterangan <small
										class="text-secondary">(optional)</small></label>
								<textarea class="form-control" name="keterangan" id="inputKeterangan"
									rows="4"></textarea>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<label for="inputKategori">Kategori <small class="text-danger">*</small></label>
							<input type="hidden" id="inputKategori" name="kategori" value="2">
							<div class="custom-control custom-radio pl-0">
								<label class="btn btn-primary" id="kategoriPemasukan" onclick="changeKategori(2)">
									Pemasukan
								</label>
							</div>
							<div class="custom-control custom-radio pl-0">
								<label class="btn btn-text-primary" id="kategoriPengeluaran"
									onclick="changeKategori(1)">
									Pengeluaran
								</label>
							</div>
							<div class="custom-control custom-radio pl-0">
								<label class="btn btn-text-primary" id="kategoriTabungan" onclick="changeKategori(3)">
									Tabungan
								</label>
							</div>
						</div>
					</div>
					<div class="modal-footer px-0">
						<button type="button" class="btn btn-text-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary" id="send-button">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function changeKategoriEdit(kategori, id) {
		console.log(kategori);
		if (kategori == 1) {
			$('#inputKategori-'+id).val(kategori);

			$('#kategoriPengeluaran-'+id).addClass('btn-primary');
			$('#kategoriPemasukan-'+id).addClass('btn-text-primary');
			$('#kategoriTabungan-'+id).addClass('btn-text-primary');

			$('#kategoriPengeluaran-'+id).removeClass('btn-text-primary');
			$('#kategoriPemasukan-'+id).removeClass('btn-primary');
			$('#kategoriTabungan-'+id).removeClass('btn-primary');
		} else if (kategori == 2) {
			$('#inputKategori-'+id).val(kategori);

			$('#kategoriPemasukan-'+id).addClass('btn-primary');
			$('#kategoriPengeluaran-'+id).addClass('btn-text-primary');
			$('#kategoriTabungan-'+id).addClass('btn-text-primary');

			$('#kategoriPemasukan-'+id).removeClass('btn-text-primary');
			$('#kategoriPengeluaran-'+id).removeClass('btn-primary');
			$('#kategoriTabungan-'+id).removeClass('btn-primary');
		} else if (kategori == 3) {
			$('#inputKategori-'+id).val(kategori);

			$('#kategoriTabungan-'+id).addClass('btn-primary');
			$('#kategoriPengeluaran-'+id).addClass('btn-text-primary');
			$('#kategoriPemasukan-'+id).addClass('btn-text-primary');

			$('#kategoriTabungan-'+id).removeClass('btn-text-primary');
			$('#kategoriPengeluaran-'+id).removeClass('btn-primary');
			$('#kategoriPemasukan-'+id).removeClass('btn-primary');
		} else {
			$('#inputKategori-'+id).val(kategori);

			$('#kategoriPemasukan-'+id).addClass('btn-primary');
			$('#kategoriPengeluaran-'+id).addClass('btn-text-primary');
			$('#kategoriTabungan-'+id).addClass('btn-text-primary');

			$('#kategoriPemasukan-'+id).removeClass('btn-text-primary');
			$('#kategoriPengeluaran-'+id).removeClass('btn-primary');
			$('#kategoriTabungan-'+id).removeClass('btn-primary');
		}
	}

	function changeKategori(kategori) {
		console.log(kategori);
		if (kategori == 1) {
			$('#inputKategori').val(kategori);

			$('#kategoriPengeluaran').addClass('btn-primary');
			$('#kategoriPemasukan').addClass('btn-text-primary');
			$('#kategoriTabungan').addClass('btn-text-primary');

			$('#kategoriPengeluaran').removeClass('btn-text-primary');
			$('#kategoriPemasukan').removeClass('btn-primary');
			$('#kategoriTabungan').removeClass('btn-primary');
		} else if (kategori == 2) {
			$('#inputKategori').val(kategori);

			$('#kategoriPemasukan').addClass('btn-primary');
			$('#kategoriPengeluaran').addClass('btn-text-primary');
			$('#kategoriTabungan').addClass('btn-text-primary');

			$('#kategoriPemasukan').removeClass('btn-text-primary');
			$('#kategoriPengeluaran').removeClass('btn-primary');
			$('#kategoriTabungan').removeClass('btn-primary');
		} else if (kategori == 3) {
			$('#inputKategori').val(kategori);

			$('#kategoriTabungan').addClass('btn-primary');
			$('#kategoriPengeluaran').addClass('btn-text-primary');
			$('#kategoriPemasukan').addClass('btn-text-primary');

			$('#kategoriTabungan').removeClass('btn-text-primary');
			$('#kategoriPengeluaran').removeClass('btn-primary');
			$('#kategoriPemasukan').removeClass('btn-primary');
		} else {
			$('#inputKategori').val(kategori);

			$('#kategoriPemasukan').addClass('btn-primary');
			$('#kategoriPengeluaran').addClass('btn-text-primary');
			$('#kategoriTabungan').addClass('btn-text-primary');

			$('#kategoriPemasukan').removeClass('btn-text-primary');
			$('#kategoriPengeluaran').removeClass('btn-primary');
			$('#kategoriTabungan').removeClass('btn-primary');
		}
	}

</script>