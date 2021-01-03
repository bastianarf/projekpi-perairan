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

class TanggalkwitansiController extends Controller
{

    public function index()
    {
        //
        return view('sppd.users.entrytanggalkwitansi', compact('surat', 'bidang', 'user'));
    }

        public function data (request $id)
    {   
        //Tambahan Revi
        $user = User::getUser();
        $tanggalkwitansi = Tanggalkwitansi::select()->where('sppd_id',$id->id)->orderBy('sppd_id','desc')->paginate(5);
        $sppd = Sppd::getSppd($id->id)->first();
        if ($sppd == null) abort(404);
        return view('sppd.users.tanggalkwitansidata', compact('user','tanggalkwitansi', 'sppd'));
    }


    public function entry(request $id)
    {
        //
        $tanggalkwitansi = Tanggalkwitansi::select('sppd_id')->where('sppd_id',$id->id)->first();
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        $sppd = Sppd::getSppd($id->id)->first();
        return view('sppd.users.entrytanggalkwitansi', compact('tanggalkwitansi','user', 'tempatb', 'kabid', 'sppd'));
    }

    public function create()
    {
        return view('entrytanggalkwitansi.create');
    }

    protected $request;

    public function __construct(Request $req)
    {
        $this->request = $req;
    }


    public function storeentry(Request $request)
    {
        $sppd = Sppd::getSppd($request->id)->first();
        Tanggalkwitansi::create(
            [
                'sppd_id'   => $sppd->id,
                'tglbendahara'  => $request->Tglbendahara,
                'tglyangmenerima'   => $request->Tglyangmenerima
            ]
        );
        
        session()->flash('Success', 'Berhasil Menambah Tanggal Kwitansi');
        return Redirect(Route('Tanggalkwitansi').'/'.$sppd->id);
    }

    public function edittanggalkwitansi($sppd_id, $tanggalkwitansi)
    {   //Tambahan Revi
        $tanggalkwitansi = Tanggalkwitansi::select('*')->where('id', $tanggalkwitansi)->first();
        $user = User::getUser();
        $sppd = Sppd::getSppd($sppd_id)->first();
        if ($tanggalkwitansi == null) abort(404);
        return view('sppd.users.edittanggalkwitansi', compact('sppd','tanggalkwitansi','user'));
    }

    public function storeedittanggalkwitansi(Request $request, $sppd_id, $tanggalkwitansis)
    {   
        //Tambahan Revi
        $sppd = Sppd::getSppd($request->id)->first();
        $tanggalkwitansi = Tanggalkwitansi::select('*')->where('id', $tanggalkwitansis)->first();  
        $tanggalkwitansi->update(
            [
                'sppd_id'     => $sppd->id,
                'tglbendahara'  => $request->Tglbendahara,
                'tglyangmenerima'   => $request->Tglyangmenerima
            ]


        );

        session()->flash('Success', 'Berhasil Update Tanggal Kwitansi');
        return Redirect(Route('Tanggalkwitansi').'/'.$sppd->id.'/'.$tanggalkwitansi->id.'/Edit');
    }
    public function deletetanggalkwitansi($id)
    {   
        //Tambahan Revi
        $tanggalkwitansi = Tanggalkwitansi::select('*')->where('id', $id)->first();
        Tanggalkwitansi::destroy($tanggalkwitansi);
        session()->flash('Success', 'Berhasil Menghapus Tanggal Kwitansi');
        return back();
    }


}
