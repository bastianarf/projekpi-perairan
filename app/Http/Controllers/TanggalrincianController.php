<?php

namespace App\Http\Controllers;

use App\Models\Tanggalrincian;
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

class TanggalrincianController extends Controller
{

public function index()
    {
        //
        return view('sppd.users.entrytanggalrincian', compact('surat', 'bidang', 'user'));
    }

        public function data (request $id)
    {   
        //Tambahan Revi
        $user = User::getUser();
        $tanggalrincian = Tanggalrincian::select()->where('sppd_id',$id->id)->orderBy('sppd_id','desc')->paginate(5);
        $sppd = Sppd::getSppd($id->id)->first();
        //data
        //menambahkan halaman 404 ketika file tidak ada
        if ($sppd == null) abort(404);
        return view('sppd.users.tanggalrinciandata', compact('user','tanggalrincian', 'sppd'));
    }


    public function entry(request $id)
    {
        //
        $tanggalrincian = Tanggalkwitansi::select('sppd_id')->where('sppd_id',$id->id)->first();
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        $sppd = Sppd::getSppd($id->id)->first();
        return view('sppd.users.entrytanggalrincian', compact('tanggalrincian','user', 'tempatb', 'kabid', 'sppd'));
    }

    public function create()
    {
        return view('entrytanggalrincian.create');
    }

    protected $request;

    public function __construct(Request $req)
    {
        $this->request = $req;
    }


    public function storeentry(Request $request)
    {
        $sppd = Sppd::getSppd($request->id)->first();
        Tanggalrincian::create(
            [
                'sppd_id'   => $sppd->id,
                'tgltelahmenerima'  => $request->Tgltelahmenerima
            ]
        );
        
        session()->flash('Success', 'Berhasil Menambah Tanggal Rincian');
        return Redirect(Route('Tanggalrincian').'/'.$sppd->id);
    }

    public function edittanggalrincian($sppd_id, $tanggalrincian)
    {   //Tambahan Revi
        $tanggalrincian = Tanggalrincian::select('*')->where('id', $tanggalrincian)->first();
        $user = User::getUser();
        $sppd = Sppd::getSppd($sppd_id)->first();
        if ($tanggalrincian == null) abort(404);
        return view('sppd.users.edittanggalrincian', compact('sppd','tanggalrincian','user'));
    }

    public function storeedittanggalrincian(Request $request, $sppd_id, $tanggalrincians)
    {   
        //Tambahan Revi
        $sppd = Sppd::getSppd($request->id)->first();
        $tanggalrincian = Tanggalrincian::select('*')->where('id', $tanggalrincians)->first();  
        $tanggalrincian->update(
            [
                'sppd_id'     => $sppd->id,
                'tgltelahmenerima'  => $request->Tgltelahmenerima
            ]
        );

        session()->flash('Success', 'Berhasil Update Tanggal Rincian');
        return Redirect(Route('Tanggalrincian').'/'.$sppd->id.'/'.$tanggalrincian->id.'/Edit');
    }
    public function deletetanggalrincian($id)
    {   
        //Tambahan Revi
        $tanggalrincian = Tanggalrincian::select('*')->where('id', $id)->first();
        Tanggalrincian::destroy($tanggalrincian);
        session()->flash('Success', 'Berhasil Menghapus Tanggal Rincian');
        return back();
    }
}
