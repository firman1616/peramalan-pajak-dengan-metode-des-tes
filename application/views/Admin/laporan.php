<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="card shadow mb-8 col-md-12">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Peramalan</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <select name="bulan" id="bulan" class="form-control" required>
                                <option>Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Febuari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-6 col-xs-6">
                            <?php
                            $now = date('Y');
                            $ymin = $now - 6;
                            echo "<select name='tahun' class=form-control required id='tahun'>";
                            echo "<option value=''>Pilih Tahun</option>";
                            for ($a = $now; $a >= $ymin; --$a) {
                                echo "<option value='$a'>$a</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>

                        <button class="btn btn-primary" type="submit" name="cari" id="cari"><i class="fa fa-search"></i> Lihat Hasil</button>
                    </div>
                </form>
                <br><br>
                <?php
                // error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                // if (isset($_POST["cari"])) {
                //     //iki gwe opo?
                //     $bulan = $_POST["bulan"];
                //     $year = $_POST["tahun"];
                // }
                ?>
            </div>
        </div>
    </div>

    <br>

    <div class="row" id="b">
        <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hasil peramalan Brown</h6>
            </div>
            <div class="card-body">
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
                        $no = 1;
                        // $qbrown = $this->db->query("SELECT * FROM `tbl_peramalan` WHERE MONTH(tgl_peramalan) = '$bulan' AND YEAR(tgl_peramalan) = '$year'");

                        foreach ($fbrown->result() as $b) { ?>

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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shb<?= $no++; ?>"><i class="fa fa-list"></i></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#abb<?= $no++; ?>"><i class="fa fa-list"></i></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#amb<?= $no++; ?>"><i class="fa fa-list"></i></button>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>

    <div class="row" id="w">
        <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hasil Peramalan Winter</h6>
            </div>
            <div class="card-body">
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
                        foreach ($fwinter->result() as $w) { ?>

                            <tr>
                                <td><?= $x++; ?></td>
                                <td><?= date("Y/m", strtotime($w->tgl_peramalan_winter)) ?></td>
                                <td><?= number_format($w->data_aktual_winter) ?></td>
                                <td><?= $w->alpha_winter . ',' . $w->beta . ',' . $w->gamma ?></td>
                                <td><?= number_format($w->st_winter) ?></td>
                                <td><?= number_format($w->bt_winter) ?></td>
                                <td><?= number_format($w->lt_winter, 3) ?></td>
                                <td><?= number_format($w->ftm_winter) ?></td>
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
<?php
$y = 1;
//die(print_r($fbrown));
foreach ($fbrown->result() as $target_b) {
    $ramal = $target_b->step5;
    $target = $ramal * 0.4;
    $tgl = $target_b->tgl_peramalan;
    $bln = date('n', strtotime($tgl));
    $thn = date('Y', strtotime($tgl));

?>
    <div class="modal fade" id="shb<?= $y++; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sumber Hidup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Target <?= 'Rp' . number_format($target); ?></h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $len_of_day = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);

                            for ($i = 1; $i <= $len_of_day; $i++) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo date('d-M-Y', strtotime($i . '-' . $bln . '-' . $thn)); ?></td>
                                    <td><?php echo 'Rp' . number_format($target / $len_of_day, 0, '.', ','); ?></td>
                                </tr>
                            <?php }
                            ?>

                        </tbody>
                    </table>
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
    <div class="modal fade" id="abb<?= $y++; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="amb<?= $y++; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<?php $no++;
} ?>