<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPegawai">Add Pegawai</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="example">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th>Nama</th>
									<th>NIP</th>
									<th>Jabatan</th>
									<th>Email</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($pegawai as $peg) : ?>
									<tr>
										<td class="text-center"><?= $i++; ?></td>
										<td><?= $peg->nama; ?></td>
										<td><?= $peg->nip; ?></td>
										<td><?= $peg->namaJabatan; ?></td>
										<td><?= $peg->email; ?></td>
										<td>
											<span class="badge <?= ($peg->status == 0) ? 'badge-danger' : 'badge-success'; ?>"><?= ($peg->status == 0) ? 'Tidak Aktif' : 'Aktif'; ?></span>
										</td>
										<td>
											<a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editPegawai" data-id="<?= $peg->id; ?>" data-nama="<?= $peg->nama; ?>" data-nip="<?= $peg->nip; ?>" data-email="<?= $peg->email; ?>" data-jk="<?= $peg->jk; ?>" data-status="<?= $peg->status; ?>" data-jabatan="<?= $peg->idJabatan; ?>">Edit</a>
											<a href="<?= base_url('admin/pegawai/delete/' . $peg->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="addPegawai" tabindex="-1" role="dialog" aria-labelledby="addPegawai" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('admin/pegawai/add'); ?>" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Pegawai</label>
								<input type="text" class="form-control" name="nama">
							</div>
							<div class="form-group">
								<label>NIP</label>
								<input type="text" class="form-control" name="nip">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email">
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jk" class="form-control">
									<option value="">-- Pilih Jenis Kelamin --</option>
									<option value="1">Laki - laki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Jabatan</label>
								<select name="jabatan" class="form-control">
									<option value="">-- Pilih Jabatan --</option>
									<?php foreach ($jabatan as $jbt) : ?>
										<option value="<?= $jbt->id; ?>"><?= $jbt->namaJabatan; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="">-- Pilih Status--</option>
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
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
</div>

<!-- modal edit -->
<div class="modal fade" id="editPegawai" tabindex="-1" role="dialog" aria-labelledby="editPegawai" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/pegawai/edit'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Pegawai</label>
								<input type="hidden" name="id_pegawai" id="id_pegawai">
								<input type="text" class="form-control" name="nama" id="nama">
							</div>
							<div class="form-group">
								<label>NIP</label>
								<input type="text" class="form-control" name="nip" id="nip">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email" id="email">
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jk" class="form-control" id="jk">
									<option value="">-- Pilih Jenis Kelamin --</option>
									<option value="1">Laki - laki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Jabatan</label>
								<select name="jabatan" class="form-control" id="jabatan">
									<option value="">-- Pilih Jabatan --</option>
									<?php foreach ($jabatan as $jbt) : ?>
										<option value="<?= $jbt->id; ?>"><?= $jbt->namaJabatan; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control" id="status">
									<option value="">-- Pilih Status--</option>
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
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
			let nip = $(this).data('nip');
			let email = $(this).data('email');
			let jk = $(this).data('jk');
			let jabatan = $(this).data('jabatan');
			let status = $(this).data('status');

			$('#id_pegawai').val(id);
			$('#nama').val(nama);
			$('#nip').val(nip);
			$('#email').val(email);
			$('#jk').val(jk);
			$('#jabatan').val(jabatan);
			$('#status').val(status);
		});
	});
</script>