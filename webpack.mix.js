let mix = require('laravel-mix');

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


//拷贝AdminLTE相关的文件和插件
mix.copy('resources/assets/plugins/AdminLTE/dist', 'public/assets/adminlte');
mix.copy('resources/assets/plugins/AdminLTE/plugins', 'public/assets/adminlte/plugins');

mix.copy('resources/assets/plugins/jstree/dist', 'public/assets/jstree');

//拷贝看图插件
mix.copy('resources/assets/plugins/fancybox', 'public/assets/fancybox');

//拷贝layer插件
mix.copy('resources/assets/plugins/layer', 'public/assets/layer');

//拷贝magnific popup插件
mix.copy('resources/assets/plugins/magnific_popup', 'public/assets/magnific_popup');

// 拷贝kindediter插件
mix.copy('resources/assets/plugins/kindediter', 'public/assets/kindediter');
// 拷贝selectize.js插件
mix.copy('resources/assets/plugins/selectize.js/dist', 'public/assets/selectize');
//copy jquery.media.js
mix.copy('resources/assets/js/jquery.media.js', 'public/assets/js/jquery.media.js');

//拷贝Ionicons到public目录
mix.copy('resources/assets/plugins/Ionicons/css', 'public/assets/Ionicons/css');
mix.copy('resources/assets/plugins/Ionicons/fonts', 'public/assets/Ionicons/fonts');

mix.copy('resources/assets/plugins/color-picker/', 'public/assets/color-picker/');
//拷贝font-awesome-4.7.0到public目录
mix.copy('resources/assets/plugins/font-awesome-4.7.0/css', 'public/assets/font-awesome/css');
mix.copy('resources/assets/plugins/font-awesome-4.7.0/fonts', 'public/assets/font-awesome/fonts');
//ie-js
mix.copy('resources/assets/plugins/ie-js', 'public/assets/ie-js');

//拷贝图片
mix.copy('resources/assets/img', 'public/assets/img');

mix.copy('resources/assets/plugins/jquery_form/jquery.form.js', 'public/assets/js/jquery.form.js');
//拷贝AdminLTE字体
mix.copy('resources/assets/plugins/AdminLTE/bootstrap/fonts', 'public/assets/fonts');

//拷贝bootstrap到css目录
mix.copy('resources/assets/plugins/AdminLTE/bootstrap/css/bootstrap.min.css', 'public/assets/css/bootstrap.min.css');

//拷贝mloding
mix.copy('resources/assets/plugins/mloading/jquery.mloading.css', 'public/assets/css/jquery.mloading.css').version();

//拷贝imagezoom
mix.copy('resources/assets/plugins/imagezoom/jquery.imagezoom.min.js', 'public/assets/imagezoom/jquery.imagezoom.min.js');
//jstree
mix.copy('resources/assets/plugins/jstree/dist', 'public/assets/jsTree');

//将所有的less转css
mix.less("resources/assets/less/app.less",
    'public/assets/css/application.min.css').version();

//活动样式
mix.styles(['resources/assets/css/event.css'],'public/assets/css/event.min.css');

//合并所有css
mix.styles([
    'resources/assets/plugins/toastr/toastr.min.css',
    'resources/assets/plugins/sweetalert/dist/sweetalert.css',
    'resources/assets/css/style.css',
    'resources/assets/plugins/magnific_popup/magnific-popup.css',
    'resources/assets/plugins/magnific_popup/webuploader.css'
], 'public/assets/css/style.min.css').version();

//合并所有js
mix.scripts([
    'resources/assets/plugins/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js',
    'resources/assets/plugins/AdminLTE/bootstrap/js/bootstrap.min.js',
    'resources/assets/plugins/cookie/jquery.cookie.min.js',
    'resources/assets/plugins/toastr/toastr.min.js',
    'resources/assets/plugins/sweetalert/dist/sweetalert.min.js',
    "resources/assets/js/adminlte_rightside.js",
    "resources/assets/js/jquery-ui.js",
    "resources/assets/js/common.js",
    "resources/assets/js/jschannel.js",
    "resources/assets/js/template-web.js",
    'resources/assets/plugins/mloading/jquery.mloading.js',
    'resources/assets/plugins/mloading/jquery.mloading.js',
    'resources/assets/plugins/magnific_popup/jquery.magnific-popup.js',
    'resources/assets/plugins/webupload/webuploader.min.js'
], 'public/assets/js/application.min.js').version();