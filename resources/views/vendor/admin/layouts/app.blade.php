<!DOCTYPE html>
<html>
@section('htmlheader')
@include('admin::layouts.partials.htmlheader')
@show

<body>
    @include('admin::layouts.partials.preloader')
    @include('admin::layouts.partials.mainheader')
    @include('admin::layouts.partials.rightsidebar')
    @include('admin::layouts.partials.leftsidebar')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Title</h4>
                            </div>
                            @include('admin::layouts.partials.breadcrumb')
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    @yield('content')
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template Modified By <a href="https://github.com/taufikhdyt17" target="_blank">Taufik Hidayat</a>
            </div>
        </div>
    </div>
    @section('scripts')
    @include('admin::layouts.partials.scripts')
    @show
</body>

</html>