<?php

namespace App\Http\Controllers;

use App\Models\Angkutan;
use App\Models\Tempat;
use App\Models\DasarSurat;
use App\Models\Kabid;
use App\Models\Dasar;
use App\Models\Nosurat;
use App\Models\Auth\User;
use App\Models\Bbsppd;
use App\Models\Kegiatan;
use App\Models\Keterangan;
use App\Models\Program;
use App\Models\Rekening;
use App\Models\Skpd;
use App\Models\Sppd;
use App\Models\Rincian;
use App\Models\Uang_harian;
use App\Models\Rincian_l2;
use App\Models\tgl_surat;
use App\Models\Bidang;
use App\Models\Eselon;
use App\Models\Sppd_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RincianController extends Controller
{
    public function index(Request $request)
    {
        $user = User::getUser();
        $rincian = rincian::getRincian($request->id)->first();
        if ($request->search) {
            if ($request->search >= 1) {
                $sppd = $rincian->orderBy('id', 'desc')->where('no_surat', 'LIKE', '%' . $request->search . '%')->paginate(5);
            } else {
                $sppd = $rincian->orderBy('id', 'desc')->where('acara', 'LIKE', '%' . $request->search . '%')->paginate(5);
            }
        } else {
            $sppd = $rincian->orderBy('id', 'desc')->paginate(5);
        }
        return Redirect(Route('Rincian'));
    }

    public function data (request $id)
    {
        $user = User::getUser();
        $rincian = rincian::select()->where('sppd_id',$id->id)->orderBy('sppd_id','desc')->paginate(5);
        $sppd = Sppd::getSppd($id->id)->first();
        $rincianl2 = rincian_l2::select()->where('sppd_id', $id->id)->first();
        $tgl_surat = tgl_surat::select()->where('sppd_id', $id->id)->first();
        //data
        //menambahkan halaman 404 ketika file tidak ada
        if ($sppd == null) abort(404);
       // $rincian = rincian::select()->orderBy('sppd_id', 'desc')->paginate(5);
        //dd($rincian);
         return view('sppd.users.rincian', compact('user','rincian','sppd', 'tgl_surat'));
    }
    public function entry(Request $id)
    {
        $rincian = rincian::select('sppd_id')->where('sppd_id',$id->id)->first();
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        $sppd = Sppd::getSppd($id->id)->first();
        return view('sppd.users.entryrincian', compact('user', 'tempatb', 'kabid', 'sppd', 'rincian'));
        // return view('sppd.users.entryrincian', ['user' => $user, 'tempatb'=>$tempatb, 'kabid' => $kabid, 'sppd' =>$sppd]);
        
    }

    public function entryl2(Request $id)
    {
        $rincian = rincian::select('sppd_id')->where('sppd_id',$id->id)->first();
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        $sppd = Sppd::getSppd($id->id)->first();
        return view('sppd.users.entryl2', compact('user', 'tempatb', 'kabid', 'sppd', 'rincian'));
    }

    public function entryuh(Request $id)
    {
        $rincian = rincian::select('sppd_id')->where('sppd_id',$id->id)->first();
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        $sppd = Sppd::getSppd($id->id)->first();
        $uangharian = Uang_harian::get()->where('role',$user->role)->first();
        //dd($uangharian);
        return view('sppd.users.entryrincianuh', compact('user', 'tempatb', 'kabid', 'sppd', 'rincian', 'uangharian'));
    }

    public function tglentry(Request $id)
    {
        $rincian = rincian::select('sppd_id')->where('sppd_id',$id->id)->first();
        $user = User::getUser();
        $tempatb = User::enum_get('tempat', 'tempat_berangkat');
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        $sppd = Sppd::getSppd($id->id)->first();
        $tgl_surat = tgl_surat::select('sppd_id')->where('sppd_id', $id->id)->first();
        return view('sppd.users.entrytglrincian', compact('user', 'tempatb', 'kabid', 'sppd', 'rincian', 'tgl_surat'));
    }

    public function storetglentry(Request $request)
    {
        $sppd = Sppd::getSppd($request->id)->first();
        tgl_surat::create(
            [
                'sppd_id'                   => $sppd->id,
                'tanggal_surat_rincian'     => $request->Tanggal_Surat_Rincian
            ]
            );
            session()->flash('Success', 'Berhasil Menambah Tanggal Surat');
            return Redirect(Route('Rincian').'/'.$sppd->id);
    }
    public function storeentryl2(Request $request)
    {
        // $sppdid = Sppd::select('id')->orderBy('id', 'DESC')->first();
        $sppd = Sppd::getSppd($request->id)->first();
        // $user = User::find(Auth::user()->id)->sppd()->attach($sppd->id);
        rincian_l2::create(
            [
                'sppd_id'           => $sppd->id,
                'berangkat_dari'    => $request->Berangkat_Dari,
                'tiba_di'           => $request->Tiba_Di,
                'tanggal_berangkat' => $request->Tanggal_Berangkat,
                'tanggal_tiba'      => $request->Tanggal_Tiba,
                'kepala'            => $request->Nama_Kepala
            ]
            );
            session()->flash('Success', 'Berhasil Menambah Rincian L2');
            return Redirect(Route('Rincian').'/'.$sppd->id.'/L2/Entry');
            //return Redirect(Route('Rincian').'/'.$sppd->id.'/Entry');
    }
    public function storeentry(Request $request)
    {
        // $sppdid = Sppd::select('id')->orderBy('id', 'DESC')->first();
        $sppd = Sppd::getSppd($request->id)->first();
        // $user = User::find(Auth::user()->id)->sppd()->attach($sppd->id);
        rincian::create(
            [
                'sppd_id'           => $sppd->id,
                'kegunaan_biaya'    => $request->Kegunaan_Biaya,
                'jumlah_per_hari'   => $request->Jumlah_Per_Hari,
                'tanggal_penggunaan'=> $request->Tanggal_Penggunaan,
                'tanggal_selesai'   => $request->Tanggal_Selesai,
                'keterangan'        => $request->Keterangan
            ]
            );
            session()->flash('Success', 'Berhasil Menambah Rincian');
            return Redirect(Route('Rincian').'/'.$sppd->id);
            //return Redirect(Route('Rincian').'/'.$sppd->id.'/Entry');
    }

    public function editrincian($sppd_id, $rincian)
    {   //Tambahan Revi
        $rincian = Rincian::select('*')->where('id', $rincian)->first();
        $user = User::getUser();
        $sppd = Sppd::getSppd($sppd_id)->first();
        $kabid = User::select('nama')->where('role', 'Kepala Bidang')->first();
        //editrincian
        //menambahkan halaman 404 ketika file tidak ada
        if ($rincian == null) abort(404);
        return view('sppd.users.editrincian', compact('sppd','rincian','user', 'kabid'));
    }

    public function storeeditrincian(Request $request, $sppd_id, $rincians)
    {   
        //tambahan revi
        $sppd = Sppd::getSppd($request->id)->first();
        $rincian = Rincian::select('*')->where('id', $rincians)->first();  
        $rincian->update(
            [
                'sppd_id'           => $sppd_id,
                'kegunaan_biaya'    => $request->Kegunaan_Biaya,
                'jumlah_per_hari'   => $request->Jumlah_Per_Hari,
                'tanggal_penggunaan'=> $request->Tanggal_Penggunaan,
                'tanggal_selesai'   => $request->Tanggal_Selesai,
                'keterangan'        => $request->Keterangan,
            ]
        );
        session()->flash('Success', 'Berhasil Update Rincian');
        return Redirect(Route('Rincian').'/'.$sppd->id.'/'.$rincian->id.'/Edit');
    }
    public function deleterincian($id)
    {
        $rincian = rincian::select('*')->where('id', $id)->first();
        //dd($rincian);
        rincian::destroy($rincian);
        session()->flash('Success', 'Berhasil Menghapus Rincian');
        return back();
    }
    
}