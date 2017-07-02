<button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#collapsing-side-nav">
    <span class="text-muted"><i class="fa fa-align-justify"></i> Side Menu</span>
</button>

<div class="collapse show navbar-toggleable-sm" id="collapsing-side-nav">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.dashboard.index'], ' active') }}"><i class="fa fa-tachometer"></i> Dashboard</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pages.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.pages.index', 'admin.pages.create', 'admin.pages.add', 'admin.pages.edit', 'admin.pages.show'], ' active') }}"><i class="fa fa-files-o"></i> Pages</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.media.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.media.index', 'admin.media.documents', 'admin.media.images', 'admin.media.all', 'admin.presets.index', 'admin.presets.create', 'admin.presets.show', 'admin.presets.edit', 'admin.media.search'], ' active') }}"><i class="fa fa-camera-retro"></i> Media</a>
        </li>
    </ul><!-- /.nav .nav-pills -->

    <hr>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.settings.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.settings.index', 'admin.settings.edit', 'admin.settings.create', 'admin.settings.advanced.index'], ' active') }}"><i class="fa fa-cog"></i> Settings</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.users.index', 'admin.users.create', 'admin.users.show', 'admin.users.edit'], ' active') }}"><i class="fa fa-users"></i> Users</a>
        </li>

        {{--<li class="nav-item">--}}
            {{--<a href="{{ route('admin.company.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.company.index', 'admin.company.edit', 'admin.company.create'], ' active') }}"><i class="fa fa-building"></i> Company Details</a>--}}
        {{--</li>--}}

        <hr>

        {{--<li class="nav-item">--}}
            {{--<a href="#" class="nav-link"><i class="fa fa-info-circle"></i> Help Guide</a>--}}
        {{--</li>--}}

        <li class="nav-item">
            <a href="{{ route('index') }}" target="_blank" class="nav-link"><i class="fa fa-eye"></i> View Website</a>
        </li>

        <hr>

        <li class="nav-item">
            <a href="{{ route('admin.auth.logout') }}" data-confirm="" data-message="This will log you out and redirect you to the login page." data-button-text="Yes, logout!" class="nav-link btn btn-outline-secondary"><i class="fa fa-sign-out"></i>Log out</a>
        </li>
    </ul><!-- /.nav .nav-pills -->
</div>