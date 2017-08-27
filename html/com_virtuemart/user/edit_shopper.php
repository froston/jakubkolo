<?php
/**
 *
 * Modify user form view, User info
 *
 * @package	VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_shopper.php 8565 2014-11-12 18:26:14Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if (vRequest::getCmd('task') !== "addST") {
    $cancelLink = JRoute::_('index.php?option=com_users&view=profile');
    $saveLink = 'saveUser';
} else {
    $cancelLink = JRoute::_('index.php?option=com_users&view=profile');   
    $saveLink = "saveAddressST"; 
}

echo $this->loadTemplate('address_userfields');

if ($this->userDetails->JUser->get('id') and vRequest::getCmd('task') !== "addST") {
  echo $this->loadTemplate('address_addshipto');
}

if(!empty($this->virtuemart_userinfo_id)){
	echo '<input type="hidden" name="virtuemart_userinfo_id" value="'.(int)$this->virtuemart_userinfo_id.'" />';
}
?>
<div class="button-wrapper">
    <button class="btn btn-info btn-lg" type="submit" onclick="javascript:return myValidator(userForm, true);" ><i class="fa fa-check"></i> <?php echo $this->button_lbl ?></button>
    <a class="btn btn-default btn-lg" href="<?php echo $cancelLink ?>" ><i class="fa fa-close"></i> <?php echo JText::_('COM_VIRTUEMART_CANCEL'); ?></a>
</div>
<input type="hidden" name="from" value="com_users" />
<input type="hidden" name="task" value="<?php echo $saveLink; ?>" />
<input type="hidden" name="address_type" value="<?php echo $this->address_type; ?>"/>

