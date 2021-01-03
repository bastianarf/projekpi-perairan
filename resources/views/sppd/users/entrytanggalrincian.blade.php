@extends('layouts.app')

@section('title', request()->path() )
@section('content')
<style>
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 5px;
        right: 10px;
    }

    .select2-container .select2-selection--single {
        height: 38px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: rgb(107, 107, 107);
        line-height: 20px;
        font-size: 0.8em;
    }
</style>
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')

    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">

<!-- button kembali -->
        <tr>
            <td width="135px">
            <a href="{{ Route('Tanggalrincian') }}/{{ $sppd->id }}"class="btn btn-primary" style="font-size: 15px">Kembali <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
            </svg></a>

            </td>
        </tr>
            
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                <h3 class="text-center">Input Tanggal Rincian<br></h3>

                <form method="POST" action="{{ Route('Tanggalrincian') }}/{{ $sppd->id }}/Entry">
                    @csrf
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Tgl Telah Menerima Uang</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <input type="text" class="form-control justify-content" id="" placeholder="" required name="Tgltelahmenerima" value="">
                        </div>
                    </div>
                    <hr>

<!--                     @if ($tanggalrincian != null)
                    <a class="btn btn-primary btn-md float-left" href="{{ Route('SPPD') }}/{{ $sppd->id }}/SPPD">SELESAI</a>
                    @else
                    @endif -->

                    <button type="submit" class="btn btn-primary btn-md float-right">Input Data <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/></svg></button>

                </form>
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

<!-- <div class="form-group row d-flex align-items-center">
    <label for="Tgl_berangkat" class="col-sm-4 col-form-labe ">Tanggal Penggunaan</label>
    <div class="col-sm-1 text-right">:</div>
    <div class="col-sm-4">
        <input type="date" class="form-control justify-content @error('Tanggal_Berangkat') is-invalid @enderror" id="Tgl_berangkat" placeholder="Tanggal Berangkat.." required name="Tanggal_Berangkat">
    </div>
</div>
<hr>
<div class="form-group row d-flex align-items-center">
    <label for="Tgl_kembali" class="col-sm-4 col-form-label">Tanggal Selesai</label>
    <div class="col-sm-1 text-right">:</div>
    <div class="col-sm-4">
        <input type="date" class="form-control justify-content @error('Tanggal_Kembali') is-invalid @enderror" id="Tgl_kembali" placeholder="Tanggal" required name="Tanggal_Kembali">
        @error('Tanggal_Kembali')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div> -->