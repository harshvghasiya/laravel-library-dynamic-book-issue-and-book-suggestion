const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    'public/admin/global/plugins/jquery.min.js',
    'public/admin/global/plugins/jquery-migrate.min.js',
    'public/admin/global/plugins/jquery-ui/jquery-ui.min.js',
    'public/admin/global/plugins/bootstrap/js/bootstrap.min.js',
    'public/admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
    'public/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
    'public/admin/global/plugins/jquery.blockui.min.js',
    'public/admin/global/plugins/jquery.cokie.min.js',
    'public/admin/global/plugins/uniform/jquery.uniform.min.js',
    'public/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    'public/admin/global/scripts/metronic.js',
    'public/admin/admin/layout4/scripts/layout.js',
    'public/admin/js/jquery.validate.js',
    'public/admin/js/toaster/toastr.min.js',
    'public/admin/js/jquery.bootstrap-growl.min.js',
    'public/admin/admin/layout4/datatables/media/js/jquery.dataTables.min.js',
    'public/admin/responsive/dataTables.responsive.min.js',
    'public/admin/sweetalert/sweetalert.min.js',
], 'public/admin/mix/js/all.js');

mix.styles([
    'public/admin/global/plugins/font-awesome/css/font-awesome.min.css',
    'public/admin/global/plugins/simple-line-icons/simple-line-icons.min.css',
    'public/admin/global/plugins/bootstrap/css/bootstrap.min.css',
    'public/admin/global/plugins/uniform/css/uniform.default.css',
    'public/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
    'public/admin/admin/pages/css/tasks.css',
    'public/admin/global/css/components-rounded.css',
    'public/admin/global/css/plugins.css',
    'public/admin/admin/layout4/css/layout.css',
    'public/admin/admin/layout4/css/themes/light.css',
    'public/admin/admin/layout4/css/custom.css',
    'public/admin/admin/layout4/datatables/media/css/jquery.dataTables.min.css',
    'public/admin/responsive/responsive.dataTables.min.css',
    'public/admin/js/toaster/toastr.css',
], 'public/admin/mix/css/all.css');

mix.scripts([
    'public/front/js/bootstrap/popper.min.js',
    'public/front/js/bootstrap/bootstrap.min.js',
    'public/front/js/plugins/plugins.js',
    'public/front/js/active.js',
    'public/front/validation/jquery.validate.js',
    'public/front/validation/additional-methods.js',
    'public/admin/js/jquery.bootstrap-growl.min.js',
], 'public/front/mix/js/all.js');
