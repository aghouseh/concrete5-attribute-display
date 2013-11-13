<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * A block controller for displaying attributes
 *
 * @package Attribute Display
 * @author Andrew Householder <andrew@artesiandesigninc.com>
 *
 */
class AttributeDisplayController extends BlockController {
	
	protected $btTable = 'btAttributeDisplay';
	protected $btInterfaceWidth = '600';
	protected $btInterfaceHeight = '465';
	protected $btWrapperClass = 'ccm-ui';
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;

	public $helpers = array('form', 'concrete/dashboard');
	
	public function getBlockTypeDescription() {
		return t('Display an attribute or group of attributes.');
	}
	
	public function getBlockTypeName() {
		return t('Attribute Display');
	}

	public function add() {
		$this->edit();
	}

	public function edit() {
		$this->set('all_elements', $this->getAllElements());
	}
	
	public function save($data) { 
		$data['values'] = Loader::helper('json')->encode($data['values']);
		parent::save($data);
	}

	public function on_start() {
		if ($this->values) {
			$this->values = Loader::helper('json')->decode($this->values);
		}
	}

	public function getAllElements() {

	}

}
	
