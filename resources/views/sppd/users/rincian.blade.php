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
        @if ($user->role_check(['Admin','Staff','Kepala Bidang', 'Kepala Seksi', 'Sekretaris Bidang']))
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

                <div class="tab-pane fade table-responsive active show" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                    <h3 class="text-center">Daftar Rincian Perjalanan Dinas</h3>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <form class="active-cyan-4 col-5 d-flex mb-1" action="{{ Route('Rincian') }}" method="GET">
                            <input class="form-control col-9" type="text" placeholder="Cari Nomor Surat atau Acara"
                            aria-label="Search" name="search" value="{{ request()->search }}">&nbsp;
                            <button type="submit" class="btn btn-primary col-3"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <table class="table table-striped table-hover" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kegunaan Biaya</th>
                                <th scope="col">Jumlah Per Hari</th>
                                <th scope="col">Waktu Penggunaan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $rincian->currentPage()*$rincian->perPage()-4; ?>
                            @foreach ($rincian as $rincian_data)
                            <?php $tanggal_penggunaan = date('d-m-Y',strtotime($rincian_data->tanggal_penggunaan));
                            $tanggal_selesai = date('d-m-Y',strtotime($rincian_data->tanggal_selesai)); ?>
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{{ $rincian_data->kegunaan_biaya }}</td>
                                <?php $num_char=50;  ?>
                                <td>{{ rupiah($rincian_data->jumlah_per_hari) }}</td>
                                <td>{{ selisih($tanggal_penggunaan,$tanggal_selesai).' hari' }}</td>
                                <td>{{  $rincian_data->keterangan }} </td>  
                                <td width="260px">
                                    <form action="{{ Route('Rincian') }}/{{ $rincian_data->id }}/delete" method="post">
                                        <a href="{{ Route('Rincian') }}/{{ $sppd->id }}/Entry"class="btn btn-primary" style="font-size: 12px">Tambah</a>
                                        <a href="{{ Route('Rincian') }}/{{ $sppd->id }}/{{ $rincian_data->id }}/Edit"class="btn btn-info" style="font-size: 12px">Edit</a>
                                        @method('delete')
                                        @csrf
                                        
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $rincian_data->id }}" @if ($rincian_data->id == 0) hidden @endif>
                                            Hapus
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{ $rincian_data->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $rincian_data->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $rincian_data->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Rincian Biaya : {{ $rincian_data->kegunaan_biaya }} </h6>
                                                        <h6>Keterangan&nbsp;&nbsp;&nbsp; : {{ $rincian_data->keterangan }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('Rincian') }}/{{ $rincian_data->id }}/delete" method="post">
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
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    @if(!empty($tgl_surat))
                                    <div>
                                        <a href="{{ Route('SPPD') }}/{{ $sppd->id }}/SPPD" class="btn btn-primary mb-3">
                                            <i class="fa fa-arrow-circle-left"> </i>
                                            &nbsp;&nbsp;Kembali SPPD
                                        </a>
                                    </div>
                                    @else
                                    <div>
                                        <a href="{{ Route('Rincian') }}/{{ $sppd->id }}/tglentry" class="btn btn-primary mb-3">
                                            <i class="fa fa-arrow-circle-left"> </i>
                                            &nbsp;&nbsp;Tulis Tanggal Surat
                                        </a>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($rincianl2))
                                    <div>
                                        <a href="{{ Route('Rincian') }}/{{ $sppd->id }}/L2/Entry" class="btn btn-warning mb-2">
                                            <i class="fa fa-arrow-circle-right"> </i>
                                            &nbsp;&nbsp;Buat Rincian L2
                                        </a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    {{ $rincian->render() }}
                @else
                @include('layouts.akses')
                @endif
            </div>
        </div>
        @endsection
        
        @section('script-down')
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        @endsection

                