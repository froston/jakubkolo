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

<div class="login col-md-6 col-md-offset-3 <?php echo $this->pageclass_sfx; ?>">
    
        <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
        
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate" onSubmit="ga('send', 'event', 'Account', 'login', 'Prihlaseni');">

		<fieldset>
			<?php foreach ($this->form->getFieldset('credentials') as $field) : ?>
				<?php if (!$field->hidden) : ?>
					<div class="form-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>

			<?php if ($this->tfa): ?>
				<div class="form-group">
					<div class="control-label">
						<?php echo $this->form->getField('secretkey')->label; ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getField('secretkey')->input; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<div  class="form-group">
				<div class="control-label"><label><?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME') ?></label></div>
				<div class="controls"><input id="remember" type="checkbox" name="remember" class="inputbox" value="yes"/></div>
			</div>
			<?php endif; ?>

			<div class="form-group send-button">
				<div class="controls">
					<button type="submit" class="btn btn-info btn-lg">
                                            <i class="fa fa-sign-in"></i><?php echo " " . JText::_('JLOGIN'); ?>
					</button>
				</div>
			</div>
                        <div class="forget">
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"><?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>"><?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
                        </div>

                        <input type="hidden" name="return" value="<?php echo base64_encode('index.php?option=com_users&view=profile'); ?>" />
			
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
	</form>
</div>

<div class="new-customer col-md-6 col-md-offset-3">
    <h3 class="section-title">Nový zákazník?</h3>
    <p>Ještě nemáte účet? Zaregistrujte se zdarma a získejte mnoho výhod. Samotná registrace Vám zabere jen několik sekund.</p>
    <a class="btn btn-info btn-lg" href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>"><i class="fa fa-user-plus"></i> Registrace</a>
</div>
