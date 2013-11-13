<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/***************************************************************************************
 *      ___   __  __       _ __          __          ____  _            __           
 *     /   | / /_/ /______(_) /_  __  __/ /____     / __ \(_)________  / /___ ___  __
 *    / /| |/ __/ __/ ___/ / __ \/ / / / __/ _ \   / / / / / ___/ __ \/ / __ `/ / / /
 *   / ___ / /_/ /_/ /  / / /_/ / /_/ / /_/  __/  / /_/ / (__  ) /_/ / / /_/ / /_/ / 
 *  /_/  |_\__/\__/_/  /_/_.___/\__,_/\__/\___/  /_____/_/____/ .___/_/\__,_/\__, /  
 *                                                           /_/            /____/   
 * -------------------------------------------------------------------------------------
 * 
 * Class AttributeDisplayPackage
 * Package controller
 *
 * @package Attribute Display
 * @version 0.0.1
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

class AttributeDisplayPackage extends Package {

	/**
	 * Concrete5 required properties & methods
	 */
	protected $pkgHandle = 'attribute_display';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '0.0.1';

	public function getPackageDescription() {
		return t('Provides a block & developer libraries for displaying attribute forms.');
	}
	
	public function getPackageName() {
		return t('Attribute Display');
	}
	
	/**
	 * Package-wide attribute handle set as a property for DRY implementation
	 */
	public $instructions_attribute_handle = 'product_additional_message';

	/**
	 * Config Keys
	 * key name => boolean flag if data should be encoded
	 */
	public $configurable_keys = array(
		'ATTRIBUTE_DISPLAY_AVAILABLE_CATEGORIES_VIEW' => true,
		'ATTRIBUTE_DISPLAY_AVAILABLE_CATEGORIES_EDIT' => true
	);

	/**
	 * Return a simplified list of categories
	 * @return Array
	 */
	public function getCategoriesArray() {
		$categories = array();
		foreach (AttributeKeyCategory::getList() as $category) {
			$handle = $category->getAttributeKeyCategoryHandle();
			$categories[$handle] = $text->unhandle($handle);
		}
		return $categories;
	}
	
	/**
	 * Package Install
	 * 
	 * @return [void]
	 */
	public function install($options = null) {
		parent::install();
		$this->_installConfig($options);
		$this->_configure();
	}

	/**
	 * Package Upgrade method
	 * 
	 * @return [void]
	 */
	public function upgrade() {
		$this->_configure();
		parent::upgrade();
	}

	/**
	 * Unified method to save our config data given an array (typically $_POST/$_REQUEST)
	 * 
	 * @return [void]
	 */
	public function setConfigSettings($data) {
		if (is_array($data)) {
			$pkg = Package::getByHandle($this->pkgHandle);
			$json = Loader::helper('json');
			foreach ($this->configurable_keys as $key => $is_encoded) {
				$pkg->saveConfig($key, ($is_encoded) ? $json->encode($data[$key]) : $data[$key]);
			}
		}
	}

	/**
	 * Retrieve our current settings array
	 * 
	 * @return [Array]
	 */
	public function getConfigSettings() {
		$pkg = Package::getByHandle($this->pkgHandle);
		$json = Loader::helper('json');
		$config_settings = array();
		foreach ($this->configurable_keys as $key => $is_encoded) {
			$datum = $pkg->config($key);
			$config_settings[$key] = ($is_encoded) ? $json->decode($datum) : $datum;
		}
		return $config_settings;
	}

	/**
	 * Our configure method that runs on install/upgrade to support our custom installations
	 * 
	 * @return [void]
	 */
	protected function _configure() {
		$this->_verifyBlockTypes(); // attributes
		$this->_verifySinglePages(); // dashboard pages
	}

	/**
	 * This method verifies that our block is installed
	 * 
	 * @return [void]
	 */
	protected function _verifyBlockTypes() {
		$pkg = Package::getByHandle($this->pkgHandle);
		if (!$block_type = BlockType::getByHandle($this->pkgHandle)) {
			BlockType::installBlockTypeFromPackage($this->pkgHandle, $pkg);	
		}
	}

	/**
	 * Verifies installation of our dashboard single pages
	 * 
	 * @return [void]
	 */
	protected function _verifySinglePages() {
		$this->_verifySinglePage(
			'dashboard/attribute_display',
			t('Attribute Display'),
			$this->getPackageDescription()
		);
		$this->_verifySinglePage(
			'dashboard/attribute_display/categories',
			t('Categories'),
			t('Configure which categories are available for display or editing in the block.')
		);
	}

	protected function _verifySinglePage($path, $name, $description) {
		$pkg = Package::getByHandle($this->pkgHandle);
		$single_page = Page::getByPath($path);
		if (!$single_page instanceof Page || $single_page->isError()) {
			$single_page = SinglePage::add($path, $pkg);
		}
		$single_page->update(array(
			'cName'        => $name,
			'cDescription' => $description)
		);
	}

	/**
	 * Setup our default configuration options within the package
	 * 
	 * @return [void]
	 */
	protected function _installConfig($options) {
		$this->setConfigSettings($options);
	}

}