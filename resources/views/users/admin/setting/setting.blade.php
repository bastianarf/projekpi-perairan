
@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        @if ($user->role_check(['Admin']))
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                <h3 class="text-center">Pengaturan</h3>
                <br>
                <form action="{{ Route('SetNomorSurat') }}" method="post" class="form-group row d-flex align-items-center">
                    @method('patch')
                    @csrf
                    <label for="Role" class="col-sm-3 col-form-label">Set Nomor Surat</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control justify-content-center" id="NomorSurat" placeholder="Nomor Surat..." name="NomorSurat" value="{{ old('NomoSurat') ?? $surat->no_surat }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                </form>
                <form action="{{ Route('SetTahunSurat') }}" method="post" class="form-group row d-flex align-items-center">
                    @method('patch')
                    @csrf
                    <label for="Role" class="col-sm-3 col-form-label">Set Tahun Surat</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control justify-content-center" id="TahunSurat" placeholder="Tahun Surat" name="TahunSurat" value="{{ old('TahunSurat') ?? $surat->tahun_surat }}" min="1900" max="3000" step="1">
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                </form>
                <div class="form-group row d-flex align-items-center">
                    <label for="DasarSPPD" class="col-sm-3 col-form-label">Dasar SPPD</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('DasarSurat') }}" class="btn btn-primary" id="DasarSPPD" placeholder=" Password..." name="Password" readonly> Ganti Dasar SPPD</a>
                    </div>
                </div>
                <form action="{{ Route('SetBidang') }}" method="post" class="form-group row d-flex align-items-center">
                    @method('patch')
                    @csrf
                    <label for="Bidang" class="col-sm-3 col-form-label">Set Bidang</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control justify-content-center" id="Bidang" placeholder="Nama Bidang" name="Nama_Bidang" value="{{ old('Nama_Bidang') ?? $bidang->nama_bidang }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                </form>
                <div class="form-group row d-flex align-items-center">
                    <label for="SKPD" class="col-sm-3 col-form-label">SKPD</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('SKPD') }}" class="btn btn-primary" id="SKPD" placeholder=" SKPD..." name="SKPD" readonly>Set SKPD</a>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Program" class="col-sm-3 col-form-label">Program</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('Program') }}" class="btn btn-primary" id="Program" placeholder="Program..." name="Program" readonly>Set Program</a>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Kegiatan" class="col-sm-3 col-form-label">Kegiatan</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('Kegiatan') }}" class="btn btn-primary" id="Kegiatan" placeholder="Kegiatan..." name="Kegiatan" readonly>Set Kegiatan</a>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Rekening" class="col-sm-3 col-form-label">Rekening</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('Rekening') }}" class="btn btn-primary" id="Rekening" placeholder="Rekening..." name="Rekening" readonly>Set Rekening</a>
                    </div>
                </div>
            </div>
            
        </div>
        @else
        @include('layouts.akses')
        @endif
    </div>
</div>

@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection

