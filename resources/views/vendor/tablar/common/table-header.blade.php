<div class="card-body border-bottom py-3">
    <form action="{{ $route }}" method="GET">
        <div class="d-flex">
            <div class="ms-auto text-muted">
                <div class="ms-2 d-inline-block">
                    <div class="form-inline">
                        <div class="row">
                            <div class="col-lg-1 col-md-12 mb-2">
                                <input type="text" class="form-control form-control-sm" name="per_page" value="{{ request('per_page', '10') }}" aria-label="Invoices count">
                            </div>
                            <div class="col-lg-2 col-md-12 mb-2">
                                <input type="date" class="form-control form-control-sm" name="start_date" value="{{ request('start_date') }}" aria-label="Start">
                            </div>
                            <div class="col-lg-2 col-md-12 mb-2">
                                <input type="date" class="form-control form-control-sm" name="end_date" value="{{ request('end_date') }}" aria-label="End">
                            </div>
                            <div class="col-lg-3 col-md-12 mb-2">
                                <input type="text" class="form-control form-control-sm" name="search" value="{{ request('search') }}" aria-label="Search">
                            </div>
                            <div class="col-lg-2 col-md-12 mb-2">
                                <button type="submit" class="btn btn-primary btn-sm w-100">Search</button>
                            </div>
                            @if (isset($export))
                            <div class="col-lg-2 col-md-12 mb-2">
                                <a href="{{ $export }}" target="_blank" class="btn btn-primary btn-sm w-100">Export</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>