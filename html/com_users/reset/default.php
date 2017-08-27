<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>
<div class="reset col-md-6 col-md-offset-3<?php echo $this->pageclass_sfx?>">
    
        <h1>Zapomněli jste své heslo?</h1>

	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=reset.request'); ?>" method="post" class="form-validate">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<fieldset>
				<p><?php echo JText::_($fieldset->label); ?></p>
				<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field) : ?>
					<div class="form-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</fieldset>
		<?php endforeach; ?>

		<div class="form-group">
			<div class="controls">
				<button type="submit" class="btn btn-info btn-lg validate"><i class="fa fa-check"></i><?php echo " " . JText::_('JSUBMIT'); ?></button>
                                <a href="<?php echo JRoute::_('index.php?option=com_users'); ?>" class="btn btn-default btn-lg validate"><i class="fa fa-close"></i> Zpět</a>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
