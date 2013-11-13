<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * Class DashboardAttributeDisplayController
 * Page controller for our Dashboard settings
 *
 * @package Attribute Display
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

class DashboardAttributeDisplayController extends DashboardBaseController {

	public function on_start() {
		var_dump('wonk');
	}

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
		$this->redirect('/dashboard/attribute_display/categories');
	}

	/** 
	 * Controller for the available categories form
	 */
	public function categories() {
		var_dump('blonk');
	}

	/**
	 * Save method
	 * Runs our package setConfigSettings method with our $_REQUEST array
	 */
	public function save_settings() {
		$pkg = Package::getByHandle($this->pkgHandle);
		$pkg->setConfigSettings($_REQUEST);
		$this->redirect('/dashboard/attribute_display', 'settings_updated');
	}

	/**
	 * Sets our success message
	 */
	public function settings_updated() {
		$this->set('message', t('Settings updated.'));
	}

}
