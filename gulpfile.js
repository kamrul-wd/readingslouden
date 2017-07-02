// Comment this out if you wish to have notifications.
//process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

// Disable for production?
elixir.config.sourcemaps = false;
process.env.DISABLE_NOTIFIER = true;

elixir(function(mix) {
    mix
    // .browserSync({
    //     proxy: 'nice.dev',
    // })

        .sass([
            'backend/backend.scss',
        ], 'public/assets/css/backend/pingala.css')
        .sass([
            'frontend/app.scss',
        ], 'public/assets/css/frontend/app.css')
        .scripts([
            'libs/jquery/dist/jquery.min.js',
            'libs/jquery-ui/jquery-ui.min.js',
            'libs/tether/dist/js/tether.min.js',
            'libs/bootstrap/dist/js/bootstrap.min.js',
            'libs/sweetalert/dist/sweetalert.min.js',
            'libs/jquery-backstretch/jquery.backstretch.min.js',
            'libs/dropzone/dist/min/dropzone.min.js',
            'libs/image-picker/image-picker/image-picker.js',
            'libs/imagesloaded/imagesloaded.pkgd.min.js',
            'libs/masonry/dist/masonry.pkgd.min.js',
            'libs/cropper/dist/cropper.min.js',
            'libs/jquery-slugify/dist/slugify.min.js',
            'libs/speakingurl/speakingurl.min.js', // dep for slugify
            'libs/max-char-limit-warning/jquery.maxcharwarning.min.js',
            // 'js/backend/plugins/grid-editor.js',
            'js/backend/alerts.js',
            'js/backend/sortable/images.js',
            'js/backend/sortable/documents.js',
            'js/backend/sortable/banners.js',
            'js/backend/loaders.js',
            // 'js/backend/plugins/custom_function_gd.js',
            // 'js/backend/plugins/video_upload.js',
            'js/backend/plugins/custom_parallax_image.js',
        ], 'public/assets/js/backend/all.js', 'resources/assets')
        .scripts([
            'libs/jquery/dist/jquery.min.js',
            'libs/jquery-ui/jquery-ui.min.js',
            // 'libs/slick-carousel/slick/slick.min.js',
            'libs/tether/dist/js/tether.js',
            'libs/bootstrap/dist/js/bootstrap.js',
            'js/frontend/loaders.js',
            // 'js/frontend/owl.carousel.min.js',
            'js/frontend/app.js',
            'js/frontend/main.js'
        ], 'public/assets/js/frontend/all.js', 'resources/assets')
        .copy('resources/assets/libs/font-awesome/fonts', 'public/assets/fonts')
        .copy('resources/assets/fonts', 'public/assets/fonts')
        .copy('resources/assets/libs/tinymce', 'public/assets/libs/tinymce')
        .version([
            'assets/css/backend/pingala.css',
            'assets/css/frontend/app.css',
            'assets/js/backend/all.js',
            'assets/js/frontend/all.js',
        ])
    ;
});
