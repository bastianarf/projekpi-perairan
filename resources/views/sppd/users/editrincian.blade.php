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
                <h3 class="text-center">Surat Perintah Tugas (SPT) <br> Surat Perintah Perjalanan Dinas (SPPD) <br> Rincian Perjalanan Dinas </h3> 
                <hr>
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                <form method="POST" action="{{ Route('Rincian') }}/{{ $sppd->id }}/{{$rincian->id}}/Edit">
                    @method('patch')
                    @csrf
                    <div class="form-group row d-flex align-items-center">
                        <label for="Perintah" class="col-sm-4 col-form-label">Nama <div class="text-secondary small">( yang diperintah )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" placeholder="Nama yang diperintah" required readonly value="{{ $user->nama }}" name="Nama">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label class="col-sm-4 col-form-label">Nama Kabid<div class="text-secondary small">( yang memberi perintah )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" placeholder="Nama Kabid PSDA" required readonly value="{{ $kabid->nama ?? 'Kabid Tidak Ada' }}" name="NamaKabid">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Biaya" class="col-sm-4 col-form-label">Kegunaan Biaya <div class="text-secondary small">( Kegunaan Biaya )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Maksud" placeholder="Ketikkan Maksud Kegunaan Biaya.." required name="Kegunaan_Biaya"
                            value="{{ $rincian->kegunaan_biaya }}">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Jumlah" class="col-sm-4 col-form-label">Jumlah Per Hari<div class="text-secondary small">( Jumlah Per Hari )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Maksud" placeholder="Ketikkan Jumlah Biaya yang dibutuhkan per Hari.." required name="Jumlah_Per_Hari" value="{{ $rincian->jumlah_per_hari }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_penggunaan" class="col-sm-4 col-form-labe ">Tanggal Penggunaan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content @error('tanggal_penggunaan') is-invalid @enderror" id="Tgl_penggunaan" placeholder="Tanggal Penggunaan.." required name="Tanggal_Penggunaan" value="{{ $rincian->tanggal_penggunaan }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="Tgl_selesai" class="col-sm-4 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control justify-content @error('tanggal_selesai') is-invalid @enderror" id="Tgl_kembali" placeholder="Tanggal" required name="Tanggal_Selesai" value="{{ $rincian->tanggal_selesai }}">
                            @error('tanggal_selesai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>    
                    </div>

                    <div class="form-group row d-flex align-items-center">
                        <label for="Keterangan" class="col-sm-4 col-form-label">Keterangan <div class="text-secondary small">( Keterangan )</div></label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control justify-content" id="Keterangan" placeholder="Ketikkan Keterangan Tambahan Penggunaan Biaya .." required name="Keterangan" value="{{ $rincian->keterangan }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning btn-md float-right">UPDATE DATA</button>
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