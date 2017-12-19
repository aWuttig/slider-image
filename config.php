<?php
/**
 * Plugin configurations
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


$includes = array(
    'Hugeit_Slider_Html_Loader' => 'includes/admin/class-hugeit-slider-html-loader',
    'Hugeit_Slider_Slider_Interface' => 'includes/interfaces/interface-hugeit-slider-slider-interface',
    'Hugeit_Slider_Slide_Interface' => 'includes/interfaces/interface-hugeit-slider-slide-interface',
    'Hugeit_Slider_Slide_Image_Interface' => 'includes/interfaces/interface-hugeit-slider-slide-image-interface',
    'Hugeit_Slider_Slide_Video_Interface' => 'includes/interfaces/interface-hugeit-slider-slide-video-interface',
    'Hugeit_Slider_Slide_Post_Interface' => 'includes/interfaces/interface-hugeit-slider-slide-post-interface',
    'Hugeit_Slider_Options_Interface' => 'includes/interfaces/interface-hugeit-slider-options-interface',
    'Hugeit_Slider_Slider' => 'includes/class-hugeit-slider-slider',
    'Hugeit_Slider_Slide' => 'includes/class-hugeit-slider-slide',
    'Hugeit_Slider_Slide_Image' => 'includes/class-hugeit-slider-slide-image',
    'Hugeit_Slider_Helpers' => 'includes/class-hugeit-slider-helpers',
    'Hugeit_Slider_Migrate' => 'includes/class-hugeit-slider-migrate',
    'Hugeit_Slider_Install' => 'includes/class-hugeit-slider-install',
    'Hugeit_Slider_Template_Loader' => 'includes/class-hugeit-slider-template-loader',
    'Hugeit_Slider_Options' => 'includes/class-hugeit-slider-options',
    'Hugeit_Slider_Ajax' => 'includes/class-hugeit-slider-ajax',
    'Hugeit_Slider_Widget' => 'includes/class-hugeit-slider-widget',
    'Hugeit_Slider_Shortcode' => 'includes/class-hugeit-slider-shortcode',
    'Hugeit_Slider_Frontend_Scripts' => 'includes/class-hugeit-slider-frontend-scripts',

    'Hugeit_Slider_Deactivation_Feedback' => 'includes/tracking/class-hugeit-slider-deactivation-feedback',
);
$admin_includes = array();

if (is_admin()) {
    $admin_includes = array(
//        'Hugeit_Slider_WPDEV_Settings_API' => 'vendor/wpdev-settings/class-wpdev-settings-api',
        'Hugeit_Slider_General_Options' => 'includes/admin/class-hugeit-slider-general-options',
        'Hugeit_Slider_Admin' => 'includes/admin/class-hugeit-slider-admin',
        'Hugeit_Slider_Admin_Assets' => 'includes/admin/class-hugeit-slider-admin-assets',
        'Hugeit_Slider_Sliders' => 'includes/admin/class-hugeit-slider-sliders',
    );
}

$GLOBALS['hugeit_slider_aliases'] = array_merge($includes, $admin_includes);


/**
 * @param $classname
 *
 * @throws Exception
 */
function hugeit_slider_autoload($classname)
{

    global $hugeit_slider_aliases;


    /**
     * We do not touch classes that are not related to us
     */
    if (!strstr($classname, 'Hugeit_Slider_')) {
        return;
    }


    if (!key_exists($classname, $hugeit_slider_aliases)) {

        throw new Exception('trying to load "' . $classname . '" class that is not registered in config file.');
    }


    $path = HUGEIT_SLIDER_PLUGIN_PATH . '/' . $hugeit_slider_aliases[$classname] . '.php';


    if (!file_exists($path)) {

        throw new Exception('the given path for class "' . $classname . '" is wrong, trying to load from ' . $path);

    }

//    var_dump($hugeit_slider_aliases[$classname]);
    require_once $path;

    if (!interface_exists($classname) && !class_exists($classname)) {

        throw new Exception('The class "' . $classname . '" is not declared in "' . $path . '" file.');

    }
}

/**
 * Autoloader check
 *
 */
if (function_exists('spl_autoload_register')) {
    spl_autoload_register('hugeit_slider_autoload');

} elseif (isset($GLOBALS['_wp_spl_autoloaders'])) {

    array_push($GLOBALS['_wp_spl_autoloaders'], 'hugeit_slider_autoload');

} else {

    throw new Exception ('We recommend you to update your php version that appears to be a really old one which is not compatible with this version of the Image Slider.');
}