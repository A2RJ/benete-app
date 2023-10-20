<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <div class="text-center mb-1">
                <img src="{{ asset('Indonesian_Sea_and_Coast_Guard_Emblem.svg') }}" height="36" alt="">
                <img src="{{ asset('logo-syahbandar.png') }}" height="36" alt="">
            </div>
        </h1>
        <div class="navbar-nav flex-row order-md-last">

            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    @include('tablar::partials.header.header-button')
                </div>
            </div>

            <div class="d-none d-md-flex">

                @include('tablar::partials.header.theme-mode')

                @include('tablar::partials.header.notifications')

            </div>
            @include('tablar::partials.header.top-right')
        </div>
    </div>
</header>