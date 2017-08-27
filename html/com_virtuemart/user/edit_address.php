<?php
/**
 *
 * Enter address data for the cart, when anonymous users checkout
 *
 * @package    VirtueMart
 * @subpackage User
 * @author Oscar van Eijk, Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_address.php 9272 2016-08-29 11:39:18Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

// Implement Joomla's form validation
JHtml::_ ('behavior.formvalidation');
JHtml::stylesheet ('vmpanels.css', JURI::root () . 'components/com_virtuemart/assets/css/');

if (!class_exists('VirtueMartCart')) require(VMPATH_SITE . DS . 'helpers' . DS . 'cart.php');
$this->cart = VirtueMartCart::getCart();
$url = 0;
if ($this->cart->_fromCart or $this->cart->getInCheckOut()) {
	$rview = 'cart';
}
else {
	$rview = 'user';
} ?>

<div class="edit-address-cart col-md-6 col-md-offset-3">

<?php function renderControlButtons($view,$rview,$address_type){ ?>

    <div class="send-buttons">
            <?php

            $buttonclass = 'btn btn-lg btn-info';
            
            if (VmConfig::get ('oncheckout_show_register', 1) && $view->userDetails->JUser->id == 0 && !VmConfig::get ('oncheckout_only_registered', 0) && $view->address_type == 'BT' and $rview == 'cart') {
                    echo '<div id="reg_text">'.vmText::sprintf ('COM_VIRTUEMART_ONCHECKOUT_DEFAULT_TEXT_REGISTER', vmText::_ ('COM_VIRTUEMART_REGISTER_AND_CHECKOUT'), vmText::_ ('COM_VIRTUEMART_CHECKOUT_AS_GUEST')).'</div>';			
            }

            if (VmConfig::get ('oncheckout_show_register', 1) && $view->userDetails->JUser->id == 0 && $view->address_type == 'BT' and $rview == 'cart') {
                    ?>
                    <button name="register" class="<?php echo $buttonclass ?>" type="submit" onclick="javascript:return myValidator(userForm,true);"
                                    title="<?php echo vmText::_ ('COM_VIRTUEMART_REGISTER_AND_CHECKOUT'); ?>"><i class="fa fa-user-plus"></i><?php echo " " . vmText::_ ('COM_VIRTUEMART_REGISTER_AND_CHECKOUT'); ?></button>
                    <?php if (!VmConfig::get ('oncheckout_only_registered', 0)) { ?>
                            <button name="save" class="<?php echo $buttonclass ?>" title="<?php echo vmText::_ ('COM_VIRTUEMART_CHECKOUT_AS_GUEST'); ?>" type="submit"
                                            onclick="javascript:return myValidator(userForm, false);"><i class="fa fa-shopping-cart"></i><?php echo " " . vmText::_ ('COM_VIRTUEMART_CHECKOUT_AS_GUEST'); ?></button>
                    <?php } ?>
                    <button class="btn btn-lg btn-default" type="reset"
                                    onclick="window.location.href='<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=' . $rview.'&task=cancel'); ?>'"><i class="fa fa-remove"></i><?php echo " " . vmText::_ ('COM_VIRTUEMART_CANCEL'); ?></button>
            <?php
            } else {
                if ($address_type == "ST") { ?>
                    <button class="<?php echo $buttonclass ?>" type="submit"
                            onclick="javascript:return myValidator(userForm,true);"><i class="fa fa-check"></i><?php echo " " . vmText::_ ('COM_VIRTUEMART_SAVE'); ?></button>
                <?php } else { ?>
                    <button class="<?php echo $buttonclass ?>" type="submit"
                            onClick="javascript:return myValidator(userForm,true);"><i class="fa fa-arrow-right"></i><?php echo " " . vmText::_ ('COM_VIRTUEMART_CART_NEXT_STEP'); ?></button>
                <?php } ?>
                    <button class="btn btn-lg btn-default" type="reset"
                            onclick="window.location.href='<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=' . $rview.'&task=cancel'); ?>'"><i class="fa fa-remove"></i><?php echo " " . vmText::_ ('COM_VIRTUEMART_CANCEL'); ?></button>
            <?php } ?>
    </div>
    <?php
    }

    if (VmConfig::get ('oncheckout_show_steps', 1) && $this->cart->_fromCart && $this->cart->getInCheckOut()) {
        echo shopFunctionsF::renderVmSubLayout('steps',array('step'=>1));
    }

    ?>
    <h1><?php echo ($this->address_type == "ST" ? vmText::_("COM_VIRTUEMART_USER_FORM_SHIPTO_LBL") : $this->page_title); ?></h1>

    <?php

    $task = '';
    if ($this->cart->getInCheckOut()){
            $task = $this->address_type == "ST" ? '&task=editaddresscartST' : '&task=editaddresscartBT';
            if ($this->userDetails->JUser->id == 0 && $this->address_type == 'BT' and $rview == 'cart') {
                $onSubmit = 'onSubmit="ga(\'send\', \'event\', \'Account\', \'registration-cart\', \'Registrace z kosiku\');"';
            } else {
                $onSubmit = $this->address_type != "ST" ? 'onSubmit="ga(\'send\', \'event\', \'Checkout\', \'step1\', \'Krok 1 - Adresa\');"' : "";
            }
    }
    $url = 'index.php?option=com_virtuemart&view=user'.$task;

    if ($this->address_type != "ST") {
            echo shopFunctionsF::getLoginForm (TRUE, FALSE, $login_url);
    }

    ?>

    <form method="post" id="userForm" name="userForm" class="form-validate" action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=user'.$task,$this->useXHTML,$this->useSSL) ?>" <?php echo $onSubmit; ?>>
    <fieldset>
    <?php // captcha addition
            if(VmConfig::get ('reg_captcha') && JFactory::getUser()->guest == 1){
                    $captcha_visible = vRequest::getVar('captcha');
                    $hide_captcha = (VmConfig::get ('oncheckout_only_registered') or $captcha_visible) ? '' : 'style="display: none;"';
                    ?>
                    <fieldset id="recaptcha_wrapper" <?php echo $hide_captcha ?>>
                            <?php if(!VmConfig::get ('oncheckout_only_registered')) { ?>
                                    <span class="userfields_info"><?php echo vmText::_ ('COM_VIRTUEMART_USER_FORM_CAPTCHA'); ?></span>
                            <?php } ?>
                            <?php
                            echo $this->captcha; ?>
                    </fieldset>
    <?php } // end of captcha addition

            if (!class_exists ('VirtueMartCart')) {
                    require(VMPATH_SITE . DS . 'helpers' . DS . 'cart.php');
            }

            if (count ($this->userFields['functions']) > 0) {
                    echo '<script language="javascript">' . "\n";
                    echo join ("\n", $this->userFields['functions']);
                    echo '</script>' . "\n";
            }

            echo $this->loadTemplate ('userfields');
            
            if ($this->userDetails->JUser->get ('id') and $this->address_type != 'ST') {
                    echo $this->loadTemplate ('addshipto');
            }
        
            renderControlButtons($this,$rview,$this->address_type); ?>
            
            <input type="hidden" name="option" value="com_virtuemart"/>
            <input type="hidden" name="view" value="user"/>
            <input type="hidden" name="controller" value="user"/>
            <input type="hidden" name="task" value="saveUser"/>
            <input type="hidden" name="layout" value="<?php echo $this->getLayout (); ?>"/>
            <input type="hidden" name="address_type" value="<?php echo $this->address_type; ?>"/>
            <?php if (!empty($this->virtuemart_userinfo_id)) {
                    echo '<input type="hidden" name="shipto_virtuemart_userinfo_id" value="' . (int)$this->virtuemart_userinfo_id . '" />';
            }
            echo JHtml::_ ('form.token');
            ?>

    </fieldset>
    </form>
</div>