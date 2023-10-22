@extends('tablar::page')

@section('title', 'Detail Surat Masuk')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Detail
                </div>
                <h2 class="page-title">
                    {{ __('Surat Masuk ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('bmn-surat-masuk.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 14l-4 -4l4 -4"></path>
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Surat Masuk Detail</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nama:</strong>
                            {{ $bmnSuratMasuk->nama }}
                        </div>
                        <div class="form-group">
                            <strong>Tanggal Masuk:</strong>
                            {{ $bmnSuratMasuk->tanggal_masuk }}
                        </div>
                        <div class="form-group">
                            <strong>Asal:</strong>
                            {{ $bmnSuratMasuk->asal }}
                        </div>
                        <div class="form-group">
                            <strong>Perihal:</strong>
                            {{ $bmnSuratMasuk->perihal }}
                        </div>
                        <div class="form-group">
                            <strong>Lampiran:</strong>
                            {!! $bmnSuratMasuk->lampiran !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection