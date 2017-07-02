<?php

// Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin.dashboard.index'));
});



// Dashboard > Pages
Breadcrumbs::register('admin.pages.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Pages', route('admin.pages.index'));
});

// Dashboard > Pages > Create Page
Breadcrumbs::register('admin.pages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push('Create Page', route('admin.pages.create'));
});

// Dashboard > Pages > [Page] > Add Page
Breadcrumbs::register('admin.pages.add', function ($breadcrumbs, $id) {
    $page = App\Models\Page::find($id);

    $breadcrumbs->parent('admin.pages.show', $page->id);
    $breadcrumbs->push('Add Sub Page', route('admin.pages.add'));
});

// Dashboard > Pages > [Page Heading]
Breadcrumbs::register('admin.pages.show', function ($breadcrumbs, $id) {
    $page = App\Models\Page::find($id);

    $breadcrumbs->parent('admin.pages.index');

    foreach ($page->getAncestors() as $ancestors) {
        $breadcrumbs->push($ancestors->heading, route('admin.pages.show', $ancestors->id));
    }

    $breadcrumbs->push($page->heading, route('admin.pages.show', $id));
});

// Dashboard > Pages > [Page Heading] > Edit Page
Breadcrumbs::register('admin.pages.edit', function ($breadcrumbs, $id) {
    $page = App\Models\Page::find($id);

    $breadcrumbs->parent('admin.pages.show', $page->id);
    $breadcrumbs->push('Edit Page', route('admin.pages.edit', $page->id));
});



// Dashboard > Media > Presets
Breadcrumbs::register('admin.presets.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.media.index');
    $breadcrumbs->push('Presets', route('admin.presets.index'));
});

// Dashboard > Media > Presets > Create Preset
Breadcrumbs::register('admin.presets.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.presets.index');
    $breadcrumbs->push('Create Preset', route('admin.presets.create'));
});

// Dashboard > Media > Presets > [Preset Name]
Breadcrumbs::register('admin.presets.show', function ($breadcrumbs, $id) {
    $preset = App\Models\MediaPreset::find($id);

    $breadcrumbs->parent('admin.presets.index');

    $breadcrumbs->push($preset->name, route('admin.presets.show', $id));
});

// Dashboard > Media > Presets > [Preset Name] > Edit Preset
Breadcrumbs::register('admin.presets.edit', function ($breadcrumbs, $id) {
    $preset = App\Models\MediaPreset::find($id);

    $breadcrumbs->parent('admin.presets.show', $preset->id);
    $breadcrumbs->push('Edit Preset', route('admin.presets.edit', $preset->id));
});



// Dashboard > Media
Breadcrumbs::register('admin.media.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Media', route('admin.media.index'));
});

// Dashboard > Media > Images
Breadcrumbs::register('admin.media.images', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.media.index');
    $breadcrumbs->push('Images', route('admin.media.images'));
});

// Dashboard > Media > Documents
Breadcrumbs::register('admin.media.documents', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.media.index');
    $breadcrumbs->push('Documents', route('admin.media.documents'));
});

// Dashboard > Media > All
Breadcrumbs::register('admin.media.all', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.media.index');
    $breadcrumbs->push('Show All', route('admin.media.all'));
});

// Dashboard > Media > Search
Breadcrumbs::register('admin.media.search', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.media.index');
    $breadcrumbs->push('Search', route('admin.media.search'));
});



// Dashboard > Settings
Breadcrumbs::register('admin.settings.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Settings', route('admin.settings.index'));
});

// Dashboard > Settings > Create
Breadcrumbs::register('admin.settings.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.settings.index');
    $breadcrumbs->push('Create', route('admin.settings.create'));
});

// Dashboard > Settings > [Setting Name] > Edit
Breadcrumbs::register('admin.settings.edit', function ($breadcrumbs, $id) {
    $setting = App\Models\Setting::find($id);

    $breadcrumbs->parent('admin.settings.index');
    $breadcrumbs->push('Edit: '.$setting->label, route('admin.settings.edit', $setting->id));
});

// Dashboard > Settings > Advanced
Breadcrumbs::register('admin.settings.advanced.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.settings.index');
    $breadcrumbs->push('Advanced', route('admin.settings.advanced.index'));
});



// Dashboard > Users
Breadcrumbs::register('admin.users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Users', route('admin.users.index'));
});

// Dashboard > Users > Create
Breadcrumbs::register('admin.users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.users.index');
    $breadcrumbs->push('Create', route('admin.users.create'));
});

// Dashboard > Users > [User's Name] > Edit
Breadcrumbs::register('admin.users.edit', function ($breadcrumbs, $id) {
    $user = App\Models\User::find($id);

    $breadcrumbs->parent('admin.users.index');
    $breadcrumbs->push('Edit: '.$user->name, route('admin.users.edit', $user->id));
});



// Dashboard > Companies
Breadcrumbs::register('admin.company.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Company', route('admin.company.index'));
});

// Dashboard > Companies > Create
Breadcrumbs::register('admin.company.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.company.index');
    $breadcrumbs->push('Create', route('admin.company.create'));
});

// Dashboard > Companies > [Company Name] > Edit
Breadcrumbs::register('admin.company.edit', function ($breadcrumbs, $id) {
    $company = App\Models\CompanyDetail::find($id);

    $breadcrumbs->parent('admin.company.index');
    $breadcrumbs->push('Edit: '.$company->name, route('admin.company.edit', $company->id));
});
