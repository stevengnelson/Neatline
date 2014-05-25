<?php

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2014 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */


/**
 * Get the name of directory that contains the static payloads.
 *
 * @return string The directory name.
 */
function nl_getDistDir()
{
    return file_exists(NL_DIR.'/.git') ? '_dist' : 'dist';
}


/**
 * Queue a CSS file, threading in the correct distribution directory.
 *
 * @param string The file path.
 */
function nl_queueDistCss($path)
{
    queue_css_file(nl_getDistDir().'/'.$path);
}


/**
 * Queue a Javascript file, threading in the correct distribution directory.
 *
 * @param string The file path.
 */
function nl_queueDistJs($path)
{
    queue_js_file(nl_getDistDir().'/'.$path);
}


/**
 * Include static files for the exhibit add form.
 */
function nl_queueAddForm()
{
    nl_queueDistCss('exhibit-form');
    nl_queueDistJs('ckeditor/ckeditor');
    nl_queueDistJs('add-form');
}


/**
 * Include static files for the exhibit edit form.
 */
function nl_queueEditForm()
{
    nl_queueDistCss('exhibit-form');
    nl_queueDistJs('ckeditor/ckeditor');
    nl_queueDistJs('edit-form');
}


/**
 * Include static files for the exhibit.
 *
 * @param NeatlineExhibit The exhibit.
 */
function nl_queueNeatlinePublic($exhibit)
{

    nl_queueGoogleMapsApi();

    nl_queueDistCss('neatline-public');
    nl_queueDistJs('neatline-public');
    queue_js_file('bootstrap');

    fire_plugin_hook('neatline_public_static', array(
        'exhibit' => $exhibit
    ));

}


/**
 * Include static files for the editor.
 *
 * @param NeatlineExhibit The exhibit.
 */
function nl_queueNeatlineEditor($exhibit)
{

    nl_queueGoogleMapsApi();

    nl_queueDistCss('neatline-editor');
    nl_queueDistJs('neatline-editor');
    nl_queueDistJs('ckeditor/ckeditor');
    queue_js_file('bootstrap');

    fire_plugin_hook('neatline_editor_static', array(
        'exhibit' => $exhibit
    ));

}


/**
 * Include static files for the exhibit fullscreen view.
 */
function nl_queueFullscreen()
{
    queue_js_file('fullscreen');
}


/**
 * Include exhibit-specific theme assets.
 *
 * @param NeatlineExhibit $exhibit The exhibit.
 */
function nl_queueExhibitTheme($exhibit)
{
    try {
        queue_css_file('style', null, false,"exhibits/themes/$exhibit->slug");
        queue_js_file('script', "exhibits/themes/$exhibit->slug");
    } catch (Exception $e) {}
}


/**
 * Include the Google Maps API.
 */
function nl_queueGoogleMapsApi()
{
    nl_appendScript('//maps.google.com/maps/api/js?sensor=false');
}


/**
 * Append a script to the <head> tag.
 *
 * @param string $script The script location.
 */
function nl_appendScript($script)
{
    get_view()->headScript()->appendScript(
        '', 'text/javascript', array('src' => $script)
    );
}


/**
 * Form the path to an exhibit's custom theme assets.
 *
 * @param NeatlineExhibit $exhibit The exhibit.
 * @return string The theme path.
 */
function nl_getExhibitThemeDir($exhibit)
{
    return nl_getPublicThemeDir()."/exhibits/themes/$exhibit->slug";
}


/**
 * Get the path to the `neatline` directory in the active Omeka theme.
 *
 * @return string The theme path.
 */
function nl_getPublicThemeDir()
{
    return PUBLIC_THEME_DIR.'/'.get_option('public_theme').'/neatline';
}


/**
 * Get the path to the OpenLayers theme.
 *
 * @return string The theme path.
 */
function nl_getOpenLayersThemeDir()
{
    return public_url('plugins/Neatline/views/shared/images/dark/');
}
