<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * Package AttributeDisplayPackage
 * Abstracted form presentation element
 *
 * @package Attribute Display
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

// c5 form helper
$form = Loader::helper('form');
$text = Loader::helper('text');

// get our package configuration settings
$pkg = Package::getByHandle('attribute_display');
$config_fields = (is_object($pkg)) ? $pkg->getConfigSettings() : array(); // get all of the saved data

// get our available categories array
$categories = $pkg->getCategoriesArray();

// mostly for initial install; set defaults if no values have been saved previously.
if (!isset($config_fields['ATTRIBUTE_DISPLAY_AVAILABLE_CATEGORIES_VIEW'])) {
	$config_fields['ATTRIBUTE_DISPLAY_AVAILABLE_CATEGORIES_VIEW'] = array_keys($categories);
}
if (!isset($config_fields['ATTRIBUTE_DISPLAY_AVAILABLE_CATEGORIES_EDIT'])) {
	$config_fields['ATTRIBUTE_DISPLAY_AVAILABLE_CATEGORIES_EDIT'] = array_keys($categories);
}

?>
<style>
.ccm-ui .attribute-display-form .span8 { width: 65.9574%; }
.ccm-ui .attribute-display-form .nav { margin-bottom: 0; }
.ccm-ui .attribute-display-form .tab-content { background: #FFF; padding: 20px; border: 1px solid #DDDDDD; border-top: none; }
.ccm-ui .attribute-display-form dt, .ccm-ui .attribute-display-form dd { line-height: 18px; }
</style>
<div class="attribute-display-form">

	<?php if ($view_mode == 'install'): ?>
	<div class="alert alert-info">
		<strong><?php echo t('Note'); ?>: </strong>
		<?php echo t('You may set these options now or alter them later in the dashboard.'); ?>
	</div>
	<?php endif; // $view_mode == install ?>

	<?php if ($form_action): ?><form action="<?php echo $form_action; ?>"<?php else: ?><div<?php endif; ?> class="form-horizontal">

	<?php foreach ($config_fields as $field_name => $field_options): ?>
	<fieldset class="row-fluid">
		<legend><?php echo t('%sable Categories', $text->unhandle(strtolower(str_replace('ATTRIBUTE_DISPLAY_AVAILABLE_CATEGORIES_', '', $field_name)))); ?></legend>

		<div class="control-group">
			<label class="control-label"><?php //echo t('Viewable Categories'); ?></label>
			<div class="controls">
				<?php foreach ($categories as $handle => $name): ?>
				<label class="checkbox">
					<?php echo $form->checkbox(
					$field_name, // form name/id
					$handle, // value
					in_array($handle, $field_options)); // is checked
					?>
					<?php echo $name; ?>
				</label>
				<?php endforeach; ?>
			</div>
		</div>

		<?php if ($form_action): ?>
		<div class="form-actions">
			<?php echo $form->submit('save', t('Save Settings'), array('class' => 'btn-primary')); ?>
		</div>
		<?php endif; ?>

	</fieldset>
	<?php endforeach; ?>


	<?php if ($form_action): ?></form><?php else: ?></div><?php endif; ?>

</div>