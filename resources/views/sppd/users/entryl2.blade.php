<?php
function rupiah ($angka)
{
    $hasil_rupiah = "Rp " .number_format($angka,0,',','.');
    return $hasil_rupiah;
}
?>
@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<style>
    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
    top: 5px;
    right: 10px;
    }
    .select2-container .select2-selection--single {
        height: 38px;
    }
    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
    color: rgb(107, 107, 107);
    line-height: 20px;
    font-size: 0.8em;
    }

</style>
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
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                <h3 class="text-center">Surat Perintah Tugas (SPT) <br> Surat Perintah Perjalanan Dinas (SPPD) <br> Rincian Perjalanan Dinas <br> Lembar L2 </h3>  
                <hr>
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                <form method="POST" action="{{ Route('Rincian') }}/{{ $sppd->id }}/L2/Entry">
                    @csrf
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Berangkat" class="col-sm-4 col-form-label">Berangkat Dari <div class="text-secondary small">( Berangkat Dari )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Maksud" placeholder="Berangkat Dari.." required name="Berangkat_Dari">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tiba" class="col-sm-4 col-form-label">Tiba Di<div class="text-secondary small">( Tiba Di )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Maksud" placeholder="Tiba Di.." required name="Tiba_Di">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_berangkat" class="col-sm-4 col-form-labe ">Tanggal Berangkat</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content @error('tanggal_berangkat') is-invalid @enderror" id="Tgl_berangkat" placeholder="Tanggal Berangkat.." required name="Tanggal_Berangkat" >
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_tiba" class="col-sm-4 col-form-label">Tanggal Tiba</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content @error('tanggal_tiba') is-invalid @enderror" id="Tgl_tiba" placeholder="Tanggal Tiba.." required name="Tanggal_Tiba">
                            @error('tanggal_tiba')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>    
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="Keterangan" class="col-sm-4 col-form-label">Kepala <div class="text-secondary small">( Kepala )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Kepala" placeholder="Ketikkan Nama Kepala.." required name="Nama_Kepala">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning btn-md float-right">TAMBAH DATA L2</button>
                </form>
                    @if ($rincian != null)
                        <a class="btn btn-primary btn-md float-left" href="{{ Route('Rincian') }}/{{ $sppd->id }}">SELESAI</a>
                    @else
                    @endif
                <br>
                <br>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script-down')
<script type="text/javascript">
    $(document).ready(function() {
        $('#nama').select2();
        $('#TBerangkat').select2();
        $('#TTujuan').select2();
    });
</script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endsection