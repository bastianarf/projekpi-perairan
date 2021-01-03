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
            {{-- Tombol Petunjuk --}}
            @include('layouts.help')
            {{-- Bagian Isi --}}
            <div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent">
                @if (session()->get('Failed'))
                <div class="alert alert-danger">
                    {{ session()->get('Failed') }}
                </div>
                @endif
                <h3 class="text-center">LAPORAN PERJALANAN DINAS<br></h3>
                <hr>
                @if (session()->get('Success'))
                <div class="alert alert-success">
                    {{ session()->get('Success') }}
                </div>
                @endif
                <form method="POST" action="{{ Route('Laporan') }}/{{ $sppd->id }}/{{$laporan->id}}/Edit">
                    @method('patch')
                    @csrf
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Petunjuk / Arahan yang diberikan / Hasil</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <textarea class="form-control justify-content" id="" placeholder="" required name="Petunjuk"><?php echo $laporan['petunjuk'] ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Masalah / Temuan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <input type="text" class="form-control justify-content" id="" placeholder="" required name="Masalah" value="{{ $laporan->masalah }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Saran Tindakan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <input type="text" class="form-control justify-content" id="" placeholder="" required name="Saran" value="{{ $laporan->saran }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Lain - Lain</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <input type="text" class="form-control justify-content" id="" placeholder="" name="Lain" value="{{ $laporan->lain_lain }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row d-flex align-items-center">
                        <label for="" class="col-sm-4 col-form-label">Tanggal Cetak Laporan</label>
                        <div class="col-sm-1 text-right">:</div>
                        <div class=" d-flex col-7 justify-content-center">
                            <input type="text" class="form-control justify-content" id="" placeholder="" required name="Tglcetak" value="{{ $laporan->tglcetak }}">
                        </div>
                    </div>
                    <hr>
                    @if ($laporan != null)
                    <a class="btn btn-primary btn-md float-left" href="{{ Route('Laporan') }}/{{ $sppd->id }}">Selesai</a>
                    @else
                    @endif

                    <button type="submit" class="btn btn-warning btn-md float-right">Update Data</button>

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