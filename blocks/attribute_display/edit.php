<?php defined('C5_EXECUTE') or die(_('Access Denied.')); ?>

<div class="element-selector">
	<div class="control-group">
		<label for="element" class="control-label"><?php echo t('Element'); ?></label>
		<div class="controls">
			<?php echo $form->text('element', $element); ?>
		</div>
	</div>
	<div class="control-group">
		<label for="element" class="control-label"><?php echo t('Package'); ?></label>
		<div class="controls">
			<?php echo $form->text('pkgHandle', $pkgHandle); ?>
			<p class="muted"><?php echo t('Optional - in handle format.'); ?></p>
		</div>
	</div>
</div>