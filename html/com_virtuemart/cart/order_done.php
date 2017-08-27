<?php
defined('_JEXEC') or die('');

/**
*
* Template for the shopping cart
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
*/

//transaction number
$aOrderDetails = $this->cart->orderDetails;
$sTransNumber = $aOrderDetails["details"]["BT"]->order_number;

$sScript = "ga('ecommerce:addTransaction', {
            'id': '".$sTransNumber."',
            'affiliation': '".$this->cart->vendor->vendor_store_name."',
            'revenue': '".$aOrderDetails["details"]["BT"]->order_total."',
            'shipping': '".$aOrderDetails["details"]["BT"]->order_shipment."',
            'tax': '".$aOrderDetails["details"]["BT"]->order_tax."'
          });";

foreach ($aOrderDetails["items"] as $iKey => $oItem) {
    $sScript .= "
    ga('ecommerce:addItem', {
      'id': '".$sTransNumber."',
      'name': '".$oItem->product_name."',
      'sku': '".$oItem->product_sku."',
      'category': '".$oItem->category_name."',
      'price': '".$oItem->product_final_price."',
      'quantity': '".$oItem->product_quantity."'
    });";
}

//add ecommerce tracking script
echo "<script>
    ga('require', 'ecommerce');
    ".$sScript."
    ga('ecommerce:send');
</script>"; 

echo '<div class="order-done col-md-6 col-md-offset-3">';

    if (vRequest::getBool('display_title',true)) {
            echo '<h1>'.vmText::_('COM_VIRTUEMART_CART_ORDERDONE_THANK_YOU').'</h1>';
    }
    echo '<div class="order-done-content">';

    $this->html = vRequest::get('html', vmText::_('COM_VIRTUEMART_ORDER_PROCESSED') );
    echo $this->html;

    echo '</div>';

echo '</div>';

