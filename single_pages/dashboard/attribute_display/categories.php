<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * Package AttributeDisplayPackage
 * Dashboard settings View
 *
 * @package Attribute Display
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

// dashboard top wrapper
echo $concrete_dashboard->getDashboardPaneHeaderWrapper(t('Available Attribute Categories'));

// include our config form
Loader::packageElement('config_settings', $this->controller->pkgHandle, array('form_action' => $this->action('save_settings')));

// dashboard footer
echo $concrete_dashboard->getDashboardPaneFooterWrapper(false); ?>