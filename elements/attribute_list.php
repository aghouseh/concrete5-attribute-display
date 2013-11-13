<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

/**
 * Package AttributeDisplayPackage
 * Abstracted attribute form listing
 *
 * @package Attribute Display
 * @author Andrew Householder <concrete5@aghouseh.com>
 */

// if we do not have a valid category
$categories = AttributeKeyCategory::getList();
if (!$category || !in_array($category, $categories)
	return;
}
?>
<div class="form-horizontal attribute-list-form">
	<fieldset>
		<legend><?php echo t('Choose Available Filters'); ?></legend>
		<p class="muted">
			<?php echo t('Choose the attributes that will be available to visitors for filtering your page list results.'); ?>
		</p>
		<ul>
			<?php // first output our assigned keys ?>
			<?php foreach ($attribute_keys as $key): $selected_keys[] = $key->getAttributeKeyID(); ?>
			<li class="assigned"><i class="icon-align-justify"></i>
				<label>
					<?php echo $form->checkbox('filterable-page-list-attribute' . '[' . $index . ']', $key->getAttributeKeyID(), true); ?>
					<span class="ak-name"><?php echo $key->getAttributeKeyName(); ?></span>
				</label>
				<span class="label label-success ak-type"><?php echo $text->unhandle($key->atHandle); ?></span>				
			</li>
			<?php $index++; endforeach; ?>

			<?php foreach ($attribute_keys_list as $key): if (!in_array($key->getAttributeKeyID(), $selected_keys)): ?>
			<li class="unassigned"><i class="icon-align-justify"></i>
				<label>
					<?php echo $form->checkbox('filterable-page-list-attribute' . '[' . $index . ']', $key->getAttributeKeyID(), false); ?>
					<span class="ak-name"><?php echo $key->getAttributeKeyName(); ?></span>
				</label>
				<span class="label ak-type"><?php echo $text->unhandle($key->atHandle); ?></span>
			</li>
			<?php endif; $index++; endforeach; ?>
		</ul>
	</fieldset>
</div>
