<!-- page content -->
<div class="right_col" role="main">
	<div class="row mb-3 text-right">
		<div class="col-xl-12">
			<a href="<?= base_url('admin/presensi/list/') . $presensi->tanggal; ?>" class="btn btn-primary">Kembali</a>
		</div>
	</div>
	<div class="row">
		<?php if ($presensi->izin == null) : ?>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						<h4>Presensi Masuk</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<?php if ($presensi->presensiMasuk != null) : ?>
								<div class="col-md-12 text-center mb-2">
									<img src="<?= base_url('upload/presensi/') . $presensi->imagePulang; ?>" alt="Picture Presensi Masuk" class="img-thumbnail" width="400">
								</div>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered" width="100%" cellspacing="0">
											<thead>
												<tr>
													<td>Keterangan</td>
													<td>:</td>
													<td><?= $shift[$presensi->idShift]->nama; ?></td>
												</tr>
												<tr>
													<td>Jadwal Masuk</td>
													<td>:</td>
													<td><?= $shift[$presensi->idShift]->jamMasuk; ?></td>
												</tr>
												<tr>
													<td>Presensi Masuk</td>
													<td>:</td>
													<td><?= $presensi->presensiMasuk; ?></td>
												</tr>
												<?php if ($presensi->presensiMasuk > $shift[$presensi->idShift]->jamMasuk) : ?>
													<tr>
														<td>Status</td>
														<td>:</td>
														<td>
															<span class="badge badge-danger">Terlambat</span>
														</td>
													</tr>
												<?php endif; ?>
											</thead>
										</table>
									</div>
								</div>
							<?php else : ?>
								<div class="col-md-12 bg-danger text-white p-3 text-center">
									<span class="h4">Belum Presensi</span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						<h4>Presensi Pulang</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<?php if ($presensi->presensiPulang != null) : ?>
								<div class="col-md-12 text-center mb-2">
									<img src="<?= base_url('upload/presensi/') . $presensi->imagePulang; ?>" alt="Picture Presensi Masuk" class="img-thumbnail" width="400">
								</div>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered" width="100%" cellspacing="0">
											<thead>
												<tr>
													<td>Keterangan</td>
													<td>:</td>
													<td><?= $shift[$presensi->idShift]->nama; ?></td>
												</tr>
												<tr>
													<td>Jadwal Masuk</td>
													<td>:</td>
													<td><?= $shift[$presensi->idShift]->jamPulang; ?></td>
												</tr>
												<tr>
													<td>Presensi Masuk</td>
													<td>:</td>
													<td><?= $presensi->presensiPulang; ?></td>
												</tr>
												<?php if ($presensi->presensiPulang < $shift[$presensi->idShift]->jamPulang) : ?>
													<tr>
														<td>Status</td>
														<td>:</td>
														<td>
															<span class="badge badge-danger">Sebelum Waktunya</span>
														</td>
													</tr>
												<?php endif; ?>
											</thead>
										</table>
									</div>
								</div>
							<?php else : ?>
								<div class="col-md-12 bg-danger text-white p-3 text-center">
									<span class="h4">Belum Presensi</span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php else : ?>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						<h4>Detail Izin</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 text-center">
								<img src="<?= base_url('assets/img/file.png'); ?>" alt="Picture Presensi Masuk" class="img-circle" width="150">
								<h5>File Bukti Izin</h5>
								<a href="<?= base_url('upload/izin/') . $presensi->document; ?>" class="btn btn-primary mb-3" target="_blank">Download</a>
							</div>
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered" width="100%" cellspacing="0">
										<thead>
											<tr>
												<td>Waktu Izin</td>
												<td>:</td>
												<td><?= $presensi->izin; ?></td>
											</tr>
											<tr>
												<td>Alasan Izin</td>
												<td>:</td>
												<td><?= $presensi->alasanIzin; ?></td>
											</tr>
											<tr>
												<td>Status</td>
												<td>:</td>
												<td>
													<?php if ($presensi->statusIzin == 'Menunggu') : ?>
														<span class="badge badge-warning"><?= $presensi->statusIzin; ?></span>
													<?php elseif ($presensi->statusIzin == 'Ditolak') : ?>
														<span class="badge badge-danger"><?= $presensi->statusIzin; ?></span>
													<?php elseif ($presensi->statusIzin == 'Disetujui') : ?>
														<span class="badge badge-success"><?= $presensi->statusIzin; ?></span>
													<?php endif; ?>
												</td>
											</tr>
										</thead>
									</table>
									<?php if ($presensi->statusIzin == 'Menunggu') : ?>
										<a href="<?= base_url('admin/presensi/izin/Ditolak/') . $presensi->id; ?>" class="btn btn-danger">Tolak</a>
										<a href="<?= base_url('admin/presensi/izin/Disetujui/') . $presensi->id; ?>" class="btn btn-success">Setujui</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<!-- /page content -->