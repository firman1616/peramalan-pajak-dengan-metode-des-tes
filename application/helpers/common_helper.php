<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function fourDigit($value = 0){
	return sprintf("%04s", $value);
}
function tenDigit($value = 0){
	return sprintf("%010s", $value);
}

function formatDate_helper($date){
	list($dd,$mm,$yyyy) = explode("-", $date);
	return $formatedDate = $yyyy."-".$mm."-".$dd;
}

function load_libchart(){
    //include_once(base_url("system/libraries/classes/libchart.php"));
}


function bulan_indo($date){
    $bln_array  = array( '00'=>'???','01' => "Januari", '02' => "Februari", '03' => "Maret", '04' => "April", '05' => "Mei", '06' => "Juni",
                         '07' => "Juli", '08' => "Augutus", '09' => "September", '10' => "Oktober", '11' => "November", '12' => "Desember" );
    return $bln_array[$date];
}

function Terbilang($a) {
	$ambil = array(" ", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan",
				   "Sembilan", "Sepuluh", "Sebelas");
	if ($a < 12)
		return " " . $ambil[$a];
	elseif ($a < 20)
		return Terbilang($a - 10) . " Belas";
	elseif ($a < 100)
		return Terbilang($a / 10) . " Puluh" . Terbilang($a % 10);
	elseif ($a < 200)
		return " seratus" . Terbilang($a - 100);
	elseif ($a < 1000)
		return Terbilang($a / 100) . " Ratus" . Terbilang($a % 100);
	elseif ($a < 2000)
		return " seribu" . Terbilang($a - 1000);
	elseif ($a < 1000000)
		return Terbilang($a / 1000) . " Ribu" . Terbilang($a % 1000);
	elseif ($a < 1000000000)
		return Terbilang($a / 1000000) . " Juta" . Terbilang($a % 1000000);
}

/*memecah dan mengambil string terbatas pada 2 pilihan*/
function splitIntoTwo_helper($param,$delimiter,$choice){
    /*param     = string               */
    /*delimiter = pemisah mis:, (koma) */
    /*choice    = 1/2                  */
	list($a,$b) = explode($delimiter, $param);
	if($choice == 1){
		return $a;
	}else{
		return $b;
	}
}

/*memecah dan mengambil string terbatas pada 3 pilihan*/
function splitIntoThree_helper($param,$delimiter,$choice){
    /*param     = string               */
    /*delimiter = pemisah mis:, (koma) */
    /*choice    = 1/2/3                  */
	list($a,$b,$c) = explode($delimiter, $param);
	if($choice == 1){
		return $a;
	}elseif($choice == 2){
		return $b;
	}else{
		return $c;
	}
}

/*mengubah format tanggal yyyy-mm-dd ke format dd-month-yyyy*/
/*month = bulan dalam bahasa inggris dalam 3 digit*/
function reverseFormatDate_helper($date){
	list($yyyy,$mm,$dd) = explode("-", $date);
	$bln_array 	= array( '00'=>'???','01' => "Jan", '02' => "Feb", '03' => "Mar", '04' => "Apr", '05' => "May", '06' => "Jun",
						 '07' => "Jul", '08' => "Aug", '09' => "Sep", '10' => "Oct", '11' => "Nov", '12' => "Dec" );
	$mm 		= $bln_array[$mm];
	return $formatedDate = $dd."-".$mm."-".$yyyy;
}

/*mengubah format tanggal yyyy-mm-dd ke format dd-month-yyyy*/
/*month = bulan dalam bahasa inggris*/
function reverseFormatDateIndo_helper($date){
	list($yyyy,$mm,$dd) = explode("-", $date);
	$bln_array 	= array( '00'=>'???','01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "Juny",
						 '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December" );
	$mm 		= $bln_array[$mm];
	return $formatedDate = $dd."-".$mm."-".$yyyy;
}

/*mengubah format hari inggris ke indonesia*/
function hari_helpers($days){
	$bln_array 	= array( 'Monday'=>'Senin','Tuesday' => "Selasa", 'Wednesday' => "Rabu", 'Thursday' => "Kamis", 'Friday' => "Jumat", 'Saturday' => "Sabtu", 'Sunday' => "Minggu");
	$hari 		= $bln_array[$days];
	return $hari;
}

/*mengubah format bulan angka 2 digit ke format bulan*/
function completeFormatMonth_helper($month){
	$bln_array 	= array( '00'=>'???','01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "Juny",
						 '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December" );
	return $month 		= $bln_array[$month];
}

/*mengubah format bulan angka 2 digit ke format bulan indonesia*/
function completeFormatMonthIndo_helper($month){
	$bln_array 	= array( '00'=>'???','01' => "Januari", '02' => "Februari", '03' => "Maret", '04' => "April", '05' => "Mei", '06' => "Juni",
						 '07' => "Juli", '08' => "Agustus", '09' => "September", '10' => "Oktober", '11' => "November", '12' => "Desember" );
	return $month 		= $bln_array[$month];
}

/*mengubah format tanggal yyyy-mm-dd ke format dd-month-yyyy*/
/*month = bulan dalam bahasa indonesia*/
function completeFormatDateIndo_helper($date,$delimeter){
	list($yyyy,$mm,$dd) = explode("-", $date);
	$mm 		= completeFormatMonthIndo_helper($mm);
	return $formatedDate = $dd.$delimeter.$mm.$delimeter.$yyyy;
}

/*hapus semua koma dalam string*/
function deleteComma($param){
	return $value = str_replace(",","", $param);
}

/*ubah format tanggal yyyy-mm-dd ke dd-mm-yyyy*/
function reverseNormalFormatDate_helper($date){
	list($yyyy,$mm,$dd) = explode("-", $date);
	return $formatedDate = $dd."-".$mm."-".$yyyy;
}

/*echo link back*/
function echoLinkBack_helper(){
	return "<a href='javascript:void(0)' onclick='back();'>back</a>";
}


?>