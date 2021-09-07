<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {

        $data['navigation'] = 'navigation/nav';
        $data['title'] = 'Dashboard';
        $data['content'] = 'admin/home';
        $data['bulan'] = $this->db->query("
    		SELECT DATE_FORMAT(tgl_pendapatan, '%Y-%m') as bln
    		FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '2015'")->result();
        $data['pnj'] = $this->db->query("
    		SELECT SUM(jumlah_pendapatan) as total
    		FROM tbl_pendapatan WHERE YEAR(tgl_pendapatan) = '2015'
    		GROUP BY DATE_FORMAT(tgl_pendapatan, '%Y-%m')
    		ORDER BY DATE_FORMAT(tgl_pendapatan, '%Y-%m') ASC")->result();
        $data['prm'] = $this->db->query("
    		SELECT SUM(step5) as total
    		FROM tbl_peramalan WHERE YEAR(tgl_peramalan) = '2015'
    		GROUP BY DATE_FORMAT(tgl_peramalan, '%Y-%m')
    		ORDER BY DATE_FORMAT(tgl_peramalan, '%Y-%m') ASC")->result();
        $this->load->view('template/content', $data);
    }

    function get_graf()
    {
        $thn = $_POST['tahun'];
        $bln = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        for ($i = 0; $i < count($bln); $i++) {
            $tgl = $thn . '-' . $bln[$i];
            $sql = $this->db->query("SELECT * FROM tbl_peramalan WHERE DATE_FORMAT(tgl_peramalan,'%Y-%m') = '$tgl'");
            if ($sql->num_rows() > 0) {
                foreach ($sql->result() as $row) {
                    $pr[] = $row->step5;
                }
            } else {
                $pr[] = 0;
            }

            $sql = $this->db->query("SELECT * FROM tbl_peramalan_winter WHERE DATE_FORMAT(tgl_peramalan_winter,'%Y-%m') = '$tgl'");
            if ($sql->num_rows() > 0) {
                foreach ($sql->result() as $row) {
                    $prw[] = $row->ftm_winter;
                }
            } else {
                $prw[] = 0;
            }

            $sql2 = $this->db->query("SELECT SUM(jumlah_pendapatan) as jml FROM tbl_pendapatan WHERE DATE_FORMAT(tgl_pendapatan,'%Y-%m') = '$tgl'");
            if ($sql2->num_rows() > 0) {
                foreach ($sql2->result() as $row2) {
                    $da[] = $row2->jml;
                }
            } else {
                $da[] = 0;
            }
        }
?>
        <div id="container"></div>
        <script type="text/javascript">
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Perbandingan hasil peramalan dan data aktual'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'Mei',
                        'Jun',
                        'Jul',
                        'Agu',
                        'Sep',
                        'Okt',
                        'Nov',
                        'Des'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nominal (Rp)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Peramalan Brown',
                    data: [
                        <?php for ($a = 0; $a < count($bln); $a++) { ?>
                            <?php echo  $pr[$a]; ?>,
                        <?php } ?>
                    ]

                }, {
                    name: 'Peramalan Holt Winter',
                    data: [
                        <?php for ($a = 0; $a < count($bln); $a++) { ?>
                            <?php echo $prw[$a]; ?>,
                        <?php } ?>
                    ]

                }, {
                    name: 'Aktual',
                    data: [
                        <?php for ($a = 0; $a < count($bln); $a++) { ?>
                            <?php echo $da[$a]; ?>,
                        <?php } ?>
                    ]

                }, ]
            });
        </script>
<?php
    }
}
