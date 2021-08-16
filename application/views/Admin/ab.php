<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ayam Brewok</h6>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="row">
                    <div class="col-md-3">
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

                    <div class="col-md-3">
                        <?php
                        $now = date('Y');
                        $ymin = $now - 6;
                        echo "<select name='tahun' class=form-control required>";
                        echo "<option value=''>Pilih Tahun</option>";
                        for ($a = $now; $a >= $ymin; --$a) {
                            echo "<option value='$a'>$a</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>

                    <button type="submit" class="btn btn-danger" name="cari"><i class="fa fa-search"></i> Cari Data</button>
                </div>
                <br>
                <?php
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                if (isset($_POST["cari"])) {
                    //iki gwe opo?
                    $bulan = $_POST["bulan"];
                    $year = $_POST["tahun"];
                }
                ?>
            </form>
            <!-- <?php
                    echo "$bulan" . '-';
                    echo "$year";
                    ?> -->
            &nbsp;&nbsp;<b>Bulan =>
                <?php if ($bulan == "1") {
                    echo "Januari ";
                } ?>
                <?php if ($bulan == "2") {
                    echo "Februari ";
                } ?>
                <?php if ($bulan == "3") {
                    echo "Maret ";
                } ?>
                <?php if ($bulan == "4") {
                    echo "April ";
                } ?>
                <?php if ($bulan == "5") {
                    echo "Mei ";
                } ?>
                <?php if ($bulan == "6") {
                    echo "Juni ";
                } ?>
                <?php if ($bulan == "7") {
                    echo "Juli ";
                } ?>
                <?php if ($bulan == "8") {
                    echo "Agustus ";
                } ?>
                <?php if ($bulan == "9") {
                    echo "September ";
                } ?>
                <?php if ($bulan == "10") {
                    echo "Oktober ";
                } ?>
                <?php if ($bulan == "11") {
                    echo "November ";
                } ?>
                <?php if ($bulan == "12") {
                    echo "Desember ";
                } ?>
                dan Tahun => <?php echo $year ?></b>
            <br>
            <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Jumlah Setoran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($year = 0 || empty($year) && $bulan = 0 || empty($bulan)) {
                            $year = date('Y');
                            for ($i = date("n"); $i >= 1; $i--) {
                                if ($i < 10) {
                                    $i = "0" . $i;
                                }
                        ?>
                                <tr>
                                    <td><?php echo completeFormatMonthIndo_helper($i) . '-' . $year ?></td>
                                    <td>
                                        <?php
                                        $date = date('Y') . '-' . $i;
                                        $data = $this->db->query("SELECT SUM( jumlah_pendapatan ) AS jumlah FROM tbl_pendapatan WHERE tgl_pendapatan LIKE '%$date%' AND id_usaha = '3'");
                                        $x = 0;
                                        foreach ($data->result() as $row) {
                                            echo "Rp. " . number_format($row->jumlah) . " ,-";
                                            $x += $row->jumlah;
                                        }
                                        ?>
                                    </td>
                                    <td><a href="<?= base_url('Admin/Ayam_brewok/detail_rekap_bulanan?param=' . $date . '') ?>"><button type="button" class="btn btn-primary" target="_new"><i class="fa fa-list-alt"></i> Lihat Detail</button></a></td>
                                </tr>
                            <?php
                            }
                        } elseif (isset($bulan) && isset($year)) {
                            /*$year = date('Y');*/
                            //error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                            for ($i = $bulan; $i >= 1; $i--) {
                                if ($i < 10) {
                                    $i = '0' . $i;
                                }
                            ?>

                                <tr>
                                    <td><?php echo completeFormatMonthIndo_helper($i) . '-' . $_POST["tahun"] ?></td>
                                    <td>
                                        <?php
                                        $date = $_POST["tahun"] . '-' . $i;
                                        $data = $this->db->query("SELECT SUM( jumlah_pendapatan ) AS jumlah FROM tbl_pendapatan WHERE tgl_pendapatan LIKE '%$date%' AND id_usaha = '3'");
                                        $x = 0;
                                        foreach ($data->result() as $row) {
                                            echo "Rp. " . number_format($row->jumlah) . " ,-";
                                            $x += $row->jumlah;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('Admin/Ayam_brewok/detail_rekap_bulanan?param=' . $date . '') ?>" target="_new"><button type="button" class="btn btn-primary"><i class="fa fa-list-alt"></i> Lihat Detail</button></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->