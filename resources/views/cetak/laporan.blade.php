<?php
include(app_path() . '\FPDF\fpdf.php');
include(app_path() . '\FPDF\exfpdf.php');
include(app_path() . '\FPDF\easyTable.php');

// On Off Border
$border = 0;
// Path Gambar Logp
$path = public_path() . '/img/logo.png';
//PDF
$pdf = new exFPDF('P', 'mm', array(330, 210));
// Set Judul
$pdf->SetTitle('Laporan - ' . $sppd->no_surat . "/" . $sppd->tahun_surat . " - " . $sppd->acara . " - " . strtotime(now()));
//  Tambah Halaman
$pdf->AddPage();
// Font
$pdf->SetFont('Arial', 'B', 12);
$pdf->image($path, 15, 12, 16);
$pdf->Cell(0, 2, '', $border, 1);
$pdf->Cell(0, 6, 'PEMERINTAH PROVINSI JAWA TIMUR', $border, 1, 'C');
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 6, 'DINAS PEKERJAAN UMUM SUMBER DAYA AIR', $border, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 4, 'JL. Gayung Kebonsari No. 169 Telp. (031) 8292419, 8292234, 8291711, 8295822', $border, 1, 'C');
$pdf->Cell(0, 4, 'Faks.(031) 8292047 E-mail : pengairan@jatimprov.go.id Website : www.dpuairjatimprov.go.id', $border, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 6, 'SURABAYA', $border, 1, 'C');
$pdf->Cell(0, 6, 'Kode Pos 60235               ', $border, 1, 'R');
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

$pdf->Cell(0, 3, '', $border, 1, 'C');
$pdf->SetFont('Arial', 'BU', 15);
$pdf->Cell(0, 6, 'LAPORAN PERJALANAN DINAS', $border, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$no = 1;
$pdf->Cell(0, 5, '', 0, 1, 'C');
//header

//L E M B A R   K E D U A

$tabeldowo = new easyTable($pdf, '{10,40,5,100}', 'width:250; font-size:9; border:0; paddingY:1;:');
//TABEL BARIS 1 KOLOM 1
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("I.");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("DASAR");

//TABEL BARIS 1 KOLOM 2
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("SPT Plt. Kepala Bidang Perencanaan Sumber Daya Air\n
                    Dinas PU Sumber Daya Air Provinsi Jawa Timur\n
                    Tanggal\t     :   ".date('d-m-Y',strtotime($sppd->tgl_surat))."\n
                    Nomor\t\t\t\t             :   094 / ".$sppd->no_surat.' / 104.2 / '.$sppd->tahun_surat);
$tabeldowo->printRow();

//TABEL BARIS 2 KOLOM 1
$tabeldowo->rowStyle('min-height:40; border:0;');
$tabeldowo->easyCell("II.");
$tabeldowo->rowStyle('min-height:40; border:0;');
$tabeldowo->easyCell("MAKSUD TUJUAN");

//TABEL BARIS 2 KOLOM 2
$tabeldowo->rowStyle('min-height:15; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:15; border:0;');
$tabeldowo->easyCell($sppd->acara);
$tabeldowo->printRow();

//TABEL BARIS 3 KOLOM 1
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("III.");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("WAKTU PELAKSANAAN");

//TABEL BARIS 3 KOLOM 2
$tabeldowo->rowStyle('min-height:5; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:5; border:0;');
$tabeldowo->easyCell(date('d-m-Y',strtotime($sppd->tgl_pergi))." s/d ".date('d-m-Y',strtotime($sppd->tgl_kembali)));
$tabeldowo->printRow();

//TABEL BARIS 4 KOLOM 1
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell("IV.");
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell("NAMA PETUGAS");

$a = 0;
foreach ($sppduser as $sppd_data2) {
    foreach ($sppduserpegawai as $sppd_data) {
        if ($sppd_data->id == $sppd_data2->users_id) {
            if (++$a == 1) {
                $nama       = $sppd_data->nama;
                $golongan   = $sppd_data->golongan->golongan;
                $jabatan    = $sppd_data->jabatan->jabatan;
                $nip        = $sppd_data->nip; 
                $nama_eselon     = $sppd_data->eselon->nama_eselon; 
                if ($nama_eselon == "Eselon II") {
                    $klutser = "C";
                }elseif ($nama_eselon == "Eselon III" || $nama_eselon == "PJFT Gol IV/c") {
                    $klutser = "D";
                }elseif ($nama_eselon == "Eselon IV" || $nama_eselon == "PJFT Gol IV/b" || $nama_eselon == "PJFT Gol IV/a" || $nama_eselon == "PJFT Gol III") {
                    $klutser = "E";
                }elseif ($nama_eselon == "Staf Gol IV/III" || $nama_eselon == "Staf Gol II/I" || $nama_eselon == "PTT S2/S3" || $nama_eselon == "PTT S1" || $nama_eselon == "PTT D3" || $nama_eselon == "PTT D1/SMK" || $nama_eselon == "PTT SMA" || $nama_eselon == "PTT SMP/SD") {
                    $klutser = "F";
                }else {
                    $klutser = "";
                }
            }
            
        }
    }
}
//TABEL BARIS 4 KOLOM 2
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell("1. ".$nama. "\n NIP. ".$nip);
$tabeldowo->printRow();

//TABEL BARIS 5 KOLOM 1
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell("V.");
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell("DAERAH/INSTANSI YANG DIKUNJUNGI   ");

//TABEL BARIS 5 KOLOM 2
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell($tempat->tempat_tujuan);
$tabeldowo->printRow();

//TABEL BARIS 6 KOLOM 1
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell("VI.");
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell("PETUNJUK ARAHAN YANG DIBERIKAN HASIL  ");

//TABEL BARIS 6 KOLOM 2
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:30; border:0;');
$tabeldowo->easyCell($laporan->petunjuk);
$tabeldowo->printRow();
//TABEL BARIS 6 KOLOM 1
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("VII.");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("MASALAH/TEMUAN");

//TABEL BARIS 6 KOLOM 2
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell($laporan->masalah);
$tabeldowo->printRow();

//TABEL BARIS 6 KOLOM 1
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("VII.");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("SARAN TINDAKAN");

//TABEL BARIS 6 KOLOM 2
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell($laporan->saran);
$tabeldowo->printRow();

//TABEL BARIS 6 KOLOM 1
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("IX.");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell("LAIN-LAIN");

//TABEL BARIS 6 KOLOM 2
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell(":");
$tabeldowo->rowStyle('min-height:10; border:0;');
$tabeldowo->easyCell($laporan->lain_lain);
$tabeldowo->printRow();
$tabeldowo->endTable(5);
//footer
$tabelspan = new easyTable($pdf, '{10,40,5, 100,}', 'width:250; font-size:9; paddingY:1; paddingX:0;');
$tabelspan->rowStyle('align:{LLCC}; border:0;');
$tabelspan->easyCell("", 'colspan:3');
$tabelspan->easyCell("Surabaya, ".$laporan->tglcetak);
$tabelspan->printRow();
$tabelspan->rowStyle('align:{LLCC}; border:0;');
$tabelspan->easyCell("", 'colspan:3');
$tabelspan->easyCell("Pelapor,");
$tabelspan->printRow();
$tabelspan->rowStyle('align:{CCCC}; min-height:20; border:0');
$tabelspan->easyCell("", 'colspan:3');
$tabelspan->easyCell("");
$tabelspan->printRow();
$tabelspan->rowStyle('align:{LLCC}; border:0; font-style:BU');
$tabelspan->easyCell("", 'colspan:3');
$tabelspan->easyCell($nama);
$tabelspan->printRow();
$tabelspan->rowStyle('align:{LLCC}; border:0;');
$tabelspan->easyCell("", 'colspan:3');
$tabelspan->easyCell("NIP. ".$nip);
$tabelspan->printRow();
$tabelspan->endTable(5);




// Di bawah ini berada di bawah tabel

/*
$Y = $pdf->GetY();
if ($Y >= 267) {
    $pdf->AddPagePage();
}

$pdf->Cell(165, 5, '', $border, 1, 'L');
$pdf->Cell(155, 25, 'Surabaya, 10 - 1 - 2020', $border, 0, 'R');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(165, 5, '', $border, 1, 'L');
$pdf->Cell(100, 25, ' Telah dibayar sejumlah                                                                                Telah menerima jumlah uang sebesar', $border, 0, 'J');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(165, 5, '', $border, 1, 'L');
$pdf->Cell(140, 25, '  Rp.       550.000,-                                                                                        Rp.       550.000,-', $border, 0, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(200, 20, '', $border, 1, 'L');
$pdf->Cell(143, 10, ' Bendahara pengeluaran pembantu                                                             Yang Menerima,', $border, 1, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(0, 20, '', $border, 1, 'C');
$pdf->Cell(200, 5, '', $border, 1, 'L');
$pdf->Cell(150, 5, ' Nama Bendahara                                                                                         Nama Kepala Bidang', $border, 1, 'L');
//$pdf->Cell(110, 5, '', $border, 0, 'J');
//$pdf->Cell(200, 5, '', $border, 1, 'L');
$pdf->Cell(124, 5, ' NIP                                                                                                               NIP', $border, 1, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');

//sppd rampung
$pdf->Cell(0,3,'',$border,1,'C');
$pdf->SetFont('Arial','BU',20);
$pdf->Cell(0,6,'_______________________________________________',$border,1,'C');
$pdf->SetFont('Arial','',11);
//title bawah
$pdf->Cell(0,3,'',$border,5,'C');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,3,'PERHITUNGAN SPPD RAMPUNG',$border,1,'C');
$pdf->SetFont('Arial','',11);

//data total - sisa
//$pdf->Cell(150, 5, '', $border, 1, 'L');
$pdf->Cell(160, 25, 'Ditetapkan sejumlah             :   Rp.              550.000', $border, 0, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(200, 5, '', $border, 1, 'L');
$pdf->Cell(160, 25, 'Yang telah dibayar semula   :   Rp.              550.000', $border, 0, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(200, 2, '', $border, 1, 'L');
$pdf->Cell(160, 25, '___________________________________________', $border, 0, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(200, 5, '', $border, 1, 'L');
$pdf->Cell(160, 25, 'Sisa kurang/lebih                  :   Rp.                         -', $border, 0, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(145, 10, 'Pelapor,', $border, 1, 'L');
$pdf->Cell(110, 5, '', $border, 0, 'J');
$pdf->Cell(0, 20, '', $border, 1, 'L');
$pdf->Cell(85, 5, '', $border, 0, 'L');
$pdf->Multicell(72, 5, 'KUASA PENGGUNA ANGGARAN', $border, 'R');
$pdf->Cell(85, 3, '', $border, 0, 'L');
//$pdf->Multicell(105, 3, $sppd->kabid->jabatan ?? '', $border, 'L');
$pdf->Cell(85, 10, '', $border, 0, 'L');
$pdf->Multicell(72, 10, 'Nama Pengguna Anggaran'. $border . 'C');
$pdf->Cell(85, 3, '', $border, 0, 'L');
$pdf->Cell(85, 3, '', $border, 0, 'J');
$pdf->Multicell(72, 10, 'NIP Pengguna Anggaran'. $border. 'C');
$pdf->Cell(85, 3, '', $border, 0, 'J');

$pdf->Output('I', 'SPT - ' . $sppd->no_surat . "/" . $sppd->tahun_surat . " - " . $sppd->acara . " - " . strtotime(now()));
exit;

//$pdf->Cell(25,5,'',$border,1,'L');
//$pdf->Cell(100,5,'',$border,0,'L');
//$pdf->Cell(30,5,'Surabaya, ',$border,0,'L');
//$pdf->Cell(60,5, date('d-m-Y',strtotime($sppd->tgl_surat)),$border,1,'L');
//$pdf->Cell(100,5,'',$border,0,'L');
//$pdf->Cell(30,5,'Telah menerima jumlah uang sebesar',$border,0,'L');
//$pdf->Cell(100,5,'',$border,0,'L');
//$pdf->Cell(30,1,'Rp.    550.000',$border,0,'L');
//$pdf->Cell(60,5,$sppd->tempat->tempat_berangkat,$border,1,'L');
//$pdf->Cell(0,2,'',$border,1,'C');
//$pdf->Cell(100,5,'',$border,0,'L');
//$pdf->Cell(20,5,'Yang Menerima,',$border,4,'L');
//$pdf->Cell(20,5,'',$border,0,'L');
/*$pdf->SetFont('Arial','B',11);
$pdf->Cell(105,5,'KUASA PENGGUNA ANGGARAN',$border,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,12,'',$border,1,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,4,$sppd->kabid->nama_kabid,$border,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,4,$sppd->kabid->jabatan ?? '-',$border,'C');
$pdf->Cell(85,5,'',$border,0,'L');
$pdf->Multicell(105,4,'NIP. '.$sppd->kabid->nip ,$border,'C');
*/

$pdf->Output('I', 'SPT - ' . $sppd->no_surat . "/" . $sppd->tahun_surat . " - " . $sppd->acara . " - " . strtotime(now()));
exit;
