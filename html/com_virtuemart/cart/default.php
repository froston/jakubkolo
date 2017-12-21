<?php
/**
 *
 * Layout for the shopping cart
 *
 * @package    VirtueMart
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
 * @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

JHtml::_ ('behavior.formvalidation');

?>

<div class="vm-cart-header-container">
    
        <?php if (VmConfig::get ('oncheckout_show_steps', 1) && $this->checkout_task === 'confirm') {
            echo shopFunctionsF::renderVmSubLayout('steps',array('step'=>4));
        } 
        
        if ($this->checkout_task === 'confirm') { ?>
            <h1><?php echo vmText::_ ('COM_VIRTUEMART_ORDER_CONFIRM_MNU'); ?></h1>
        <?php } else { ?>
            <h1><?php echo vmText::_ ('COM_VIRTUEMART_CART_TITLE'); ?></h1>
        <?php } ?>
    
        
	
	<div class="clear"></div>
</div>

<?php if (!empty($this->cart->products)) { ?>

    <div id="cart-view" class="cart-view">

            <?php
            //$uri = vmURI::getCleanUrl();
            //$uri = str_replace(array('?tmpl=component','&tmpl=component'),'',$uri);
            //echo shopFunctionsF::getLoginForm ($this->cart, FALSE,$uri);

            // This displays the form to change the current shopper
            //if ($this->allowChangeShopper){
                //echo $this->loadTemplate ('shopperform');
            //}


            $taskRoute = '';
            ?><form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart' . $taskRoute, $this->useXHTML, $this->useSSL); ?>" <?php echo $this->checkout_on_submit; ?>>
                    <?php
                    if(VmConfig::get('multixcart')=='byselection'){
                            if (!class_exists('ShopFunctions')) require(VMPATH_ADMIN . DS . 'helpers' . DS . 'shopfunctions.php');
                            echo shopFunctions::renderVendorFullVendorList($this->cart->vendorId);
                            ?><input type="submit" name="updatecart" title="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" class="button"  style="margin-left: 10px;"/><?php
                    }
                    // This displays the pricelist MUST be done with tables, because it is also used for the emails
                    echo $this->loadTemplate ('pricelist'); ?>
                    
                    <div class="free-shipping-block"> 
                        <?php
                        if ($this->cart->cartPrices["salesPrice"] < 2000) {
                            $iToFree = 2000 - $this->cart->cartPrices["salesPrice"];
                            ?>
                            <p><i class="icon-3x color-light fa fa-truck"></i> Zbývá ještě nakoupit za <b><?php echo $iToFree;?> Kč</b> pro poštovné zdarma!</p>
                        <?php
                        } else {
                            ?>
                            <p><i class="icon-3x color-light fa fa-truck"></i> Máte poštovné <b>zdarma!</b></p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="free-shipping-block"> 
                        <?php
                        if ($this->cart->cartPrices["salesPrice"] < 600) {
                            $iToFree = 600 - $this->cart->cartPrices["salesPrice"];
                            ?>
                            <p><i class="icon-3x color-light fa fa-gift"></i> Nakupte ještě za <b><?php echo $iToFree;?> Kč</b> a dostanete dárek zdarma!</p>
                        <?php
                        } else {
                            ?>
                            <p><i class="icon-3x color-light fa fa-gift"></i> Dostanete dárek <b>zdarma!</b></p>
                        <?php
                        }
                        ?>
                    </div>

                   <?php if (!empty($this->checkoutAdvertise)) {
                            ?> <div id="checkout-advertise-box"> <?php
                            foreach ($this->checkoutAdvertise as $checkoutAdvertise) {
                                    ?>
                                    <div class="checkout-advertise">
                                            <?php echo $checkoutAdvertise; ?>
                                    </div>
                            <?php
                            }
                            ?></div><?php
                    }

                    echo $this->loadTemplate ('cartfields');
                    
                    ?> <div class="checkout-button-top">
                            <?php // Continue Shopping Button
                            if (!empty($this->continue_link_html)) {
                                echo $this->continue_link_html;
                            }
                            echo $this->checkout_link_html;
                    ?></div>

                    <?php // Continue and Checkout Button END ?>
                    <input type='hidden' name='order_language' value='<?php echo $this->order_language; ?>'/>
                    <input type='hidden' name='task' value='updatecart'/>
                    <input type='hidden' name='option' value='com_virtuemart'/>
                    <input type='hidden' name='view' value='cart'/>
            </form>


    <?php

    if(VmConfig::get('oncheckout_ajax',false)){
            vmJsApi::addJScript('updDynamicListeners',"
    if (typeof Virtuemart.containerSelector === 'undefined') Virtuemart.containerSelector = '#cart-view';
    if (typeof Virtuemart.container === 'undefined') Virtuemart.container = jQuery(Virtuemart.containerSelector);

    jQuery(document).ready(function() {
            if (Virtuemart.container)
                    Virtuemart.updDynFormListeners();
    }); ");
    }


    vmJsApi::addJScript('vm.checkoutFormSubmit',"
    Virtuemart.bCheckoutButton = function(e) {
            e.preventDefault();
            jQuery(this).vm2front('startVmLoading');
            jQuery(this).attr('disabled', 'true');
            jQuery(this).removeClass( 'vm-button-correct' );
            jQuery(this).addClass( 'vm-button' );
            jQuery(this).fadeIn( 400 );
            var name = jQuery(this).attr('name');
            var div = '<input name=\"'+name+'\" value=\"1\" type=\"hidden\">';

            jQuery('#checkoutForm').append(div);
            //Virtuemart.updForm();
            jQuery('#checkoutForm').submit();
    }
    jQuery(document).ready(function($) {
            jQuery(this).vm2front('stopVmLoading');
            var el = jQuery('#checkoutFormSubmit');
            el.unbind('click dblclick');
            el.on('click dblclick',Virtuemart.bCheckoutButton);
    });
            ");

    if( !VmConfig::get('oncheckout_ajax',false)) {
            vmJsApi::addJScript('vm.STisBT',"
                    jQuery(document).ready(function($) {

                            if ( $('#STsameAsBTjs').is(':checked') ) {
                                    $('#output-shipto-display').hide();
                            } else {
                                    $('#output-shipto-display').show();
                            }
                            $('#STsameAsBTjs').click(function(event) {
                                    if($(this).is(':checked')){
                                            $('#STsameAsBT').val('1') ;
                                            $('#output-shipto-display').hide();
                                    } else {
                                            $('#STsameAsBT').val('0') ;
                                            $('#output-shipto-display').show();
                                    }
                                    var form = jQuery('#checkoutFormSubmit');
                                    form.submit();
                            });
                    });
            ");
    }

    $this->addCheckRequiredJs();
    ?><div style="display:none;" id="cart-js">
    <?php echo vmJsApi::writeJS(); ?>
    </div>
    </div>

<?php }  else { ?>

    <div id='cart-empty' class='col-md-6 col-md-offset-3'>
        <p>Váš košík je prázdný.</p>
        <div class="vm-continue-shopping">
		<?php // Continue Shopping Button
		if (!empty($this->continue_link_html)) {
			echo $this->continue_link_html;
		} ?>
	</div>
    </div>
<?php } ?>