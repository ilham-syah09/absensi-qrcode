<!-- page content -->
<div class="right_col" role="main">
	<div class="row text-right">
		<div class="col-xl-12">
			<a href="<?= base_url('admin/jadwal'); ?>" class="btn btn-primary">Kembali</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-xl-4">
			<div class="form-group">
				<label for="by_pegawai">Nama Pegawai</label>
				<select class="js-select2 form-control" name="by_pegawai" id="by_pegawai">
					<option value="">-- Pilih Pegawai --</option>
					<?php foreach ($pegawai as $peg) : ?>
						<option value="<?= $peg->idPegawai; ?>" <?= ($peg->idPegawai == $peg_ini) ? 'selected' : ''; ?>>
							<?= $peg->nama; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5>Jadwal <?= $jadwal[0]->nama; ?></h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="example">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Tanggal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($detailJadwal as $dt) : ?>
									<tr>
										<td class="text-center"><?= $i++; ?></td>
										<td><?= date('d M Y', strtotime($dt->tanggal)); ?></td>
										<td>
											<a href="#" class="badge badge-warning tukar_btn" data-toggle="modal" data-target="#tukarShift" data-id="<?= $dt->id; ?>">Tukar Shift</a>
											<a href="<?= base_url('admin/jadwal/deleteJadwal/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Hapus Jadwal</a>
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
<div class="modal fade" id="tukarShift" tabindex="-1" role="dialog" aria-labelledby="tukarShiftTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tukar Shift</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/jadwal/tukarShift'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="id" id="id">
							<input type="hidden" name="idPegawai" value="<?= $peg_ini; ?>">
							<div class="form-group">
								<label>Nama Shift</label>
								<select name="shift" class="form-control" id="shift">
									<option value="">-- Pilih Shift --</option>
									<?php foreach ($shift as $s) : ?>
										<option value="<?= $s->id; ?>"><?= $s->nama; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Tanggal</label>
								<input type="date" class="form-control" name="tanggal" id="tanggal">
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
	$('#by_pegawai').change(function() {
		let pegawai = $(this).find(':selected').val();

		if (pegawai === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/jadwal/detail/' . $jadwal[0]->id) ?>/${pegawai}`;
	});

	let tukar_btn = $('.tukar_btn');

	$(tukar_btn).each(function(i) {
		$(tukar_btn[i]).click(function() {
			let id = $(this).data('id');

			$('#id').val(id);
			$('#shift').val('');
			$('#tanggal').val('');
		});
	});
</script>