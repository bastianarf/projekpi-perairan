
@extends('layouts.app')

@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                <h3 class="text-center">Profile</h3>
                <br>
                <div class="form-group row d-flex align-items-center">
                    <label for="NIP" class="col-sm-3 col-form-label">NIP </label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8 ">
                        <input type="number" class="form-control justify-content-center @error('NIP') is-invalid @enderror" readonly id="NIP" placeholder="NIP..." name="NIP" value="{{ $user->nip }}" >
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <a href="{{ Route('Users/Profile/ChangePassword') }}" class="btn btn-primary" id="Password" placeholder=" Password..." name="Password" readonly> Ganti Password</a>
                    </div>
                </div>
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="Nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center @error('Nama') is-invalid @enderror" id="Nama" readonly placeholder=" Nama Lengkap..." name="Nama" value="{{ $user->nama }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <textarea class="form-control justify-content-center" id="Alamat" readonly placeholder=" Alamat Lengkap..." name="Alamat">{{ $user->alamat }}</textarea>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="TglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="date" class="form-control justify-content-center" id="TglLahir" placeholder=" Tanggal Lahir..." name="TglLahir" readonly value="{{ $user->tgllahir }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Golongan" class="col-sm-3 col-form-label">Golongan</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Golongan" readonly placeholder="Golongan..." name="Golongan" value="{{ $user->golongan->golongan }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Eselon" class="col-sm-3 col-form-label">Eselon</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Eselon" readonly placeholder="Eselon..." name="Eselon" value="{{ $user->eselon->nama_eselon }}">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Jabatan" readonly placeholder="Jabatan..." name="Jabatan" value="{{ $user->jabatan->jabatan }}">
                    </div>
                </div>
                <hr>
                <div class="form-group row d-flex align-items-center">
                    <label for="Role" class="col-sm-3 col-form-label">Sebagai</label>
                    <div class="col-sm-1 text-right">:</div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control justify-content-center" id="Role" readonly placeholder="Role..." name="Role" value="{{ $user->role }}">
                    </div>
                </div>
                <hr>
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <a href="{{ Route('Dashboard') }}" class="btn btn-primary btn-md"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <a href=" {{ Route('Users/Profile/Edit') }} " class="btn btn-primary btn-md">Edit User</a>
                    </div>
                    <div>
                        @if (Auth::user()->cek == 1)
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Hapus User
                        </button>
                            <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk menghapus ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Nama : {{ $user->nama }} </h6>
                                        <h6>NIP&nbsp;&nbsp;&nbsp;&nbsp; : {{ $user->nip }}</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="/Users/Profile/Delete" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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

