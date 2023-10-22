<div class="nav-item dropdown" style="background-color: white; padding-left: 15px; padding-right: 15px; border-radius: 5px;">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" style="color: black !important;">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
        </svg>
        <div class="d-none d-xl-block ps-2">
            <div>{{Auth()->user()->name}}</div>
            <div class="mt-1 small text-muted">{{ count(auth()->user()->roles) ? auth()->user()->roles[0]->display_name : '' }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

        @php( $logout_url = View::getSection('logout_url') ?? config('tablar.logout_url', 'logout') )
        @php( $profile_url = View::getSection('profile_url') ?? config('tablar.profile_url', 'logout') )
        @php( $setting_url = View::getSection('setting_url') ?? config('tablar.setting_url', 'home') )

        @if (config('tablar.use_route_url', true))
        @php( $profile_url = $profile_url ? route($profile_url) : '' )
        @php( $logout_url = $logout_url ? route($logout_url) : '' )
        @php( $setting_url = $setting_url ? route($setting_url) : '' )
        @else
        @php( $profile_url = $profile_url ? url($profile_url) : '' )
        @php( $logout_url = $logout_url ? url($logout_url) : '' )
        @php( $setting_url = $setting_url ? url($setting_url) : '' )
        @endif

        <a href="{{$profile_url}}" class="dropdown-item">Profile</a>
        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-power-off text-red"></i>
            {{ __('tablar::tablar.log_out') }}
        </a>

        <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
            @if(config('tablar.logout_method'))
            {{ method_field(config('tablar.logout_method')) }}
            @endif
            {{ csrf_field() }}
        </form>

    </div>
</div>