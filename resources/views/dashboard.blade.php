@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')

    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0"
        style="background-color: rgb(0, 183, 255)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')

            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                @if (session()->get('Login'))
                <img src="{{ asset('img/gres.png') }}" class="rounded mx-auto d-block img-fluid figure-img"
                    alt="Logo PUSDA" width="20%">
                <figcaption class=" text-center">Dinas Pekerjaan Umum Sumber Daya Air</figcaption>
                <h2 class="text-center">{{ session()->get('Login')  }} {{ $user->nama }}</h2>
                <br>
                @endif
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                <div iv class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-left"> <i class="fa fa-envelope"></i> &nbsp;Data SPPD</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">SPPD Berjalan</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Total SPPD </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">{{ $user->sppd->count() }}</div>
                                </div>
                                <hr>
                                <a href="#" class="btn btn-primary btn-block">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    @if ($user->role_check(['Admin']))
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body ">
                                <h5 class="card-title text-left"> <i class="fa fa-users"></i>&nbsp; Data Users</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Admin </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">
                                        {{ $user->where('role','Admin')->where('cek','1')->count() }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Kepala Bidang </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">
                                        {{ $user->where('role','Kepala Bidang')->where('cek','1')->count() }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Kepala Seksi </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">
                                        {{ $user->where('role','Kepala Seksi')->where('cek','1')->count() }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Staff</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">
                                        {{ $user->where('role','Staff')->where('cek','1')->count() }}
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ Route('Admin/Show') }}" class="btn btn-primary btn-block">Lihat
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body ">
                                <h5 class="card-title text-left"> <i class="fa fa-users"></i>&nbsp; Data Pegawai</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">Total Pegawai </div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-5 text-left">
                                        {{ $user->where('cek',1)->count() }}</div>
                                </div>
                                <hr>
                                <a href="{{ Route('Pegawai') }}" class="btn btn-primary btn-block">Lihat
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-down')
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection
