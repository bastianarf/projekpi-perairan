<?php

namespace App\Http\Controllers;

use App\Models\Angkutan;
use App\Models\Tempat;
use App\Models\DasarSurat;
use App\Models\Kabid;
use App\Models\Sppd;
use App\Models\Dasar;
use App\Models\Nosurat;
use App\Models\Auth\User;
use App\Models\Bbsppd;
use App\Models\Kegiatan;
use App\Models\Keterangan;
use App\Models\Program;
use App\Models\Rekening;
use App\Models\Skpd;
use App\Models\Laporan;
use App\Models\Tanggalkwitansi;
use App\Models\Sppd_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        return view('sppd.users.laporan', compact('surat', 'bidang', 'user'));
    }

    public function data (request $id)
    {   
        //Tambahan Revi
        $user = User::getUser();
        $laporan = Laporan::select()->where('sppd_id',$id->id)->orderBy('sppd_id','desc')->paginate(5);
        $sppd = Sppd::getSppd($id->id)->first();

        return view('sppd.users.laporandata', compact('user','laporan', 'sppd'));
    }

    public function entry(request $id)
    {
        $laporan = laporan::select('sppd_id')->where('sppd_id',$id->id)->first();
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        $sppd = Sppd::getSppd($id->id)->first();
        return view('sppd.users.laporan', compact('laporan','user', 'tempatb', 'kabid', 'sppd'));
    }
    public function create()
    {
        return view('laporan.create');
    }

    protected $request;

    public function __construct(Request $req)
    {
        $this->request = $req;
    }

    public function storeentry(Request $request)
    {
        $sppd = Sppd::getSppd($request->id)->first();
        Laporan::create(
            [
                'sppd_id'   => $sppd->id,
                'petunjuk'  => $request->Petunjuk,
                'masalah'   => $request->Masalah,
                'saran'     => $request->Saran,
                'lain_lain' => $request->Lain,
                'tglcetak'  => $request->Tglcetak
            ]
        );
        
        session()->flash('Success', 'Berhasil Menambah Laporan');
        return Redirect(Route('Laporan').'/'.$sppd->id);
    }

    public function editlaporan($sppd_id, $laporan)
    {   //Tambahan Revi
        $laporan = Laporan::select('*')->where('id', $laporan)->first();
        $user = User::getUser();
        $sppd = Sppd::getSppd($sppd_id)->first();
        return view('sppd.users.editlaporan', compact('sppd','laporan','user'));
    }


    public function storeeditlaporan(Request $request, $sppd_id, $laporans)
    {   
        //Tambahan Revi
        $sppd = Sppd::getSppd($request->id)->first();
        $laporan = Laporan::select('*')->where('id', $laporans)->first();  
        $laporan->update(
            [
                'sppd_id'     => $sppd->id,
                'petunjuk'    => $request->Petunjuk,
                'masalah'     => $request->Masalah,
                'saran'       => $request->Saran,
                'lain_lain'   => $request->Lain,
                'tglcetak'    => $request->Tglcetak
            ]


        );

        session()->flash('Success', 'Berhasil Update Laporan');
        return Redirect(Route('Laporan').'/'.$sppd->id.'/'.$laporan->id.'/Edit');
    }


    public function deletelaporan($id)
    {   
        //Tambahan Revi
        $laporan = Laporan::select('*')->where('id', $id)->first();
        Laporan::destroy($laporan);
        session()->flash('Success', 'Berhasil Menghapus Rincian');
        return back();
    }
}
