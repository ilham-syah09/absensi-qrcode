<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addJadwal">Add Jadwal</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="example">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Nama Shift</th>
									<th>Tanggal Awal</th>
									<th>Tanggal Akhir</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($jadwal as $dt) : ?>
									<tr>
										<td class="text-center"><?= $i++; ?></td>
										<td><?= $dt->nama; ?></td>
										<td><?= date('d M Y', strtotime($dt->tanggalAwal)); ?></td>
										<td><?= date('d M Y', strtotime($dt->tanggalAkhir)); ?></td>
										<td>
											<a href="#" class="badge badge-info list_btn" data-toggle="modal" data-target="#listPegawai" data-id="<?= $dt->id; ?>">List Pegawai</a>
											<a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editJadwal" data-id="<?= $dt->id; ?>" data-idshift="<?= $dt->idShift; ?>" data-tanggalawal="<?= $dt->tanggalAwal; ?>" data-tanggalakhir="<?= $dt->tanggalAkhir; ?>">Edit</a>
											<a href="<?= base_url('admin/jadwal/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<!-- modal add -->
<div class="modal fade" id="addJadwal" tabindex="-1" role="dialog" aria-labelledby="addJadwalTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Jadwal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/jadwal/add'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Shift</label>
								<select name="idShift" class="form-control" id="shift">
									<option value="">-- Pilih Shift --</option>
									<?php foreach ($shift as $s) : ?>
										<option value="<?= $s->id; ?>"><?= $s->nama; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Tanggal Awal</label>
								<input type="date" class="form-control" name="tanggalAwal" id="tanggalAwal">
							</div>
							<div class="form-group">
								<label>Tanggal Akhir</label>
								<input type="date" class="form-control" name="tanggalAkhir" id="tanggalAkhir">
							</div>
						</div>
						<div class="col-md-12">
							<center>
								<div class="spinner-border text-dark mt-4 mb-4 d-none" id="loader" role="status">
									<span class="sr-only">Loading...</span>
								</div>
							</center>
							<div class="form-group">
								<div id="tampil" class="d-none">
									<label>Pegawai</label>
									<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
										<table class="table table-bordered table-hover table-vcenter" id="tabel_pegawai">
											<thead>
												<tr>
													<th class="text-center">#</th>
													<th>Nama Pegawai</th>
													<th>
														<center><input type="checkbox" id="check-all"></center>
													</th>
												</tr>
											</thead>
											<tbody id="isi_table">

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal list pegawai -->
<div class="modal fade" id="listPegawai" tabindex="-1" role="dialog" aria-labelledby="listPegawaiTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">List Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div id="tampil-list" class="d-none">
								<label>Pegawai</label>
								<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
									<table class="table table-bordered table-hover table-vcenter" id="tabel_pegawai-list">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Nama Pegawai</th>
											</tr>
										</thead>
										<tbody id="isi_table-list">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editJadwal" tabindex="-1" role="dialog" aria-labelledby="editJadwalTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Jadwal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/jadwal/edit'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="idJadwal" id="idJadwal">
							<div class="form-group">
								<label>Nama Shift</label>
								<select name="idShift" class="form-control" id="shift-edit">
									<option value="">-- Pilih Shift --</option>
									<?php foreach ($shift as $s) : ?>
										<option value="<?= $s->id; ?>"><?= $s->nama; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Tanggal Awal</label>
								<input type="date" class="form-control" name="tanggalAwal" id="tanggalAwal-edit">
							</div>
							<div class="form-group">
								<label>Tanggal Akhir</label>
								<input type="date" class="form-control" name="tanggalAkhir" id="tanggalAkhir-edit">
							</div>
						</div>
						<div class="col-md-12">
							<center>
								<div class="spinner-border text-dark mt-4 mb-4 d-none" id="loader-edit" role="status">
									<span class="sr-only">Loading...</span>
								</div>
							</center>
							<div class="form-group">
								<div id="tampil-edit" class="d-none">
									<label>Pegawai</label>
									<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
										<table class="table table-bordered table-hover table-vcenter" id="tabel_pegawai-edit">
											<thead>
												<tr>
													<th class="text-center">#</th>
													<th>Nama Pegawai</th>
													<th>
														<center><input type="checkbox" id="check-all-edit"></center>
													</th>
												</tr>
											</thead>
											<tbody id="isi_table-edit">

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let list_btn = $('.list_btn');

	$(list_btn).each(function(i) {
		$(list_btn[i]).click(function() {
			let id = $(this).data('id');

			$.ajax({
				url: `<?= base_url('admin/jadwal/getListPegawai/'); ?>${id}`,
				type: 'get',
				dataType: 'json',
				async: true,
				beforeSend: function(e) {
					$('#loader-list').removeClass('d-none');
					$('#tampil-list').addClass('d-none');
				},
				success: function(res) {

					$('#tampil-list').removeClass('d-none');
					$('.tr_isi-list').remove();

					if (res != null) {
						$(res).each(function(i) {
							$("#tabel_pegawai-list").append(
								"<tr class=" + "tr_isi-list" + ">" +
								"<td class='text-center'>" + (i + 1) + "</td>" +
								"<td>" + res[i].nama + "</td>" +
								"<tr>");
						});
					} else {
						$("#tabel_pegawai-list").append(
							"<tr class=" + "tr_isi-list" + ">" +
							"<td colspan='3' class='text-center'>Kosong</td>" +
							"<tr>");
					}
				},
				complete: function() {
					$('#tampil-list').removeClass('d-none');
					$('#loader-list').addClass('d-none');
				}
			});
		});
	});

	$('#shift').change(function() {
		$('#loader').addClass('d-none');
		$('#tampil').addClass('d-none');
	});

	$('#tanggalAwal').change(function() {
		$('#loader').addClass('d-none');
		$('#tampil').addClass('d-none');
	});

	$('#tanggalAkhir').change(function() {
		let shift = $('#shift').val();
		let tanggalAwal = $('#tanggalAwal').val();
		let tanggalAkhir = $(this).val();

		if (tanggalAwal === '' || shift === '') {
			toastr.warning('Isi kolom dengan benar');

			return 0;
		}

		if (tanggalAwal > tanggalAkhir) {
			toastr.warning('Tanggal awal tidak boleh melebihi tanggal akhir');

			return 0;
		}

		let data = {
			tanggalAwal,
			tanggalAkhir
		};

		$.ajax({
			url: "<?= base_url('admin/jadwal/getPegawai'); ?>",
			type: 'get',
			dataType: 'json',
			data: data,
			async: true,
			beforeSend: function(e) {
				$('#loader').removeClass('d-none');
				$('#tampil').addClass('d-none');
			},
			success: function(res) {
				console.log(res);

				$('#tampil').removeClass('d-none');
				$('.tr_isi').remove();

				if (res.pegawai != null) {
					$(res.pegawai).each(function(i) {
						$("#tabel_pegawai").append(
							"<tr class=" + "tr_isi" + ">" +
							"<td class='text-center'>" + (i + 1) + "</td>" +
							"<td>" + res.pegawai[i].nama + "</td>" +
							"<td>" +
							`<center>
                                    <input type="checkbox" class="check-item" name="idPegawai[]" value="` + res.pegawai[i].id + `">
                            </center>` +
							"</td>" +
							"<tr>");
					});
				} else {
					$("#tabel_pegawai").append(
						"<tr class=" + "tr_isi" + ">" +
						"<td colspan='3' class='text-center'>Kosong</td>" +
						"<tr>");
				}
			},
			complete: function() {
				$('#tampil').removeClass('d-none');
				$('#loader').addClass('d-none');
			}
		});
	});

	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let shift = $(this).data('idshift');
			let tanggalAwal = $(this).data('tanggalawal');
			let tanggalAkhir = $(this).data('tanggalakhir');

			$('#idJadwal').val(id);
			$('#shift-edit').val(shift);
			$('#tanggalAwal-edit').val(tanggalAwal);
			$('#tanggalAkhir-edit').val(tanggalAkhir);

			let data = {
				id,
				shift,
				tanggalAwal,
				tanggalAkhir
			};

			$.ajax({
				url: "<?= base_url('admin/jadwal/getListPegawaiEdit'); ?>",
				type: 'get',
				dataType: 'json',
				data: data,
				async: true,
				beforeSend: function(e) {
					$('#loader-edit').removeClass('d-none');
					$('#tampil-edit').addClass('d-none');
				},
				success: function(res) {
					$('#tampil-edit').removeClass('d-none');
					$('.tr_isi-edit').remove();

					let pegawaiReady = res.pegawaiReady;

					if (res.pegawai != null) {
						$(res.pegawai).each(function(i) {
							let check = '';
							let cek_peg = pegawaiReady.includes(res.pegawai[i].id);
							if (cek_peg == true) {
								check = 'checked';
							}

							$("#tabel_pegawai-edit").append(
								"<tr class=" + "tr_isi-edit" + ">" +
								"<td class='text-center'>" + (i + 1) + "</td>" +
								"<td>" + res.pegawai[i].nama + "</td>" +
								"<td>" +
								`<center>
                                    <input type="checkbox" class="check-item-edit" name="idPegawai[]" value="` + res.pegawai[i].id + `"` + check + `>
                            	</center>` +
								"</td>" +
								"<tr>");
						});
					} else {
						$("#tabel_pegawai-edit").append(
							"<tr class=" + "tr_isi-edit" + ">" +
							"<td colspan='3' class='text-center'>Kosong</td>" +
							"<tr>");
					}
				},
				complete: function() {
					$('#tampil-edit').removeClass('d-none');
					$('#loader-edit').addClass('d-none');
				}
			});
		});
	});

	$('#shift-edit').change(function() {
		$('#loader-edit').addClass('d-none');
		$('#tampil-edit').addClass('d-none');
	});

	$('#tanggalAwal-edit').change(function() {
		$('#loader-edit').addClass('d-none');
		$('#tampil-edit').addClass('d-none');
	});

	$('#tanggalAkhir-edit').change(function() {
		let id = $('#idJadwal').val();
		let shift = $('#shift-edit').val();
		let tanggalAwal = $('#tanggalAwal-edit').val();
		let tanggalAkhir = $(this).val();

		if (tanggalAwal === '' || shift === '') {
			toastr.warning('Isi kolom dengan benar');

			return 0;
		}

		if (tanggalAwal > tanggalAkhir) {
			toastr.warning('Tanggal awal tidak boleh melebihi tanggal akhir');

			return 0;
		}

		let data = {
			id,
			shift,
			tanggalAwal,
			tanggalAkhir
		};

		$.ajax({
			url: "<?= base_url('admin/jadwal/getListPegawaiEdit'); ?>",
			type: 'get',
			dataType: 'json',
			data: data,
			async: true,
			beforeSend: function(e) {
				$('#loader-edit').removeClass('d-none');
				$('#tampil-edit').addClass('d-none');
			},
			success: function(res) {
				$('#tampil-edit').removeClass('d-none');
				$('.tr_isi-edit').remove();

				let pegawaiReady = res.pegawaiReady;

				if (res.pegawai != null) {
					$(res.pegawai).each(function(i) {
						let check = '';
						let cek_peg = pegawaiReady.includes(res.pegawai[i].id);
						if (cek_peg == true) {
							check = 'checked';
						}

						$("#tabel_pegawai-edit").append(
							"<tr class=" + "tr_isi-edit" + ">" +
							"<td class='text-center'>" + (i + 1) + "</td>" +
							"<td>" + res.pegawai[i].nama + "</td>" +
							"<td>" +
							`<center>
                                    <input type="checkbox" class="check-item-edit" name="idPegawai[]" value="` + res.pegawai[i].id + `"` + check + `>
                            	</center>` +
							"</td>" +
							"<tr>");
					});
				} else {
					$("#tabel_pegawai-edit").append(
						"<tr class=" + "tr_isi-edit" + ">" +
						"<td colspan='3' class='text-center'>Kosong</td>" +
						"<tr>");
				}
			},
			complete: function() {
				$('#tampil-edit').removeClass('d-none');
				$('#loader-edit').addClass('d-none');
			}
		});
	});

	$("#check-all").click(function() {
		if ($(this).is(":checked"))
			$(".check-item").prop("checked", true);
		else
			$(".check-item").prop("checked", false);
	});

	$("#check-all-edit").click(function() {
		if ($(this).is(":checked"))
			$(".check-item-edit").prop("checked", true);
		else
			$(".check-item-edit").prop("checked", false);
	});
</script>