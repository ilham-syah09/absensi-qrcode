<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4>Presensi hari ini - <?= hari(date('N')) . ', ' . date('d M Y'); ?></h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead class="bg-info">
								<tr>
									<th>Presensi Masuk</th>
									<th>Presensi Pulang</th>
									<th>Izin</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($presensiHariIni) : ?>
									<tr>
										<td>
											<?php if ($presensiHariIni) : ?>
												<?php if ($presensiHariIni[0]->izin == null) : ?>
													<?php if ($presensiHariIni[0]->presensiMasuk == null) : ?>
														<span class="badge badge-warning">Belum Presensi</span>
													<?php else : ?>
														<?php if ($presensiHariIni[0]->presensiMasuk > $shift[$presensiHariIni[0]->idShift]->jamMasuk) : ?>
															<span class="badge badge-danger"><?= $presensiHariIni[0]->presensiMasuk; ?></span>
														<?php else : ?>
															<span class="badge badge-success"><?= $presensiHariIni[0]->presensiMasuk; ?></span>
														<?php endif; ?>
													<?php endif; ?>
												<?php else : ?>
													<span class="badge badge-info">Izin</span>
												<?php endif; ?>
											<?php else : ?>
												<span class="badge badge-warning">Belum Presensi</span>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($presensiHariIni) : ?>
												<?php if ($presensiHariIni[0]->izin == null) : ?>
													<?php if ($presensiHariIni[0]->presensiPulang == null) : ?>
														<span class="badge badge-warning">Belum Presensi</span>
													<?php else : ?>
														<?php if ($presensiHariIni[0]->presensiPulang < $shift[$presensiHariIni[0]->idShift]->jamPulang) : ?>
															<span class="badge badge-danger"><?= $presensiHariIni[0]->presensiPulang; ?></span>
														<?php else : ?>
															<span class="badge badge-success"><?= $presensiHariIni[0]->presensiPulang; ?></span>
														<?php endif; ?>
													<?php endif; ?>
												<?php else : ?>
													<span class="badge badge-info">Izin</span>
												<?php endif; ?>
											<?php else : ?>
												<span class="badge badge-warning">Belum Presensi</span>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($presensiHariIni) : ?>
												<?php if ($presensiHariIni[0]->izin == null) : ?>
													<span class="badge badge-info">Tidak Izin</span>
												<?php else : ?>
													<?php if ($presensiHariIni[0]->statusIzin == 'Menunggu') : ?>
														<span class="badge badge-warning"><?= $presensiHariIni[0]->statusIzin; ?></span>
													<?php elseif ($presensiHariIni[0]->statusIzin == 'Ditolak') : ?>
														<span class="badge badge-danger"><?= $presensiHariIni[0]->statusIzin; ?></span>
													<?php elseif ($presensiHariIni[0]->statusIzin == 'Disetujui') : ?>
														<span class="badge badge-success"><?= $presensiHariIni[0]->statusIzin; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											<?php else : ?>
												<span class="badge badge-info">Tidak Izin</span>
											<?php endif; ?>
										</td>
										<th>
											<?php if ($presensiHariIni[0]->presensiMasuk == null && $presensiHariIni[0]->presensiPulang == null) : ?>
												<?php if ($presensiHariIni[0]->izin == null) : ?>
													<a href="#" class="badge badge-info" data-toggle="modal" data-target="#modalPresensi" data-title="Presensi" id="btn-presensi" data-typepresensi="Masuk">Presensi</a>
													<a href="#" class="badge badge-success" data-toggle="modal" data-target="#modalIzin" data-title="Izin">Izin</a>
												<?php endif; ?>
											<?php else : ?>
												<?php if ($presensiHariIni[0]->izin == null) : ?>
													<?php if ($presensiHariIni[0]->presensiPulang == null) : ?>
														<a href="#" class="badge badge-info" data-toggle="modal" data-target="#modalPresensi" data-title="Presensi" id="btn-presensi" data-typepresensi="Pulang">Presensi</a>
													<?php endif; ?>
												<?php endif; ?>
											<?php endif; ?>
										</th>
									</tr>
								<?php else : ?>
									<tr>
										<td colspan="4" class="text-center bg-danger text-white">Hari libur</td>
									</tr>
								<?php endif; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
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
					<h4>Riwayat Presensi</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="example">
							<thead class="bg-info">
								<tr>
									<th>#</th>
									<th>Tanggal</th>
									<th>Presensi Masuk</th>
									<th>Presensi Pulang</th>
									<th>Izin</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($presensi as $pres) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= date('d M Y', strtotime($pres->tanggal)); ?></td>
										<td class="text-dark">
											<?php if ($pres->izin == null) : ?>
												<?php if ($pres->presensiMasuk == null) : ?>
													<span class="badge badge-warning">Belum Presensi</span>
												<?php else : ?>
													<?php if ($pres->presensiMasuk > $shift[$pres->idShift]->jamMasuk) : ?>
														<span class="badge badge-danger"><?= $pres->presensiMasuk; ?></span>
													<?php else : ?>
														<span class="badge badge-success"><?= $pres->presensiMasuk; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											<?php else : ?>
												<span class="badge badge-info">Izin</span>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($pres->izin == null) : ?>
												<?php if ($pres->presensiPulang == null) : ?>
													<span class="badge badge-warning">Belum Presensi</span>
												<?php else : ?>
													<?php if ($pres->presensiPulang < $shift[$pres->idShift]->jamPulang) : ?>
														<span class="badge badge-danger"><?= $pres->presensiPulang; ?></span>
													<?php else : ?>
														<span class="badge badge-success"><?= $pres->presensiPulang; ?></span>
													<?php endif; ?>
												<?php endif; ?>
											<?php else : ?>
												<span class="badge badge-info">Izin</span>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($pres->izin == null) : ?>
												<span class="badge badge-info">Tidak Izin</span>
											<?php else : ?>
												<?php if ($pres->statusIzin == 'Menunggu') : ?>
													<span class="badge badge-warning"><?= $pres->statusIzin; ?></span>
												<?php elseif ($pres->statusIzin == 'Ditolak') : ?>
													<span class="badge badge-danger"><?= $pres->statusIzin; ?></span>
												<?php elseif ($pres->statusIzin == 'Disetujui') : ?>
													<span class="badge badge-success"><?= $pres->statusIzin; ?></span>
												<?php endif; ?>
											<?php endif; ?>
										</td>
										<td>
											<a href="<?= base_url('pegawai/presensi/detail/') . $pres->id; ?>" class="badge badge-warning" data-toggle="tooltip" data-title="Detail">Detail</a>
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

<!-- modal presensi -->
<div class="modal fade" id="modalPresensi" tabindex="-1" role="dialog" aria-labelledby="modalPresensi" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="headerPresensi"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card card-default">
					<div class="card-body">
						<div class="alert alert-info text-center mb-3">
							<i class="fa fa-warning"></i> Untuk menggunakan scan QR COde presensi, izinkan halaman ini mengakses kamera Anda
						</div>

						<video id="lihat_kamera" class="mb-2" poster="<?= base_url(); ?>assets/img/kamera.png" style="object-fit: cover; width:100%; max-height: 300px;">
							Browser Anda tidak mendukung pemindai kode QR.
						</video>

						<button type="button" id="ganti_kamera" class="btn btn-block btn-default" value="depan">
							<i class="fa fa-camera mr-2"></i> Ganti Kamera
						</button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- modal izin -->
<div class="modal fade" id="modalIzin" tabindex="-1" role="dialog" aria-labelledby="modalIzin" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Form Permohonan Izin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('pegawai/presensi/izin'); ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" value="<?= $presensiHariIni[0]->id; ?>" name="id">
							<div class="form-group">
								<label for="alasan">Alasan</label>
								<textarea name="alasan" cols="30" rows="5" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="document">Document Pendukung</label>
								<input type="file" name="document" class="form-control" accept=".jpeg, .jpg, .png, .pdf">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/vendors/instascan/instascan.min.js"></script>

<script>
	$('#by_tahun').change(function() {
		let tahun = $(this).find(':selected').val();

		if (tahun === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('pegawai/presensi/') ?>${tahun}`;
	});

	$('#by_bulan').change(function() {
		let tahun = $('#by_tahun').find(':selected').val();
		let bulan = $(this).find(':selected').val();

		if (bulan === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('pegawai/presensi/') ?>${tahun}/${bulan}`;
	});

	var scanner;

	$('#btn-presensi').click(function() {
		let typePresensi = $(this).data('typepresensi');

		$('#typePresensi').val(typePresensi);

		if (typePresensi === 'Masuk') {
			$('#headerPresensi').text('Presensi Masuk');
		} else {
			$('#headerPresensi').text('Presensi Pulang');
		}

		scanner = new Instascan.Scanner({
			video: document.getElementById('lihat_kamera'),
			mirror: false
		});

		scanner.addListener('scan', function(content) {
			if (content.includes('<?php echo base_url(); ?>')) {
				window.location = content;
			} else {
				alert("Bukan kode QR Presensi");
			}
		});

		Instascan.Camera.getCameras().then(function(cameras) {
			if (cameras.length > 0) {
				if (cameras[1]) {
					scanner.start(cameras[1]);
				} else {
					scanner.start(cameras[0]);
				}

				$("#ganti_kamera").on("click", function() {
					if ($("#ganti_kamera").val() == "depan") {
						if (cameras[0] != "") {
							scanner.start(cameras[0]);
						} else {
							alert("Kamera tidak dapat diakses");
						}

						$("#ganti_kamera").val("belakang");
					} else if ($("#ganti_kamera").val() == "belakang") {
						if (cameras[1] != "") {
							scanner.start(cameras[1]);
						} else {
							alert("Kamera tidak dapat diakses");
						}

						$("#ganti_kamera").val("depan");
					}
				});
			} else {
				alert("Kamera tidak dapat diakses");
				$("#ganti_kamera").hide();
			}
		});
	});

	$('#close').click(function() {
		scanner.stop();
	});
</script>