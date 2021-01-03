<?php
function selisih($awal, $akhir)
{
    $awal = date_create($awal);
    $akhir = date_create($akhir);
    $diff  = date_diff( $awal, $akhir );
    $angka = $diff->d+1;
    return $angka;
    //return $angka." "."( ".Rincian::penyebut($angka)." )";
}
function rupiah ($angka)
{
    $hasil_rupiah = "Rp " .number_format($angka,0,',','.');
    return $hasil_rupiah;
}
?>
@extends('layouts.app')
@section('title',  request()->path() )
@section('content')
<div class="container-fluid" style="font-size: 20px">
    {{-- Breadcrump --}}
    @include('layouts.breadcrump')
    <div class="row row-cols-10 shadow rounded-lg p-3 justify-content-center m-0" style="background-color: rgb(0, 183, 255)">
        @if ($user->role_check(['Admin','Staff','Kepala Bidang', 'Kepala Seksi']))
        <div class="col-3">
            {{-- Navigasi Menu --}}
            @include('layouts.nav')
        </div>
        <div class="col-9">

<!-- button kembali -->
        <tr>
            <td width="135px">
            <a href="{{ Route('SPPD') }}/{{ $sppd->id }}/SPPD"class="btn btn-primary" style="font-size: 15px">Kembali <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
            </svg></a>

            </td>
        </tr>

            
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

                <div class="tab-pane fade table-responsive active show" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                    <h3 class="text-center">Laporan Perjalanan Dinas</h3>
                    <hr>
                    <table class="table table-striped table-hover " style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">Petunjuk/Arahan/Hasil</th>
                                <th scope="col">Masalah/Temuan</th>
                                <th scope="col">Saran/Tindakan</th>
                                <th scope="col">&nbsp;Lain-lain&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th scope="col">&nbsp;Tanggal/Cetak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $laporan->currentPage()*$laporan->perPage()-4; ?>
                            @foreach ($laporan as $laporan_data)

                            <tr>
                                <td>{{ $laporan_data->petunjuk }}</td>
                                <?php $num_char=50;  ?>
                                <td>{{ $laporan_data->masalah }}</td>
                                <td>{{ $laporan_data->saran }}</td>
                                <td>{{  $laporan_data->lain_lain }}</td>
                                <td>{{  $laporan_data->tglcetak }}</td>
                                <td width="135px">
                                    <form action="{{ Route('Laporan') }}/{{ $laporan_data->id }}/Delete" method="post">
                                        <a href="{{ Route('Laporan') }}/{{ $sppd->id }}/{{ $laporan_data->id }}/Edit"class="btn btn-info" style="font-size: 12px">Edit</a>
                                        @method('delete')
                                        @csrf
                                        
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $laporan_data->id }}" @if ($laporan_data->id == 0) hidden @endif>
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $laporan_data->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $laporan_data->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $laporan_data->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Petunjuk : {{ $laporan_data->petunjuk }} </h6>
                                                        <h6>Masalah  : {{ $laporan_data->masalah }} </h6>
                                                        <h6>Saran &nbsp;&nbsp;&nbsp;&nbsp;: {{ $laporan_data->saran }} </h6>
                                                        <h6>Lain-lain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $laporan_data->lain_lain }}</h6>
                                                        <h6>Tanggal Cetak : {{ $laporan_data->tglcetak }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Laporan') }}/{{ $laporan_data->id }}/Delete" method="post">
                                                            @method('delete')
                                                            @csrf 
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>  
                            <?php $no++;?>
                            @endforeach 
                        </tbody>
                    </table>
                    {{ $laporan->render() }}
                @else
                @include('layouts.akses')
                @endif
            </div>
        </div>

<!-- Mengatur jarak button dan form -->
 <p></p>   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <tbody>
        <tr>
            <td width="135px">

            <a href="{{ Route('CetakLAPORAN') }}/{{ $sppd->id }}" target="_blank" class="btn btn-warning" style="font-size: 14px">Cetak Laporan <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5z"/><path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/><path fill-rule="evenodd" d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/></svg></a>
            </td>
        </tr>
    </tbody>

        @endsection
        
        @section('script-down')
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        @endsection

                