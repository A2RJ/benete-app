@extends('tablar::page')

@section('title')
Kesya Disposisi
@endsection

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    List
                </div>
                <h2 class="page-title">
                    {{ __('Kesya Disposisi ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('kesya-disposisi.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create Kesya Disposisi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        @if(config('tablar','display_alert'))
        @include('tablar::common.alert')
        @endif
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kesya Disposisi</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-muted">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value="10" size="3" aria-label="Invoices count">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-muted">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive min-vh-100">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="6 15 12 9 18 15" />
                                        </svg>
                                    </th>

                                    <th>Kesya Surat Masuk Id</th>
                                    <th>Tanggal Disposisi</th>
                                    <th>Batas Waktu Tindaklanjuti</th>
                                    <th>Jenis Disposisi</th>
                                    <th>Status Disposisi</th>
                                    <th>Komentar</th>

                                    <th class="w-1"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($kesyaDisposisis as $kesyaDisposisi)
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select kesyaDisposisi"></td>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $kesyaDisposisi->kesya_surat_masuk_id }}</td>
                                    <td>{{ $kesyaDisposisi->tanggal_disposisi }}</td>
                                    <td>{{ $kesyaDisposisi->batas_waktu_tindaklanjuti }}</td>
                                    <td>{{ $kesyaDisposisi->jenis_disposisi }}</td>
                                    <td>{{ $kesyaDisposisi->status_disposisi }}</td>
                                    <td>{{ $kesyaDisposisi->komentar }}</td>

                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('kesya-disposisi.show',$kesyaDisposisi->id) }}">
                                                        View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('kesya-disposisi.edit',$kesyaDisposisi->id) }}">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('kesya-disposisi.destroy',$kesyaDisposisi->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="if(!confirm('Do you Want to Proceed?')){return false;}" class="dropdown-item text-red"><i class="fa fa-fw fa-trash"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td>No Data Found</td>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        {!! $kesyaDisposisis->links('tablar::pagination') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection