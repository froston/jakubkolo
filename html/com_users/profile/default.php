<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$user = JFactory::getUser();
// logout link
if ($user->guest) {
    $link = "index.php?option=com_users&view=login";
} else {
    $userToken = JSession::getFormToken();
    $activeItem = & JSite::getMenu()->getActive();
    $returnURL = base64_encode($activeItem->link . "\n");
    $link = 'index.php?option=com_users&task=user.logout&' . $userToken . '=1&return='.$returnURL.'>';
}
?>
<div class="profile col-md-6 col-md-offset-3<?php echo $this->pageclass_sfx?>">
    
    <h1>Uživatelský profil</h1>

    <?php echo $this->loadTemplate('core'); ?>

    <?php echo $this->loadTemplate('params'); ?>

    <?php echo $this->loadTemplate('custom'); ?>
    
    <a class="btn btn-info btn-lg" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=user&layout=edit');?>">
        <i class="fa fa-gears"></i> <?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
    </a>
    <a class="btn btn-info btn-lg" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=orders&layout=list');?>">
        <i class="fa fa-list"></i> Moje objednávky
    </a>
    <a class="btn btn-default btn-lg" href="<?php echo JRoute::_($link);?>">
        <i class="fa fa-sign-out"></i> <?php echo JText::_('JLOGOUT'); ?>
    </a>

</div>
