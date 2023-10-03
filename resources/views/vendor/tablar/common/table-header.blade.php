<div class="card-body border-bottom py-3">
    <form action="{{ $route }}" method="GET">
        <div class="d-flex">
            <div class="text-muted">
                Show
                <div class="mx-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" name="per_page" value="10" size="3" aria-label="Invoices count">
                </div>
            </div>
            <div class="ms-auto text-muted">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" name="search" aria-label="Search invoice">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
            </div>
        </div>
    </form>
</div>