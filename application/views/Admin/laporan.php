<?php
foreach ($brown as $target_b) {
    $ramal = $target_b->step5;
} ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="card shadow mb-8 col-md-12">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Peramalan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <select name="bln" id="bln" class="form-control">
                            <option>Pilih Bulan</option>
                            <?php
                            $bulan = $this->db->query("SELECT DISTINCT MONTH( tgl_peramalan ) AS Bulan FROM tbl_peramalan")->result();
                            foreach ($bulan as $bln) {
                            ?>
                                <option value="<?= $bln->Bulan ?>"><?= date("F", strtotime('0' . $bln->Bulan)) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <select name="thn" id="thn" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <option value="01">Bla bLa</option>
                        </select>
                    </div>

                    <button class="btn btn-primary"><i class="fa fa-search"></i> Lihat Hasil</button>
                </div>
                <br><br>

                <h2>Hasil Peramalan Brown</h2>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 5%;">Periode</th>
                            <th style="width: 4%;">Alpha</th>
                            <th style="width: 11%;">Data Aktual</th>
                            <th>S <sup>'</sup><sub>t</sub></th>
                            <th>S <sup>''</sup><sub>t</sub></th>
                            <th>a <sub>t</sub></th>
                            <th>b <sub>t</sub></th>
                            <th>f <sub>t + m</sub></th>
                            <th>RMSE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        foreach ($brown as $b) { ?>

                            <tr>
                                <td><?= $x++; ?></td>
                                <td><?= date("Y/m", strtotime($b->tgl_peramalan)) ?></td>
                                <td><?= $b->alpha ?></td>
                                <td><?= number_format($b->data_aktual) ?></td>
                                <td><?= number_format($b->step1)  ?></td>
                                <td><?= number_format($b->step2) ?></td>
                                <td><?= number_format($b->step3) ?></td>
                                <td><?= number_format($b->step4) ?></td>
                                <td><?= number_format($b->step5) ?></td>
                                <td><?= number_format($b->rmse) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shb"><i class="fa fa-list"></i></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#abb"><i class="fa fa-list"></i></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#amb"><i class="fa fa-list"></i></button>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

                <!-- Holt-Winter -->
                <h2>Hasil Peramalan Holt-Winnter </h2>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <!-- <th>Alpha</th> -->
                            <th>Data Aktual</th>
                            <th>a, B, Y</th>
                            <th>St</th>
                            <th>Bt</th>
                            <th>It</th>
                            <th>Ft+m</th>
                            <th>RMSE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        foreach ($winter as $w) { ?>

                            <tr>
                                <td><?= $x++; ?></td>
                                <td><?= date("Y/m", strtotime($w->tgl_peramalan_winter)) ?></td>
                                <td><?= number_format($w->data_aktual_winter) ?></td>
                                <td><?= $w->alpha_winter . ',' . $w->beta . ',' . $w->gamma ?></td>
                                <td><?= number_format($w->st_winter, 3) ?></td>
                                <td><?= number_format($w->bt_winter, 3) ?></td>
                                <td><?= number_format($w->lt_winter, 3) ?></td>
                                <td><?= number_format($w->ftm_winter, 3) ?></td>
                                <td><?= number_format($w->rmse_winter) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-list"></i></button>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-list"></i></button>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-list"></i></button>
                                </td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- WP 1 Brown -->
<div class="modal fade" id="shb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sumber Hidup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Target <?= number_format($ramal * 0.4) ?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- End WP 1 Brown -->
<!-- WP 2 Brown -->
<div class="modal fade" id="abb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ayam Brewok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Target <?= number_format($ramal * 0.3) ?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- End WP 2 Brown -->
<!-- WP 2 Brown -->
<div class="modal fade" id="amb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Amanis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Target <?= number_format($ramal * 0.3) ?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- End WP 2 Brown -->