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
$pdf = new exFPDF('P', 'mm', array(330,210));
// Set Judul
$pdf->SetTitle('Rincian - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
//  Tambah Halaman
$pdf->AddPage();
// Font
$pdf->SetFont('Arial','B',12);
$pdf->image($path,15,12,16);
$pdf->Cell(0,2,'',$border,1);
$pdf->Cell(0,6,'PEMERINTAH PROVINSI JAWA TIMUR',$border,1,'C');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,6,'DINAS PEKERJAAN UMUM SUMBER DAYA AIR',$border,1,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,4,'JL. Gayung Kebonsari No. 169 Telp. (031) 8292419, 8292234, 8291711, 8295822',$border,1,'C');
$pdf->Cell(0,4,'Faks.(031) 8292047 E-mail : pengairan@jatimprov.go.id Website : www.dpuairjatimprov.go.id',$border,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,6,'SURABAYA',$border,1,'C');
$pdf->Cell(0,6,'Kode Pos 60235               ',$border,1,'R');
// Header
/*$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,'',$border,1,'C');
$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(25,5,'Lembar ke',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'..............................',$border,1,'L');
$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(25,5,'Kode No.',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'..............................',$border,1,'L');
$pdf->Cell(100,5,'',$border,0,'L');
$pdf->Cell(25,5,'Nomor',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'094 / '.$sppd->no_surat.' / 104.2 / '.$sppd->tahun_surat,$border,1,'L');
*/

$pdf->Cell(0,3,'',$border,1,'C');
$pdf->SetFont('Arial','BU',15);
$pdf->Cell(0,6,'RINCIAN BIAYA PERJALANAN DINAS',$border,1,'C');
$pdf->SetFont('Arial','',11);
$no = 1;
$pdf->Cell(0,5,'',0,1,'C');
// ================================================ Header

$pdf->SetFont('Arial','',10);

$pdf->Cell(25,5,'Lampiran SPD Nomor',$border,0,'L');
$pdf->Cell(20,5,'',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'094 / '.$sppd->no_surat.' / 104.2 / '.$sppd->tahun_surat,$border,1,'L');
$pdf->Cell(25,5,'Tanggal',$border,0,'L');
$pdf->Cell(20,5,'',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,date('d-m-Y',strtotime($tglsuratrincian->tanggal_surat_rincian)),$border,1,'L');
$pdf->Cell(25,5,'',$border,1,'L');

/*$pdf->Cell(25,5,'Lampiran SPD Nomor    :',$border,1,'L');
$pdf->Cell(25,5,'Tanggal                          :',$border,1,'L');
*/
//$isian1 = array('Uang Harian      : 1 hari  x Rp  550.000','Rp  550.000');
//$isian2 = array('Uang Harian      : 2 hari  x Rp 1.000.000', 'Rp 1.000.000');

//PAKE NATIVE FPDF
/*
class PDF extends FPDF {
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    // foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    // foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    // foreach($data as $row)
    {
        // foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

$pdf = new PDF();
// Column headings
$header = array('No', 'Negara', 'Ibukota', 'Kota Terbesar');
// Data loading
$data = $pdf->LoadData('kota.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
*/

//PAKE EASYTABLE
$no = 1;
$tabelrincian=new easyTable($pdf, '{10, 89, 45, 89, 10}', 'width:220; font-size:10; border:1; paddingY:2;');

 $tabelrincian->rowStyle('align:{CCCC}; font-style:B');
 $tabelrincian->easyCell("NO");
 $tabelrincian->easyCell("PERINCIAN BIAYA");
 $tabelrincian->easyCell("JUMLAH");
 $tabelrincian->easyCell("KETERANGAN");
 $tabelrincian->printRow();
 $total = 0;
 foreach($ambilrincian as $rincian_data) { 
    $tanggal_penggunaan = date('d-m-Y',strtotime($rincian_data->tanggal_penggunaan));
    $tanggal_selesai = date('d-m-Y',strtotime($rincian_data->tanggal_selesai));
    $lamaa = selisih($tanggal_penggunaan,$tanggal_selesai);
    $totalharga = $lamaa * $rincian_data->jumlah_per_hari;
    $total = $totalharga + $total;
    
    $tabelrincian->rowStyle(';');
    $tabelrincian->easyCell($no++, 'font-size:10; align:C; valign:T');
    $tabelrincian->easyCell($rincian_data->kegunaan_biaya.'   : '.$lamaa.' hari x '.rupiah($rincian_data->jumlah_per_hari), 'font-size:10; align:L; valign:T');
    $tabelrincian->easyCell(rupiah($totalharga), 'font-size:10; align:C; valign:T');
    $tabelrincian->easyCell(" ".$rincian_data->keterangan, 'font-size:10; align:L; valign:M');
    $tabelrincian->printRow();
}

/*
 $tabelrincian->rowStyle(';');
 $tabelrincian->easyCell($no++, 'font-size:10; valign:T');
 $tabelrincian->easyCell($isian1[0], 'font-size:10; align:L; valign:T');
 $tabelrincian->easyCell($isian1[1], 'font-size:10; align:C; valign:T');
 $tabelrincian->easyCell('', 'font-size:10; align:L; valign:M');
 $tabelrincian->printRow();

 $tabelrincian->rowStyle(';'); //min-height:37
 $tabelrincian->easyCell($no++, 'font-size:10; valign:T');
 $tabelrincian->easyCell($isian2[0], 'font-size:10; align:L; valign:T');
 $tabelrincian->easyCell($isian2[1], 'font-size:10; align:C; valign:T');
 $tabelrincian->easyCell('', 'font-size:10; align:L; valign:M');
 $tabelrincian->printRow();
*/

 $tabelrincian->rowStyle('align:{CCCC}; font-style:B');
 $tabelrincian->easyCell("");
 $tabelrincian->easyCell("J  U  M  L  A  H");
 $tabelrincian->easyCell(rupiah($total));
 $tabelrincian->easyCell("");
 $tabelrincian->printRow();

$tabelrincian->easyCell('Terbilang    : '.penyebut($total).' RUPIAH', 'colspan:4');
$tabelrincian->printRow();
$border = 0;
$tabelrincian->endTable(5);
//ini coba coba gaes ya

$tabelian=new easyTable($pdf, '{110, 73, 8}', 'width:300; font-size:10; paddingY:2;');

 $tabelian->rowStyle('align:{LLLL}; border:0');
 $tabelian->easyCell("Telah dibayar sejumlah\n ".rupiah($total));
 $tabelian->easyCell("Surabaya, ".$tanggalrincian->tgltelahmenerima."\n Telah menerima jumlah uang sebesar\n ".rupiah($total));
 $tabelian->printRow();

$tabelian->endTable(5);

$tabels=new easyTable($pdf, '{110, 73, 8}', 'width:300; font-size:10; paddingY:0; paddingX:0;');

 $tabels->rowStyle('align:{LLLL}; border:0');
 $tabels->easyCell("Bendahara pengeluaran pembantu\n");
 $tabels->easyCell("Yang Menerima\n");
 $tabels->printRow();

 $tabels->rowStyle('min-height:16');
 $tabels->easyCell("");
 $tabels->easyCell("");
 $tabels->printRow();

 $tabels->rowStyle('font-style:BU; border:0');
 $tabels->easyCell("SADIKUN, SE");
 $tabels->easyCell("MARHAENDRO EKO BASUKI, SP, M.Agr.");
 $tabels->printRow();

 $tabels->rowStyle('border:0');
 $tabels->easyCell("NIP. 19640210 199803 1 001");
 $tabels->easyCell("NIP. 19651201 199503 1 003");
 $tabels->printRow();

$tabels->endTable(5);

$pdf->SetFont('Arial','BU',20);
$pdf->Cell(0,6,'_________________________________________________',$border,1,'C');
$pdf->SetFont('Arial','',11); 
//title bawah
$pdf->Cell(0,3,'',$border,5,'C');
$pdf->Cell(0,3,'',$border,5,'C');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,3,'PERHITUNGAN SPPD RAMPUNG',$border,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,3,'',$border,5,'C');
$pdf->Cell(0,3,'',$border,5,'C');

$tabelle=new easyTable($pdf, '{48,5,40, 100, 10}', 'width:300; font-size:10; paddingY:1; paddingX:1; border-width:0.5');

 $tabelle->rowStyle('align:{LLLL}; border:0');
 $tabelle->easyCell("Ditetapkan sejumlah");
 $tabelle->easyCell(":");
 $tabelle->rowStyle('align:{LLLL}; border:0');
 $tabelle->easyCell(rupiah($total));
 $tabelle->printRow();
 $tabelle->rowStyle('align:{LLLL}; border:0');
 $tabelle->easyCell("Yang telah dibayar semula");
 $tabelle->easyCell(":");
 $tabelle->rowStyle('align:{LLLL}; border:0');
 $tabelle->easyCell(rupiah($total));
 $tabelle->printRow();
 $tabelle->rowStyle('align:{LLLL}; border:T');
 $tabelle->easyCell("Sisa kurang/lebih");
 $tabelle->easyCell(":");
 $tabelle->rowStyle('align:{LLLL}; border:T');
 $tabelle->easyCell("Rp. -");
 $tabelle->printRow();
 $tabelle->endTable(5);

 $tabelspan=new easyTable($pdf, '{48,5,40, 100, 10}', 'width:300; font-size:10; paddingY:0; paddingX:0;');
 $tabelspan->rowStyle('align:{LLCC}; border:0; font-style:B');
 $tabelspan->easyCell("", 'colspan:3');
 $tabelspan->easyCell("KUASA PENGGUNA ANGGARAN");
 $tabelspan->printRow();
 $tabelspan->rowStyle('align:{CCCC}; min-height:20; border:0');
 $tabelspan->easyCell("", 'colspan:3');
 $tabelspan->easyCell("");
 $tabelspan->printRow();
 $tabelspan->rowStyle('align:{LLCC}; border:0; font-style:BU');
 $tabelspan->easyCell("", 'colspan:3');
 $tabelspan->easyCell("Ir. RUDY NOVYANTO RIDWAN, CES");
 $tabelspan->printRow();
 $tabelspan->rowStyle('align:{LLCC}; border:0;');
 $tabelspan->easyCell("", 'colspan:3');
 $tabelspan->easyCell("NIP. 19631110 199103 1 013");
 $tabelspan->printRow();
$tabelspan->endTable(5);

//L E M B A R   K E D U A

$pdf->AddPage('P');

$tabeldowo=new easyTable($pdf, '{10,40,5,55,10,40,5,55}', 'width:220; font-size:10; border:1; paddingY:0.35;');
foreach($ambilrincianl2 as $ambill2) {
//TABEL 1 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell("");
        $tabeldowo->rowStyle('border:T;'); //55 jawaban
        $tabeldowo->easyCell("");

        //BERANGKAT DARI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("I."); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Berangkat dari (tempat kedudukan)");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:TR;'); //55 jawaban
        $tabeldowo->easyCell($ambill2->berangkat_dari);
        $tabeldowo->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell("");
        $tabeldowo->rowStyle('border:0;'); //55 jawaban
        $tabeldowo->easyCell("");

        //KE
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Ke");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell($ambill2->tiba_di);
        $tabeldowo->printRow();

    //KOLOM 3
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //40
        $tabeldowo->easyCell("", 'rowspan:2');
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell("", 'rowspan:2');
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //55 jawaban
        $tabeldowo->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell(date('d-m-Y', strtotime($ambill2->tanggal_berangkat)));
        $tabeldowo->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; align:{CCCC}'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Kepala");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("Bidang Perencanaan SDA");
        $tabeldowo->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        $tabeldowo->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabeldowo->printRow();

//TABEL 2 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("II."); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Tiba di");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:T;'); //55 jawaban
        // foreach($ambilrincianl2 as $ambill2){
            $tabeldowo->easyCell($ambill2->tiba_di);
        //}
        

        //BERANGKAT DARI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Berangkat dari");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:TR;'); //55 jawaban
        //foreach($ambilrincianl2 as $ambill2){
        $tabeldowo->easyCell($ambill2->tiba_di);
        //}
        $tabeldowo->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:0;'); //55 jawaban
        //foreach($ambilrincianl2 as $ambill2){
        $tabeldowo->easyCell(date('d-m-Y',strtotime($ambill2->tanggal_berangkat)));
        //}
        //KE
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Ke");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        //foreach($ambilrincianl2 as $ambill2){
        $tabeldowo->easyCell($ambill2->berangkat_dari);
        //}
        $tabeldowo->printRow();

    //KOLOM 3
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //40
        $tabeldowo->easyCell("Kepala", 'rowspan:2');
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":", 'rowspan:2');
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //55 jawaban
        //foreach($ambilrincianl2 as $ambill2){
        $tabeldowo->easyCell($ambill2->kepala, 'rowspan:2');
   // }
        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        //foreach($ambilrincianl2 as $ambill2){
        $tabeldowo->easyCell(date('d-m-Y',strtotime($ambill2->tanggal_berangkat)));
        //}
        $tabeldowo->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; align:{CCCC}'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Kepala");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        //foreach($ambilrincianl2 as $ambill2){
        $tabeldowo->easyCell($ambill2->kepala);
        //}
        $tabeldowo->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        $tabeldowo->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabeldowo->printRow();

//TABEL 3 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("III."); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Tiba di");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:T;'); //55 jawaban
        $tabeldowo->easyCell("");

        //BERANGKAT DARI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Berangkat dari");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:TR;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:0;'); //55 jawaban
        $tabeldowo->easyCell("");

        //KE
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Ke");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();

    //KOLOM 3
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //40
        $tabeldowo->easyCell("Kepala", 'rowspan:2');
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":", 'rowspan:2');
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //55 jawaban
        $tabeldowo->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; align:{CCCC}'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Kepala");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        $tabeldowo->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabeldowo->printRow();

//TABEL 4 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("IV."); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Tiba di");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:T;'); //55 jawaban
        $tabeldowo->easyCell("");

        //BERANGKAT DARI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Berangkat dari");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:TR;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:0;'); //55 jawaban
        $tabeldowo->easyCell("");

        //KE
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Ke");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();

    //KOLOM 3
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //40
        $tabeldowo->easyCell("Kepala", 'rowspan:2');
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":", 'rowspan:2');
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //55 jawaban
        $tabeldowo->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; align:{CCCC}'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Kepala");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        $tabeldowo->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabeldowo->printRow();

//TABEL 5 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("V."); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Tiba di");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:T;'); //55 jawaban
        $tabeldowo->easyCell("");

        //BERANGKAT DARI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Berangkat dari");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:TR;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:0;'); //55 jawaban
        $tabeldowo->easyCell("");

        //KE
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Ke");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();

    //KOLOM 3
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //40
        $tabeldowo->easyCell("Kepala", 'rowspan:2');
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":", 'rowspan:2');
        $tabeldowo->rowStyle('border:0; align:{LLLLLL}'); //55 jawaban
        $tabeldowo->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; align:{CCCC}'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Kepala");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:R;'); //55 jawaban
        $tabeldowo->easyCell("");
        $tabeldowo->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        //KOSONG     
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        $tabeldowo->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabeldowo->printRow();

//TABEL 6 BARIS
    //KOLOM 1
        //TIBA DI
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("IV."); 
        $tabeldowo->rowStyle('border:T;'); //40
        $tabeldowo->easyCell("Tiba di (tempat kedudukan)");
        $tabeldowo->rowStyle('border:T;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:T;'); //55 jawaban
        $tabeldowo->easyCell("");
        
        //SEKAT KOSONG
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:TR;'); //10
        $tabeldowo->easyCell("Telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas perintah pejabat yang berwenang dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya", 'colspan:3; rowspan:2'); 
        $tabeldowo->printRow();

    //KOLOM 2
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0;'); //40
        $tabeldowo->easyCell("Pada Tanggal");
        $tabeldowo->rowStyle('border:0;'); //5
        $tabeldowo->easyCell(":");
        $tabeldowo->rowStyle('border:0;'); //55 jawaban
        $tabeldowo->easyCell("");

        //TELAH DIPERIKSA
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{CCCCCCC}'); //40
        $tabeldowo->easyCell("", 'colspan:4');
        $tabeldowo->printRow();

    //KOLOM 3
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{CCCCCCC}'); //40
        $tabeldowo->easyCell("", 'colspan:3');

        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:R; align:{CCCCCCC}'); //40
        $tabeldowo->easyCell("", 'colspan:3');
        $tabeldowo->printRow();

    //KOLOM 4 
        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:0; align:{CCCCCCC}'); //40
        $tabeldowo->easyCell("Pengguna Anggaran / Kuasa Pengguna Anggaran / Kuasa Pengguna Anggaran Pembantu", 'colspan:3');

        $tabeldowo->rowStyle('border:L;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:R; align:{CCCCCCC}'); //40
        $tabeldowo->easyCell("Pengguna Anggaran / Kuasa Pengguna Anggaran / Kuasa Pengguna Anggaran Pembantu", 'colspan:3');
        $tabeldowo->printRow();

    //KOLOM 5 KOSONG
        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');

        $tabeldowo->rowStyle('border:LR; min-height:12'); //40,5,55
        $tabeldowo->easyCell("", 'colspan:4');
        $tabeldowo->printRow();

    //KOLOM 6
        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        $tabeldowo->rowStyle('border:LR; align:{CCCCCC}'); //40,5,55
        $tabeldowo->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');
        $tabeldowo->printRow();

//TABEL 7 BARIS
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("VII."); 
        $tabeldowo->rowStyle('border:TR;'); //40
        $tabeldowo->easyCell("Catatan Lain-lain", 'colspan:7');
        $tabeldowo->printRow();

//TABEL 8 BARIS
    //PERHATIAN
        $tabeldowo->rowStyle('border:TL;'); //10
        $tabeldowo->easyCell("VIII."); 
        $tabeldowo->rowStyle('border:TR; font-style:B'); //40
        $tabeldowo->easyCell("Perhatian", 'colspan:7'); 
        $tabeldowo->printRow();

    //ISI PERHATIAN
        $tabeldowo->rowStyle('border:LB;'); //10
        $tabeldowo->easyCell(""); 
        $tabeldowo->rowStyle('border:RB;'); //40
        $tabeldowo->easyCell("Pengguna Anggaran / Kuasa Pengguna Anggaran / Kuasa Pengguna Anggaran Pembantu yang menerbitkan SPPD, Gubernur/Wali Gubernur, Pimpinan dan Anggaran DPRD, PNS dan Pegawai Non PNS yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat / tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan pengaturan-pengaturan Keuangan Daerah apabila daerah menderita rugi akibat kesalahan kelalaian dan kealpaannya.", 'colspan:7'); 
        $tabeldowo->printRow();
}
$tabeldowo->endTable(20);

//L E M B A R   K E T I G A

$pdf->AddPage('P');

$tabelkosong=new easyTable($pdf, '{10,40,5,55,10,40,5,55}', 'width:220; font-size:10; border:0; paddingY:0.35;');
//TABEL 1 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabelkosong->rowStyle(''); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(''); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(''); //5
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(''); //55 jawaban
        $tabelkosong->easyCell("");

        //BERANGKAT DARI
        $tabelkosong->rowStyle(''); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(''); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(''); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(''); //55 jawaban
        $tabelkosong->easyCell($ambill2->berangkat_dari);
        $tabelkosong->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabelkosong->rowStyle(''); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(''); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(''); //5
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(''); //55 jawaban
        $tabelkosong->easyCell("");

        //KE
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell($ambill2->tiba_di);
        $tabelkosong->printRow();

    //KOLOM 3
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //40
        $tabelkosong->easyCell("", 'rowspan:2');
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell("", 'rowspan:2');
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //55 jawaban
        $tabelkosong->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell(date('d-m-Y',strtotime($ambill2->tanggal_berangkat)));
        $tabelkosong->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; align:{CCCC}'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("Bidang Perencanaan SDA");
        $tabelkosong->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        $tabelkosong->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabelkosong->printRow();

//TABEL 2 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :T;'); //55 jawaban
        $tabelkosong->easyCell($ambill2->tiba_di);

        //BERANGKAT DARI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :TR;'); //55 jawaban
        $tabelkosong->easyCell($ambill2->tiba_di);
        $tabelkosong->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :0;'); //55 jawaban
        $tabelkosong->easyCell(date('d-m-Y',strtotime($ambill2->tanggal_tiba)));

        //KE
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell($ambill2->berangkat_dari);
        $tabelkosong->printRow();

    //KOLOM 3
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //40
        $tabelkosong->easyCell("", 'rowspan:2');
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":", 'rowspan:2');
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //55 jawaban
        $tabelkosong->easyCell($ambill2->kepala, 'rowspan:2');

        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell(date('d-m-Y',strtotime($ambill2->tanggal_tiba)));
        $tabelkosong->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; align:{CCCC}'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell($ambill2->kepala);
        $tabelkosong->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        $tabelkosong->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabelkosong->printRow();

//TABEL 3 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell("III."); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :T;'); //55 jawaban
        $tabelkosong->easyCell("");

        //BERANGKAT DARI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :TR;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :0;'); //55 jawaban
        $tabelkosong->easyCell("");

        //KE
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();

    //KOLOM 3
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //40
        $tabelkosong->easyCell("", 'rowspan:2');
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":", 'rowspan:2');
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //55 jawaban
        $tabelkosong->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; align:{CCCC}'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        $tabelkosong->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabelkosong->printRow();

//TABEL 4 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell("IV."); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :T;'); //55 jawaban
        $tabelkosong->easyCell("");

        //BERANGKAT DARI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :TR;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :0;'); //55 jawaban
        $tabelkosong->easyCell("");

        //KE
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();

    //KOLOM 3
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //40
        $tabelkosong->easyCell("Kepala", 'rowspan:2');
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":", 'rowspan:2');
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //55 jawaban
        $tabelkosong->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; align:{CCCC}'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        $tabelkosong->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabelkosong->printRow();

//TABEL 5 BARIS 

    //KOLOM 1
        //TIBA DI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell("V."); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :T;'); //55 jawaban
        $tabelkosong->easyCell("");

        //BERANGKAT DARI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :TR;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();

    //KOLOM 2
        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :0;'); //55 jawaban
        $tabelkosong->easyCell("");

        //KE
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();

    //KOLOM 3
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //40
        $tabelkosong->easyCell("", 'rowspan:2');
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":", 'rowspan:2');
        $tabelkosong->rowStyle(' :0; align:{LLLLLL}'); //55 jawaban
        $tabelkosong->easyCell("", 'rowspan:2');

        //PADA TANGGAL
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("Pada Tanggal");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();
    
    //KOLOM 4
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; align:{CCCC}'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        
        //KEPALA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :R;'); //55 jawaban
        $tabelkosong->easyCell("");
        $tabelkosong->printRow();
    
    //KOLOM 5
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        //KOSONG     
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        $tabelkosong->printRow();
    
    //KOLOM 6 
        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        //TANDA TANGAN KEPALA
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................ )\n NIP ........................................................................", 'colspan:4');
        $tabelkosong->printRow();

//TABEL 6 BARIS
    //KOLOM 1
        //TIBA DI
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell("IV."); 
        $tabelkosong->rowStyle(' :T;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :T;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :T;'); //55 jawaban
        $tabelkosong->easyCell("");
        
        //SEKAT KOSONG
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :TR;'); //10
        $tabelkosong->easyCell("Telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas perintah pejabat yang berwenang dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya", 'colspan:3; rowspan:2'); 
        $tabelkosong->printRow();

    //KOLOM 2
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0;'); //40
        $tabelkosong->easyCell("");
        $tabelkosong->rowStyle(' :0;'); //5
        $tabelkosong->easyCell(":");
        $tabelkosong->rowStyle(' :0;'); //55 jawaban
        $tabelkosong->easyCell("");

        //TELAH DIPERIKSA
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{CCCCCCC}'); //40
        $tabelkosong->easyCell("", 'colspan:4');
        $tabelkosong->printRow();

    //KOLOM 3
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{CCCCCCC}'); //40
        $tabelkosong->easyCell("", 'colspan:3');

        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :R; align:{CCCCCCC}'); //40
        $tabelkosong->easyCell("", 'colspan:3');
        $tabelkosong->printRow();

    //KOLOM 4 
        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :0; align:{CCCCCCC}'); //40
        $tabelkosong->easyCell("Pengguna Anggaran / Kuasa Pengguna Anggaran / Kuasa Pengguna Anggaran Pembantu", 'colspan:3');

        $tabelkosong->rowStyle(' :L;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :R; align:{CCCCCCC}'); //40
        $tabelkosong->easyCell("Pengguna Anggaran / Kuasa Pengguna Anggaran / Kuasa Pengguna Anggaran Pembantu", 'colspan:3');
        $tabelkosong->printRow();

    //KOLOM 5 KOSONG
        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');

        $tabelkosong->rowStyle(' :LR; min-height:12'); //40,5,55
        $tabelkosong->easyCell("", 'colspan:4');
        $tabelkosong->printRow();

    //KOLOM 6
        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');

        $tabelkosong->rowStyle(' :LR; align:{CCCCCC}'); //40,5,55
        $tabelkosong->easyCell("( ............................................................................. )\n NIP ........................................................................", 'colspan:4');
        $tabelkosong->printRow();

//TABEL 7 BARIS
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell("VII."); 
        $tabelkosong->rowStyle(' :TR;'); //40
        $tabelkosong->easyCell("Catatan Lain-lain", 'colspan:7');
        $tabelkosong->printRow();

//TABEL 8 BARIS
    //PERHATIAN
        $tabelkosong->rowStyle(' :TL;'); //10
        $tabelkosong->easyCell("VIII."); 
        $tabelkosong->rowStyle(' :TR; font-style:B'); //40
        $tabelkosong->easyCell("Perhatian", 'colspan:7'); 
        $tabelkosong->printRow();

    //ISI PERHATIAN
        $tabelkosong->rowStyle(' :LB;'); //10
        $tabelkosong->easyCell(""); 
        $tabelkosong->rowStyle(' :RB;'); //40
        $tabelkosong->easyCell("Pengguna Anggaran / Kuasa Pengguna Anggaran / Kuasa Pengguna Anggaran Pembantu yang menerbitkan SPPD, Gubernur/Wali Gubernur, Pimpinan dan Anggaran DPRD, PNS dan Pegawai Non PNS yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat / tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan pengaturan-pengaturan Keuangan Daerah apabila daerah menderita rugi akibat kesalahan kelalaian dan kealpaannya.", 'colspan:7'); 
        $tabelkosong->printRow();

$tabelkosong->endTable(20);


$pdf->Output('I','SPT - '.$sppd->no_surat."/".$sppd->tahun_surat." - ".$sppd->acara." - ".strtotime(now()));
exit;
?>
