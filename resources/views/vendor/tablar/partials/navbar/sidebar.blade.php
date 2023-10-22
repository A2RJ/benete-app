<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg" style="background-color: #38348b; color: white !important;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <div class="text-center mb-1">
                <!-- <img src="{{ asset('Indonesian_Sea_and_Coast_Guard_Emblem.svg') }}" class="logo" alt=""> -->
                <img src="{{ asset('logo-syahbandar.png') }}" class="logo" alt="">
            </div>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item d-none d-lg-flex me-3">
                <div class="btn-list">
                    @include('tablar::partials.header.header-button')
                </div>
            </div>
            <div class="d-none d-lg-flex">
                @include('tablar::partials.header.theme-mode')
            </div>
            @include('tablar::partials.header.top-right')
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <h3 style="margin-left: 17px;">{{ str()->upper(count(auth()->user()->roles) ? auth()->user()->roles[0]->display_name : '' )}}</h3>
            <ul class="navbar-nav">
                @each('tablar::partials.navbar.dropdown-item',$tablar->menu('sidebar'), 'item')
            </ul>
        </div>
    </div>
</aside>

@include('tablar::partials.header.sidebar-top')