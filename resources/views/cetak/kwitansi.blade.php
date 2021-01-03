<?php
function selisih($awal, $akhir)
{
    $awal = date_create($awal);
    $akhir = date_create($akhir);
    $diff  = date_diff( $awal, $akhir );
    $angka = $diff->d+1;
    return $angka;
    //return $angka." "."( ".Rincian::penyebut($angka)." )";
}
function penyebut($angka)
     {
         $angka = abs($angka);
         $huruf = array('','SATU','DUA','TIGA','EMPAT','LIMA','ENAM','TUJUH','DELAPAN','SEMBILAN','SEPULUH','SEBELAS');
         $temp  = '';
         if ($angka < 12) {
             $temp = ' '.$huruf[$angka];
         }elseif ($angka < 20) {
             $temp = penyebut($angka-10). " BELAS";
         }elseif ($angka < 100) {
             $temp = penyebut($angka/10). " PULUH".penyebut($angka % 10);
         }elseif ($angka < 200) {
             $temp = " SERATUS".penyebut($angka-100);
         }elseif ($angka < 1000) {
             $temp = penyebut($angka/100).' RATUS'.penyebut($angka%100);
         }elseif ($angka < 2000) {
             $temp = ' SERIBU'.penyebut($angka-1000);
         }elseif ($angka < 1000000) {
             $temp = penyebut($angka/1000). ' RIBU'.penyebut($angka%1000);
         }elseif ($angka < 1000000000) {
             $temp = penyebut($angka/1000000). ' JUTA'.penyebut($angka%1000000);
         }elseif ($angka < 1000000000000) {
             $temp = penyebut($angka/1000000000). ' MILIAR'.penyebut(fmod($angka,1000000000));
         }elseif ($angka < 1000000000000000) {
             $temp = penyebut($angka/1000000000000). ' TRILIUN'.penyebut(fmod($angka,1000000000000));
         }
         return $temp;
     }
function rupiah ($angka)
{
    $hasil_rupiah = "Rp " .number_format($angka,0,',','.');
    return $hasil_rupiah;
}

include(app_path().'\FPDF\fpdf.php');
include(app_path().'\FPDF\exfpdf.php');
include(app_path().'\FPDF\easyTable.php');
// On Off Border
$border = 0;
// Path Gambar Logp
$path = public_path() . '/img/logo.png';
//PDF
$pdf = new FPDF('P', 'mm', array(330,210));
// Set Judul
$pdf->SetTitle('Kwitansi - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
//  Tambah Halaman
$pdf->AddPage();
// Font
$pdf->SetFont('Arial','',10);

// $pdf->image($path,15,12,16);
$total = 0;
foreach($ambilrincian as $rincian_data) { 
    $tanggal_penggunaan = date('d-m-Y',strtotime($rincian_data->tanggal_penggunaan));
    $tanggal_selesai = date('d-m-Y',strtotime($rincian_data->tanggal_selesai));
    $lamaa = selisih($tanggal_penggunaan,$tanggal_selesai);
    $totalharga = $lamaa * $rincian_data->jumlah_per_hari;
    $total = $totalharga + $total;
}
$pdf->Cell(0,2,'',$border,1);
$pdf->Cell(1,6,'Keluaran : 2020',$border,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(53,2,'5.2.2.15.02',$border,1,'C');
$pdf->Cell(0,-2,'',$border,1);
$pdf->Cell(1,6,'Tentang  :',$border,1,'L');
$pdf->Cell(0,-2,'',$border,1);
$pdf->Cell(86,2,'Belanja Perjalanan Dinas Dalam',$border,1,'C');
$pdf->Cell(0,2,'',$border,1);
$pdf->Cell(47,2,'Daerah',$border,1,'C');
$pdf->Cell(0,-2,'',$border,1);
$pdf->Cell(33,1,':',$border,1,'C');
$pdf->Cell(33,-20,'',$border,1,'C');
$pdf->Cell(160,6,'KWT /SPPD/        /104.2/1/2020',$border,1,'R');
$pdf->Cell(93,10,'',0,0,'R');
$pdf->Cell(39,10,'',1,0,'R');
$pdf->Cell(43,10,'',1,0,'R');
$pdf->Cell(33,2,'',$border,1,'C');
$pdf->Cell(120,6,'NO. BKU / HAL',$border,1,'R');
$pdf->Cell(33,-6,'',$border,1,'C');
$pdf->Cell(175,6,'104.2/GU/        /        /2020',$border,1,'R');
$pdf->Cell(33,2,'',$border,1,'C');
$pdf->Cell(93,10,'',0,0,'R');
$pdf->Cell(39,10,'',1,0,'R');
$pdf->Cell(43,10,'',1,0,'R');
$pdf->Cell(33,0,'',$border,1,'C');
$pdf->Cell(123,6,'NO. PROGRAM /',$border,1,'R');
$pdf->Cell(33,-2,'',$border,1,'C');
$pdf->Cell(121,6,'NO. KEGIATAN',$border,1,'R');
$pdf->Cell(33,-8,'',$border,1,'C');
$pdf->Cell(170,6,'10384               001',$border,1,'R');
$pdf->Cell(0,10,'',$border,1,'C');
$pdf->SetFont('Arial','BU',15);
$pdf->Cell(0,15,'K W I T A N S I',$border,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,5,'Dari                   : Kepala Dinas PU Sumber Daya Air Provinsi Jawa Timur',$border,0,'L');
$pdf->Cell(156,10,'  ...........................................................................................................................................................',$border,0,'R');
$pdf->Cell(-152,20,': ',$border,0,'R');
$pdf->Cell(68,20,penyebut($total).' RUPIAH',$border,1,'L');
$pdf->Cell(181,-16,'  ...........................................................................................................................................................',$border,0,'R');
$pdf->Cell(-94,-5,'Pembayaran     : Lumsum Perjalanan Dinas Gol IV  ke',$border,0,'R');
$pdf->Cell(25,-5,$sppd->tempat->tempat_tujuan,$border,1,'R');
//$pdf->Cell(150,5,'selama',$border,2,'R');
$pdf->Cell(181,5,'selama   '.$lama.'   hari   mulai tgl.',$border,1,'R');
$pdf->Cell(181,0,'  ...........................................................................................................................................................',$border,1,'R');
$pdf->Cell(47.2,10,date(': d-m-Y',strtotime($sppd->tgl_pergi)),$border,0,'R');
$pdf->Cell(47,10,'s/d',$border,0,'L');
$pdf->Cell(-20,10,date('d-m-Y',strtotime($sppd->tgl_kembali)),$border,0,'R');
$pdf->Cell(38,10,'sesuai SPT  SPPD No:',$border,0,'R');
$pdf->Cell(35,10,'094 / '.$sppd->no_surat.' / 104.2 / '.$sppd->tahun_surat,$border,0,'R');
$pdf->Cell(13,10,'tanggal',$border,0,'R');
$pdf->Cell(21,10,date('d-m-Y,',strtotime($sppd->tgl_pergi)),$border,0,'R');
$pdf->Cell(-0.2,15,'  ...........................................................................................................................................................',$border,0,'R');
$pdf->Cell(-109,25,'dengan perincian terlampir.',$border,0,'R');
$pdf->Cell(109,30,'  ...........................................................................................................................................................',$border,0,'R');
$pdf->Cell(-0.2,45,'  ...........................................................................................................................................................',$border,1,'R');
$pdf->Cell(0,-18,'',$border,1,'C');
$pdf->Cell(18,8,'',0,0,'R');
$pdf->Cell(75,8,'',1,0,'R');
$pdf->Cell(0,-8,'',$border,1,'C');
$pdf->Cell(25,25,'Terbilang ',$border,0,'L');
$pdf->Cell(27,25,rupiah($total),$border,1,'R');
$pdf->Cell(0,3,'',$border,1,'C');


$pdf->Cell(0,2,'',$border,1,'C');
$pdf->Cell(1,5,'',$border,0,'L');
$pdf->Cell(55,5,'Setuju dibayar ',$border,1,'C');
$pdf->Cell(1,5,'',$border,0,'L');
$pdf->Cell(55,5,'Jasa Pengguna Anggaran',$border,1,'C');
$pdf->Cell(0,20,'',$border,1,'C');
$pdf->Cell(-13,5,'',$border,0,'L');
$pdf->SetFont('Arial','U',9);
$pdf->Multicell(70,5,'Ir. RUDY NOVYANTO RIDWAN, CES',$border,'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(1,5,'',$border,0,'L');
$pdf->Cell(1,5,'',$border,0,'L');
$pdf->Multicell(55,5,'NIP. 19631110 199103 1 013',$border,'C');
$pdf->Cell(0,-47,'',$border,1,'C');

$pdf->Cell(0,2,'',$border,1,'C');
$pdf->Cell(45,5,'',$border,0,'L');
$pdf->Cell(105,12,$tanggalkwitansi->tglbendahara,$border,0,'C');
$pdf->Cell(-105,14,'Tgl........................................ ',$border,1,'C');
$pdf->Cell(45,-2,'',$border,0,'L');
$pdf->Cell(105,-2,'Bendahara Pengeluaran Pembantu',$border,1,'C');
$pdf->Cell(0,23,'',$border,1,'C');
$pdf->Cell(44,5,'',$border,0,'L');
$pdf->SetFont('Arial','U',9);
$pdf->Multicell(105,5,'SADIKUN, SE',$border,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,5,'',$border,0,'L');

$pdf->Cell(-0.1,5,'',$border,0,'L');
$pdf->Multicell(105,5,'NIP. 19640210 199803 1 001 ',$border,'C');
$pdf->Cell(0,-47,'',$border,1,'C');

$pdf->Cell(0,4.5,'',$border,1,'C');
$pdf->Cell(110,5,'',$border,0,'L');
$pdf->Cell(103,10,'Surabaya, '.$tanggalkwitansi->tglyangmenerima,$border,1,'C');
$pdf->Cell(110,5,'',$border,0,'L');
$pdf->Cell(105,2,'Yang Menerima',$border,1,'C');
$pdf->Cell(0,20,'',$border,1,'C');
$pdf->Cell(109,5,'',$border,0,'L');
$pdf->SetFont('Arial','U',9);
$pdf->Multicell(105,5,'CATUR ARIK KURNIAWATI, ST. M.Eng',$border,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(110,5,'',$border,0,'L');

$pdf->Cell(26,5,'',$border,0,'L');
$pdf->Multicell(50,5,'NIP. 19790325 200501 2 009',$border,'C');
$pdf->Cell(0,-47,'',$border,1,'C');


$pdf->Output('I','SPT - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
exit;
?>
