<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h5>Biodata</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center mb-3">
                            <img src="<?= base_url('upload/profile/') . $this->dt_user->image; ?>" alt="Image Profile" class="img-thumbnail" width="200">
                        </div>
                        <div class="col-sm-12">
                            <div class="bg-info p-2 text-white mb-2">
                                <span>Nama - <?= $this->dt_user->nama; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="bg-info p-2 text-white mb-2">
                                <span>NIP - <?= $this->dt_user->nip; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="bg-info p-2 text-white">
                                <span>Email - <?= $this->dt_user->email; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($presensiHariIni) : ?>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h5>Jadwal Pekan Ini</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-info p-2 text-white mb-2 text-center">
                                    <h6 class="mt-2"><?= $shift->nama; ?></h6>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-primary p-2 text-white mb-2 float-left">
                                    <span>Jam Masuk <?= $shift->jamMasuk; ?></span>
                                </div>
                                <div class="bg-primary p-2 text-white float-right">
                                    <span>Jam Pulang <?= $shift->jamPulang; ?></span>
                                </div>
                            </div>
                            <?php foreach ($allJadwal as $jadwal) : ?>
                                <div class="col-md-12">
                                    <?php
                                    if ($jadwal->presensiMasuk != null) {
                                        $class = 'bg-success';
                                    } else if ($jadwal->izin != null) {
                                        $class = 'bg-info';
                                    } else {
                                        $class = 'bg-secondary';
                                    }
                                    ?>
                                    <div class="<?= $class; ?> p-2 text-white mb-2 text-center">
                                        <span class="mt-2"><?= hari(date('N', strtotime($jadwal->tanggal))) . ', ' . date('d M Y', strtotime($jadwal->tanggal)); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h5>Presensi Hari Ini - <?= hari(date('N')) . ', ' . date('d M Y'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if ($presensiHariIni) : ?>
                            <div class="col-md-12">
                                <div class="bg-info p-2 text-white mb-2 text-center">
                                    <h6 class="mt-2"><?= $shift->nama; ?></h6>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-primary p-2 text-white mb-2 float-left">
                                    <span>Jam Masuk <?= $shift->jamMasuk; ?></span>
                                </div>
                                <?php if ($presensiHariIni[0]->izin == null) : ?>
                                    <?php if ($presensiHariIni[0]->presensiMasuk != null) : ?>
                                        <div class="bg-success p-2 text-white mb-2 float-right">
                                            <span><i class="fa fa-hand-paper-o"></i></span>
                                        </div>
                                    <?php else : ?>
                                        <div class="bg-danger p-2 text-white mb-2 float-right">
                                            <span><i class="fa fa-hand-paper-o"></i></span>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="bg-info p-2 text-white mb-2 float-right">
                                        <span><i class="fas fa-info"></i></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-primary p-2 text-white float-left">
                                    <span>Jam Pulang <?= $shift->jamPulang; ?></span>
                                </div>
                                <?php if ($presensiHariIni[0]->izin == null) : ?>
                                    <?php if ($presensiHariIni[0]->presensiPulang != null) : ?>
                                        <div class="bg-success p-2 text-white mb-2 float-right">
                                            <span><i class="fa fa-hand-paper-o"></i></span>
                                        </div>
                                    <?php else : ?>
                                        <div class="bg-danger p-2 text-white mb-2 float-right">
                                            <span><i class="fa fa-hand-paper-o"></i></span>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="bg-info p-2 text-white mb-2 float-right">
                                        <span><i class="fas fa-info"></i></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <div class="col-sm-12">
                                <div class="bg-danger p-2 text-dark">
                                    <h5>Hari libur</h5>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->