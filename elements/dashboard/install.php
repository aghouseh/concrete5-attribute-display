<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * Install Element / Partial for Installation Check Handling
 *
 * @package Attribute Display
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

/**
 * Set our package handle/object
 */
$pkgHandle = 'attribute_display';
$pkg = Loader::package($pkgHandle);

/**
 * Load our configuration view
 */
Loader::packageElement('config_settings', $pkgHandle, array('view_mode' => 'install'));