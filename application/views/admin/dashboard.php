<!-- page content -->
<div class="right_col" role="main">
    <div class="row mb-2">
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-header bg-primary text-white">
                        <h5>Total Jabatan</h5>
                    </div>
                    <div class="card-body">
                        <?= $jabatan; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-header bg-success text-white">
                        <h5>Pegawai Aktif</h5>
                    </div>
                    <div class="card-body">
                        <?= $pegawaiAktif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-header bg-danger text-white">
                        <h5>Pegawai TIdak Aktif</h5>
                    </div>
                    <div class="card-body">
                        <?= $pegawaiTidakAktif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($shift as $s) : ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-info p-3 text-white text-center mb-2">
                            <h5><?= $s->nama; ?></h5>
                        </div>
                        <div class="bg-primary p-3 text-white text-center mb-2">
                            <span>Jam Masuk <?= $s->jamMasuk; ?></span>
                        </div>
                        <div class="bg-primary p-3 text-white text-center">
                            <span>Jam Pulang <?= $s->jamPulang; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- /page content -->