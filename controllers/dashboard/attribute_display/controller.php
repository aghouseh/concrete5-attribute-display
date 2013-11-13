<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * Class DashboardAttributeDisplayController
 * Page controller for our Dashboard settings
 *
 * @package Attribute Display
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

class DashboardAttributeDisplayController extends DashboardBaseController {

	/**
	 * Stub View method
	 */
	public function view() {
		$this->redirect('/dashboard/attribute_display/categories');
	}

}
