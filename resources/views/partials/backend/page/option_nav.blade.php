
<div class="options-bar">
    <ul class="nav nav-pills pull-right" id="page-option-tabs" role="tablist">
        <li class="nav-item">
            <a href="#page-content-tab" class="nav-link active" role="tab" data-toggle="pill"><i class="fa fa-file-text-o"></i> Page Content</a>
        </li><!-- /.nav-item -->
        @if(isset($page) && in_array($page->id, config('cms.image_tab_pages')) || isset($page) && in_array($page->parent_id, config('cms.image_tab_pages')) || isset($page) && $page->getGrandparent($page->parent_id))
            <li class="nav-item">
                <a href="#media-tab" class="nav-link" role="tab" data-toggle="pill"><i class="fa fa-camera-retro"></i> Featured Images</a>
            </li><!-- /.nav-item -->
        @endif

        <li class="nav-item">
            <a href="#documents-tab" class="nav-link" role="tab" data-toggle="pill"><i class="fa fa-file-o"></i> Documents</a>
        </li><!-- /.nav-item -->

        <li class="nav-item">
            <a href="#banners-tab" class="nav-link" role="tab" data-toggle="pill"><i class="fa fa-picture-o"></i> Banners</a>
        </li><!-- /.nav-item -->

        <li class="nav-item">
            <a href="#seo-tab" class="nav-link" role="tab" data-toggle="pill"><i class="fa fa-line-chart"></i> SEO</a>
        </li><!-- /.nav-item -->

        @if(auth()->user()->containsRoles('master'))
            <li class="nav-item">
                <a href="#admin-tab" class="nav-link" role="tab" data-toggle="pill"><i class="fa fa-key"></i> Admin</a>
            </li><!-- /.nav-item -->
        @endif
    </ul><!-- /.nav .nav-pills -->
</div><!-- /.options-bar -->
