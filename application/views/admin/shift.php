<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addShift">Add Shift</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Nama Shift</th>
									<th>Jam Masuk</th>
									<th>Jam Pulang</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($shift as $dt) : ?>
									<tr>
										<td class="text-center"><?= $i++; ?></td>
										<td><?= $dt->nama; ?></td>
										<td><?= date('H:i', strtotime($dt->jamMasuk)); ?></td>
										<td><?= date('H:i', strtotime($dt->jamPulang)); ?></td>
										<td>
											<a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editShift" data-id="<?= $dt->id; ?>" data-nama="<?= $dt->nama; ?>" data-jammasuk="<?= date('H:i', strtotime($dt->jamMasuk)); ?>" data-jampulang="<?= date('H:i', strtotime($dt->jamPulang)); ?>">Edit</a>
											<a href="<?= base_url('admin/shift/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="addShift" tabindex="-1" role="dialog" aria-labelledby="addShiftTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Tambah Shift</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/shift/add'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Shift</label>
								<input type="text" class="form-control" name="nama">
							</div>
							<div class="form-group">
								<label>Jam Masuk</label>
								<input type="text" class="form-control js-masked-time" name="jamMasuk" placeholder="__:__">
							</div>
							<div class="form-group">
								<label>Jam Pulang</label>
								<input type="text" class="form-control js-masked-time" name="jamPulang" placeholder="__:__">
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

<!-- modal edit -->
<div class="modal fade" id="editShift" tabindex="-1" role="dialog" aria-labelledby="addShiftTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit Jabatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/shift/edit'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="idShift" id="idShift">
							<div class="form-group">
								<label>Nama Shift</label>
								<input type="text" class="form-control" name="nama" id="nama">
							</div>
							<div class="form-group">
								<label>Jam Masuk</label>
								<input type="text" class="form-control js-masked-time" name="jamMasuk" placeholder="__:__" id="jamMasuk">
							</div>
							<div class="form-group">
								<label>Jam Pulang</label>
								<input type="text" class="form-control js-masked-time" name="jamPulang" placeholder="__:__" id="jamPulang">
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
	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let nama = $(this).data('nama');
			let jammasuk = $(this).data('jammasuk');
			let jampulang = $(this).data('jampulang');

			$('#idShift').val(id);
			$('#nama').val(nama);
			$('#jamMasuk').val(jammasuk);
			$('#jamPulang').val(jampulang);
		});
	});
</script>