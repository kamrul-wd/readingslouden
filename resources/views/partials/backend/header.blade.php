<header class="main-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                <a href="{{ route('admin.dashboard.index') }}">
                    <img src="{{ asset('assets/img/backend/logo@x2.png') }}" height="70" alt="Pingala Logo">
                </a>
            </div><!-- /.col -->

            @include('partials.backend.search')
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</header><!-- /.main-header -->
