<?php
/**
 *
 * Show the product prices
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_showprices.php 8024 2014-06-12 15:08:59Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
$product = $viewData['product'];
$currency = $viewData['currency'];
#if empty load default avalability
if (empty($product->product_availability)) {
    $product->product_availability = ($product->product_in_stock - $product->product_ordered < 1 ? "4-6 týdnů" : "2-3 dny");
    $amount = ($product->product_in_stock - $product->product_ordered);
    $text = ($product->product_in_stock - $product->product_ordered < 1 ? "Není skladem" : "Skladem: ");
    $class = ($product->product_in_stock - $product->product_ordered < 1 ? "out-stock" : "in-stock");
}
?>
<div class="product-price" id="productPrice<?php echo $product->virtuemart_product_id ?>">
	<?php
	
        if (($product->prices['basePrice'] > $product->prices['salesPrice']) and $product->prices['discountAmount'] < 0) {
            echo '<div class="price-crossed" >' . $currency->createPriceDiv ('basePrice', 'COM_VIRTUEMART_PRODUCT_BASEPRICE', $product->prices)  . "</div>";
            echo $currency->createPriceDiv ('discountAmount', 'COM_VIRTUEMART_PRODUCT_DISCOUNT_AMOUNT', $product->prices);
            echo $currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $product->prices);
            if (!empty($product->product_availability)) {
                echo "<div class='productAvalability'>" . vmText::_("COM_VIRTUEMART_PRODUCT_AVAILABILITY") . ": " . $product->product_availability."</div>";
                echo "<div class='productAvalability ".$class."'>".$text." ".($amount ?: "") ."</div>";
            } else {
                echo '<div style="height: 26px;" class="clearfix"></div>';
            }
        } else {
            echo $currency->createPriceDiv ('basePrice', 'COM_VIRTUEMART_PRODUCT_BASEPRICE', $product->prices);
            if (!empty($product->product_availability)) {
                echo "<div class='productAvalability'>" . vmText::_("COM_VIRTUEMART_PRODUCT_AVAILABILITY") . ": " . $product->product_availability."</div>";
                echo "<div class='productAvalability ".$class."'>".$text." ".($amount ?: "") ."</div>";
            } else {
                echo '<div style="height: 19px;" class="clearfix"></div>';
            }
            echo '<div style="height: 52px;" class="clearfix"></div>'; 
        }
	
	?>
</div>

