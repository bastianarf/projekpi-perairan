<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use App\Models\Rincian;
use App\Models\Bidang;
use App\Models\Tempat;
use App\Models\Uang_harian;
use App\Models\rincian_l2;
use App\Models\tgl_surat;
use App\Models\Tanggalkwitansi;
use App\Models\Tanggalrincian;
use App\Models\laporan;
use App\Models\Eselon;
use App\Models\Auth\User;
use App\Models\Sppd_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CetakController extends Controller
{
    public function index()
    {
        return Redirect(Route('SPPD'));
    }
    public function SPT($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        if (Sppd::CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            $sppd->update([
                'tgl_surat'=> now()
            ]);
            $tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            $tgl_kembali = date('d-m-Y',strtotime($sppd->tgl_kembali));
            $lama = Sppd::selisih($tgl_pergi,$tgl_kembali);
            $tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            $bidang = Bidang::first();
            return view('cetak.spt',compact('user','sppd','lama','sppduser','sppduserpegawai','bidang'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
    }
    public function SPPD($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        if (Sppd::CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            $sppd->update([
                'tgl_surat'=> now()
            ]);
            $tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            $tgl_kembali = date('d-m-Y',strtotime($sppd->tgl_kembali));
            $lama = Sppd::selisih($tgl_pergi,$tgl_kembali);
            //$tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            $bidang = Bidang::first();
            return view('cetak.sppd',compact('user','sppd','lama','sppduser','sppduserpegawai','bidang'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
    }

    public function rincian($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        $rincian = Rincian::getRincian($id);
        $rincianl2 = Rincian_l2::getRincianl2($id);
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        $ambilrincian = Rincian::select()->where('sppd_id', $id)->get();
        $ambilrincianl2 = Rincian_l2::select()->where('sppd_id', $id)->get();
        $tglsuratrincian = tgl_surat::select()->where('sppd_id', $id)->first();
        $tanggalrincian = Tanggalrincian::select()->where('sppd_id', $id)->first();
        //dd($ambilrincian);
        if (Sppd::CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            $rincian = $rincian->first();
            $sppd->update([
                'tgl_surat' => now()
                //     'tgl_surat'=> date('d-m-Y', strtotime(now()))
            ]);
            // $tanggal_penggunaan = date('d-m-Y',strtotime($rincian->tanggal_penggunaan));
            // $tanggal_selesai = date('d-m-Y',strtotime($rincian->tanggal_selesai));
            // $lamaa = Rincian::selisih($tanggal_penggunaan,$tanggal_selesai);
            //$tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            //$tgl_kembali = date('d-m-Y',strtotime($sppd->tgl_kembali));
            //$tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            //$bidang = Bidang::first();
            return view('cetak.rincian',compact('user','sppd','rincian','rincianl2','ambilrincianl2','sppduser','sppduserpegawai','ambilrincian','tglsuratrincian', 'tanggalrincian'));
        }else {
            return view('sppd.users.akses',compact('user'));
        }
    }
    public function KWITANSI($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        $rincian = Rincian::getRincian($id);
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        $tglkwitansi = tgl_surat::select()->where('sppd_id', $id)->first();
        $ambilrincian = Rincian::select()->where('sppd_id', $id)->get();
        $tanggalkwitansi = Tanggalkwitansi::select()->where('sppd_id', $id)->first();
        if (Sppd::CekUserSppd($user,$sppd)) {
            $sppd = $sppd->first();
            $rincian = $rincian->first();
            $sppd->update([
                'tgl_surat'=> now()
            ]);
            $tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            $tgl_kembali = date('d-m-Y',strtotime($sppd->tgl_kembali));
            $lama = Sppd::selisih($tgl_pergi,$tgl_kembali);
            $tgl_pergi = date('d-m-Y',strtotime($sppd->tgl_pergi));
            $bidang = Bidang::first();
            return view('cetak.kwitansi',compact('user','sppd','lama','tglkwitansi','tanggalkwitansi','sppduser','sppduserpegawai','rincian', 'ambilrincian'));
        }
        else {
            return view('sppd.users.akses',compact('user'));
        }
    }

    public function Laporan($id)
    {
        $user = User::getUser();
        $sppd = Sppd::getSppd($id);
        $tempat = Tempat::select()->where('sppd_id', $id)->first();
        $laporan = Laporan::select()->where('sppd_id', $id)->first();
        $sppduser = Sppd_user::orderBy('created_at', 'ASC')->where('sppd_id', $id)->get();
        $sppduserpegawai = User::select()->get();
        if (Sppd::CekUserSppd($user, $sppd)) {
            $sppd = $sppd->first();
            $sppd->update([
                'tgl_surat' => now()
            ]);
            $tgl_pergi = date('d-m-Y', strtotime($sppd->tgl_pergi));
            $tgl_kembali = date('d-m-Y', strtotime($sppd->tgl_kembali));
            $lama = Sppd::selisih($tgl_pergi, $tgl_kembali);
            $tgl_pergi = date('d-m-Y', strtotime($sppd->tgl_pergi));
            $bidang = Bidang::first();
            return view('cetak.laporan', compact('user', 'sppd', 'lama','laporan','tempat', 'sppduser', 'sppduserpegawai', 'bidang'));
        } else {
            return view('sppd.users.akses', compact('user'));
        }
    }
}
