<!-- page content -->
<div class="right_col" role="main">
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
					<h4>Rekap Bulanan</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="examples">
							<thead class="bg-info">
								<tr>
									<th>#</th>
									<th>Nama Pegawai</th>
									<th>Jumlah Berangkat</th>
									<th>Jumlah Tepat Waktu</th>
									<th>Jumlah Terlambat</th>
									<th>Jumlah Izin</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($pegawai as $peg) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= $peg->nama; ?></td>
										<td><?= berangkat($th_ini, $bln_ini, $peg->id); ?></td>
										<td><?= tepat($th_ini, $bln_ini, $peg->id); ?></td>
										<td><?= terlambat($th_ini, $bln_ini, $peg->id); ?></td>
										<td><?= izin($th_ini, $bln_ini, $peg->id); ?></td>
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

<script>
	$('#by_tahun').change(function() {
		let tahun = $(this).find(':selected').val();

		if (tahun === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/rekap/index/') ?>${tahun}`;
	});

	$('#by_bulan').change(function() {
		let tahun = $('#by_tahun').find(':selected').val();
		let bulan = $(this).find(':selected').val();

		if (bulan === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/rekap/index/') ?>${tahun}/${bulan}`;
	});
</script>