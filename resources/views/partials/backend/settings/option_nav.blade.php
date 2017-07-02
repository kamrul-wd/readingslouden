<div class="options-bar">
    <ul class="nav nav-pills pull-right" id="settings-option-tabs">
        <li class="nav-item">
            <a href="{{ route('admin.settings.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.settings.index', 'admin.settings.create', 'admin.settings.edit'], ' active') }}"><i class="fa fa-puzzle-piece"></i> General</a>
        </li><!-- /.nav-item -->

        <li class="nav-item">
            <a href="{{ route('admin.settings.advanced.index') }}" class="nav-link{{ Menu::areActiveRoutes(['admin.settings.advanced.index'], ' active') }}"><i class="fa fa-rocket"></i> Advanced</a>
        </li><!-- /.nav-item -->
    </ul><!-- /.nav .nav-pills -->
</div><!-- /.options-bar -->
