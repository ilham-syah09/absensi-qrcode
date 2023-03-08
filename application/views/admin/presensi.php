<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4>Presensi hari ini</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead class="bg-info">
								<tr>
									<th>Tanggal</th>
									<th>Jumlah Masuk</th>
									<th>Jumlah Pulang</th>
									<th>Jumlah Izin</th>
									<th>Total Pegawai</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($presensiHariIni as $presensi) : ?>
									<tr>
										<td><?= date('d M Y', strtotime($presensi->tanggal)); ?></td>
										<td><?= $presensi->jumlahMasuk; ?></td>
										<td><?= $presensi->jumlahPulang; ?></td>
										<td><?= $presensi->jumlahIzin; ?></td>
										<td><?= $presensi->total; ?></td>
										<td>
											<a href="<?= base_url('admin/presensi/list/') . $presensi->tanggal; ?>" class="badge badge-warning text-dark" data-toggle="tooltip" data-title="List Pegawai">List Pegawai</a>
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
	<div class="row">
		<div class="col-sm-4 col-xl-4">
			<div class="form-group">
				<label for="by_tahun">Tahun</label>
				<select class="js-select2 form-control" name="by_tahun" id="by_tahun">
					<option value="">-- Pilih Tahun --</option>
					<?php foreach ($tahun as $th) : ?>
						<option value="<?= $th->tahun; ?>" <?= ($th->tahun == $th_ini) ? 'selected' : ''; ?>>
							<?= $th->tahun; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-sm-4 col-xl-4">
			<div class="form-group">
				<label for="by_tahun">Bulan</label>
				<select class="js-select2 form-control" name="by_bulan" id="by_bulan">
					<option value="">-- Pilih Bulan --</option>
					<?php foreach (range(1, 12) as $bulan) : ?>
						<option value="<?= $bulan; ?>" <?= ($bulan == $bln_ini) ? 'selected' : ''; ?>>
							<?= bulan($bulan); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4>Rekap Presensi</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="example">
							<thead class="bg-info">
								<tr>
									<th>#</th>
									<th>Tanggal</th>
									<th>Jumlah Masuk</th>
									<th>Jumlah Pulang</th>
									<th>Jumlah Izin</th>
									<th>Total Pegawai</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($riwayatPresensi as $presensi) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= date('d M Y', strtotime($presensi->tanggal)); ?></td>
										<td><?= $presensi->jumlahMasuk; ?></td>
										<td><?= $presensi->jumlahPulang; ?></td>
										<td><?= $presensi->jumlahIzin; ?></td>
										<td><?= $presensi->total; ?></td>
										<td>
											<a href="<?= base_url('admin/presensi/list/') . $presensi->tanggal; ?>" class="badge badge-warning text-dark" data-toggle="tooltip" data-title="List Pegawai">List Pegawai</a>
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

<script>
	$('#by_tahun').change(function() {
		let tahun = $(this).find(':selected').val();

		if (tahun === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/presensi/') ?>${tahun}`;
	});

	$('#by_bulan').change(function() {
		let tahun = $('#by_tahun').find(':selected').val();
		let bulan = $(this).find(':selected').val();

		if (bulan === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/presensi/') ?>${tahun}/${bulan}`;
	});
</script>