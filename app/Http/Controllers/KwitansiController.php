<?php

namespace App\Http\Controllers;

use App\Models\Angkutan;
use App\Models\Tempat;
use App\Models\DasarSurat;
use App\Models\Kabid;
use App\Models\Laporan;
use App\Models\Sppd;
use App\Models\Dasar;
use App\Models\Nosurat;
use App\Models\Auth\User;
use App\Models\Bbsppd;
use App\Models\Kegiatan;
use App\Models\Rincian;
use App\Models\Keterangan;
use App\Models\Program;
use App\Models\Rekening;
use App\Models\tgl_surat;
use App\Models\Skpd;
use App\Models\tgl_surat_kwitansi;
use App\Models\Sppd_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class KwitansiController extends Controller
{
    public function index()
    {
        return Redirect(Route('Kwitansi'));
    }

    public function tglentry(Request $id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id->id)->first();
        $tgl_surat = tgl_surat::select('sppd_id')->where('sppd_id', $id->id)->first();
        return view('sppd.users.entrytglkwitansi', compact('user', 'sppd', 'tgl_surat'));
        // return view('sppd.users.entryrincian', ['user' => $user, 'tempatb'=>$tempatb, 'kabid' => $kabid, 'sppd' =>$sppd]);   
    }

    public function storetglentry(Request $request)
    {
        $sppd = Sppd::getSppd($request->id)->first();
        tgl_surat::create(
            [
                'sppd_id'                   => $sppd->id,
                'tanggal_surat_kwitansi'    => $request->Tanggal_Surat_Kwitansi,
                'tempat_surat_kwitansi'     => $request->Tempat_Surat_Kwitansi
            ]
            );
            session()->flash('Success', 'Berhasil Menambah Tanggal Surat');
            return Redirect(Route('CetakKWITANSI').'/'.$sppd->id);
    }
}