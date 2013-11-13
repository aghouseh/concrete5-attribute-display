<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * Class DashboardAttributeDisplayController
 * Page controller for our Dashboard settings
 *
 * @package Attribute Display
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

class DashboardAttributeDisplayCategoriesController extends DashboardBaseController {

	/**
	 * Our Concrete helper classes
	 */
	public $helpers = array('form', 'concrete/dashboard');

	/**
	 * Parent package handle
	 */
	public $pkgHandle = 'attribute_display';

	/**
	 * Stub View method
	 */
	public function view() {
	}

	/**
	 * Save method
	 * Runs our package setConfigSettings method with our $_REQUEST array
	 */
	public function save_settings() {
		$pkg = Package::getByHandle($this->pkgHandle);
		$pkg->setConfigSettings($_REQUEST);
		$this->redirect('/dashboard/attribute_display/categories', 'settings_updated');
	}

	/**
	 * Sets our success message
	 */
	public function settings_updated() {
		$this->set('message', t('Settings updated.'));
	}

}
