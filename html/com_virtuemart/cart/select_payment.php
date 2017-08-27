<?php
/**
 *
 * Layout for the payment selection
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: select_payment.php 9042 2015-11-05 12:22:08Z StefanSTS $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$addClass="";


if (VmConfig::get('oncheckout_show_steps', 1)) {
    echo shopFunctionsF::renderVmSubLayout('steps',array('step'=>3));
}

if ($this->layoutName!='default') {
	$headerLevel = 1;
	if($this->cart->getInCheckOut()){
		$buttonclass = 'btn btn-lg';
	} else {
		$buttonclass = 'btn btn-lg';
	}
	?>
	<form method="post" id="paymentForm" class="edit-payment col-md-6 col-md-offset-3" name="choosePaymentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate <?php echo $addClass ?>" onSubmit="ga('send', 'event', 'Checkout', 'step3', 'Krok 3 - Platba');">
<?php } else {
	$headerLevel = 3;
	$buttonclass = 'vm-button-correct';
}

if($this->cart->virtuemart_paymentmethod_id){
	echo '<h'.$headerLevel.' class="vm-payment-header-selected">'.vmText::_('COM_VIRTUEMART_CART_SELECTED_PAYMENT_SELECT').'</h'.$headerLevel.'>';
} else {
	echo '<h'.$headerLevel.' class="vm-payment-header-select">'.vmText::_('COM_VIRTUEMART_CART_SELECT_PAYMENT').'</h'.$headerLevel.'>';
} ?>


<?php
if ($this->found_payment_method ) {


	echo '<fieldset class="vm-payment-shipment-select vm-payment-select">';
	foreach ($this->paymentplugins_payments as $paymentplugin_payments) {
		if (is_array($paymentplugin_payments)) {
			foreach ($paymentplugin_payments as $paymentplugin_payment) {
				echo '<div class="vm-payment-plugin-single">'.$paymentplugin_payment.'</div>';
			}
		}
	}
	echo '</fieldset>';

} else {
	echo '<h1>'.$this->payment_not_found_text.'</h1>';
} ?>

<div class="buttonBar-right">
        <?php
        $dynUpdate = '';
        if( VmConfig::get('oncheckout_ajax',false)) {
                $dynUpdate=' data-dynamic-update="1" ';
        }
        
        if($this->cart->virtuemart_paymentmethod_id){ ?>
            <button name="updatecart" class="<?php echo $buttonclass ?> btn-info" type="submit" <?php echo $dynUpdate ?> ><i class="fa fa-check"></i><?php echo " " . vmText::_('COM_VIRTUEMART_SAVE'); ?></button>
        <?php } else { ?>
            <button name="updatecart" class="<?php echo $buttonclass ?> btn-info" type="submit" <?php echo $dynUpdate ?>><i class="fa fa-arrow-right"></i><?php echo " " . vmText::_('COM_VIRTUEMART_CART_NEXT_STEP'); ?></button>
        <?php } ?>
                

        <?php   if ($this->layoutName!='default') { ?>
                <button class="<?php echo $buttonclass ?> btn-default" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'" ><i class="fa fa-remove"></i><?php echo " " . vmText::_('COM_VIRTUEMART_CANCEL'); ?></button>
        <?php  } ?>
</div>

<?php if ($this->layoutName!='default') {
	?>    <input type="hidden" name="option" value="com_virtuemart" />
	<input type="hidden" name="view" value="cart" />
	<input type="hidden" name="task" value="updatecart" />
	<input type="hidden" name="controller" value="cart" />
	</form>
<?php
}
?>