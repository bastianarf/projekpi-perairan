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
                    <h3 class="text-center">Daftar SPPD</h3>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <form class="active-cyan-4 col-5 d-flex mb-1" action="{{ Route('SPPD') }}" method="GET">
                            <input class="form-control col-9" type="text" placeholder="Cari Nomor Surat atau Acara"
                            aria-label="Search" name="search" value="{{ request()->search }}">&nbsp;
                            <button type="submit" class="btn btn-primary col-3"><i class="fa fa-search"></i></button>
                        </form>
                        <a class="btn btn-primary mb-1" style="font-size: 14px" href="{{ Route('EntrySPPD') }}">
                            <i class="fa fa-envelope"></i>&nbsp;
                            Tambah SPPD
                        </a>
                        
                    </div>
                    
                    <table class="table table-striped table-hover" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Acara</th>
                                <th scope="col">Yang diperintah</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $sppd->currentPage()*$sppd->perPage()-4; ?>
                            @foreach ($sppd as $sppd_data)
                            
                            <tr>
                                <th>{{ $no }}</th>
                                <td>{{ $sppd_data->no_surat }}</td>
                                <?php $num_char=50;  ?>
                                <td>{{  Str::limit($sppd_data->acara, 20, '...')  }}</td>
                                <td>
                                    <?php $no1=1; ?>
                                    @foreach ($sppd_data->user as $us)
                                        <div>{{ $no1++ }}. {{ Str::limit($us->nama,20,'...') }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    <!--
                                    <form action="{{ Route('SPPD') }}/{{ $sppd_data->id }}/delete" method="post">
                                        <a href="{{ Route('SPPD') }}/{{ $sppd_data->id }}/SPPD" class="btn btn-primary" style="font-size: 12px">SPPD</a>  
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal{{ $sppd_data->id }}">
                                            Hapus
                                        </button>
                                    -->    
                                        <!-- Modal -->
                                    <!--
                                        <div class="modal fade" id="Modal{{ $sppd_data->id }}" tabindex="-1" role="dialog" aria-labelledby="Hapus{{ $sppd_data->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Hapus{{ $sppd_data->id }}">Anda yakin untuk menghapus ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>ID : {{ $sppd_data->id }} </h6>
                                                        <h6>SPPD&nbsp;&nbsp;&nbsp;&nbsp; : {{ $sppd_data->acara }}</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ Route('SPPD') }}/{{ $sppd_data->id }}/delete" method="post">
                                                            @method('delete')
                                                            @csrf   
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    -->
                                </td>
                            <?php $no++;?>
                            @endforeach 
                        </tbody>
                    </table>
                    {{ $sppd->render() }}
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