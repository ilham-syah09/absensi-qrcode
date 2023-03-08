<!-- page content -->
<div class="right_col" role="main">
	<div class="row mb-3 text-right">
		<div class="col-xl-12">
			<a href="<?= base_url('admin/presensi/') . date('Y', strtotime($tanggal)) . '/' . date('m', strtotime($tanggal)); ?>" class="btn btn-primary">Kembali</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4><?= date('d M Y', strtotime($tanggal)); ?></h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="example">
							<thead class="bg-info">
								<tr>
									<th>Nama Pegawai</th>
									<th>Presensi Masuk</th>
									<th>Presensi Pulang</th>
									<th>Izin</th>
									<th>Keterangan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($presensi as $pres) : ?>
									<tr>
										<td><?= $pres->nama; ?></td>
										<td>
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
										<td><?= $shift[$pres->idShift]->nama; ?></td>
										<td>
											<a href="<?= base_url('admin/presensi/detail/') . $pres->id; ?>" class="badge badge-warning" data-toggle="tooltip" data-title="Detail">Detail</a>
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