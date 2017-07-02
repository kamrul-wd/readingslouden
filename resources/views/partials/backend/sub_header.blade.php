<div class="sub-header">
    <nav>
        <div class="container-fluid">
            <div class="row">
                <div class="hidden-sm-down col-md-4 col-lg-2 p-3" style="background: #790b73;">
                    <a href="{{ route('admin.users.edit', auth()->id()) }}" class="btn btn-link link-white">
                        <i class="fa fa-user"></i> {{ auth()->user()->name }}
                    </a><!-- /.btn .btn-link -->
                </div><!-- /.col -->

                @if (isset($option_nav))
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 p-3">
                        @include('partials.backend.page.option_nav')
                    </div><!-- /.col -->
                @endif

                @if (isset($settings_nav))
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 p-3">
                        @include('partials.backend.settings.option_nav')
                    </div><!-- /.col -->
                @endif

                @if (isset($controls_nav))
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 p-3">
                        <div class="options-bar">
                            <ul class="nav nav-pills pull-right">
                                <li class="nav-item">
                                    @if (Route::currentRouteName() == 'admin.pages.show')
                                        <a href="{{ route('admin.pages.add', Route::Input('pages')) }}" class="nav-link"><i class="fa fa-plus"></i> Add Page</a>
                                    @elseif (Route::currentRouteName() == 'admin.presets.index')
                                        <a href="{{ route('admin.presets.create') }}" class="nav-link"><i class="fa fa-plus"></i> Add Preset</a>
                                    @elseif (Route::currentRouteName() == 'admin.users.index')
                                        <a href="{{ route('admin.users.create') }}" class="nav-link"><i class="fa fa-plus"></i> Add User</a>
                                    @elseif (Route::currentRouteName() == 'admin.company.index')
                                        <a href="{{ route('admin.company.create') }}" class="nav-link"><i class="fa fa-plus"></i> Add Company</a>
                                    @else
                                        <a href="{{ route('admin.pages.create') }}" class="nav-link"><i class="fa fa-plus"></i> Add Page</a>
                                    @endif
                                </li><!-- /.nav-item -->
                            </ul><!-- /.nav .nav-pills -->
                        </div><!-- /.options-bar -->

                    </div><!-- /.col -->
                @endif
            </div><!-- /.row -->
        </div><!-- /.container -->
    </nav><!-- /.navbar -->
</div><!-- /.sub-header -->
