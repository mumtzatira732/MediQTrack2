<aside class="sidebar sidebar-default navs-rounded-all">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="{{route('admin.dashboard')}}" class="navbar-brand">
            <svg width="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
            </svg>
            <h4 class="logo-title">{{env('APP_NAME')}}</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list" id="sidebar">
        @include('admin.partials.vertical-nav') 
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>