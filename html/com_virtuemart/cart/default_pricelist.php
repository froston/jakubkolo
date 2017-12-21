<fieldset class="vm-fieldset-pricelist">
<div class="table-responsive">
<table
	class="cart-summary table"
	cellspacing="0"
	cellpadding="0"
	border="0"
	width="100%">
<tr>
	<th class="vm-cart-item-name" ><?php echo vmText::_ ('COM_VIRTUEMART_CART_NAME') ?></th>
	<th class="vm-cart-item-sku" ><?php echo vmText::_ ('COM_VIRTUEMART_CART_SKU') ?></th>
	<th	class="vm-cart-item-basicprice" ><?php echo vmText::_ ('COM_VIRTUEMART_CART_PRICE') ?></th>
	<th	class="vm-cart-item-quantity" ><?php echo vmText::_ ('COM_VIRTUEMART_CART_QUANTITY') ?></th>

	<?php if (VmConfig::get ('show_tax')) {
		$tax = vmText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_TAX_AMOUNT');
		if(!empty($this->cart->cartData['VatTax'])){
			if(count($this->cart->cartData['VatTax']) < 2) {
				reset($this->cart->cartData['VatTax']);
				$taxd = current($this->cart->cartData['VatTax']);
				$tax = shopFunctionsF::getTaxNameWithValue($taxd['calc_name'],$taxd['calc_value']);
			}
		}
		?>
	<th class="vm-cart-item-tax" ><?php echo "<span  class='priceColor2'>" . $tax . '</span>' ?></th>
	<?php } ?>
	<th class="vm-cart-item-discount" ><?php echo "<span  class='priceColor2'>" . vmText::_ ('COM_VIRTUEMART_CART_SUBTOTAL_DISCOUNT_AMOUNT') . '</span>' ?></th>
	<th class="vm-cart-item-total" style="text-align:right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_TOTAL') ?></th>
</tr>

<?php
$i = 1;

foreach ($this->cart->products as $pkey => $prow) {
	$prow->prices = array_merge($prow->prices,$this->cart->cartPrices[$pkey]);
?>

<tr valign="top" class="sectiontableentry<?php echo $i ?>">
	<input type="hidden" name="cartpos[]" value="<?php echo $pkey ?>">
	<td class="vm-cart-item-name" >
		<?php if ($prow->virtuemart_media_id) { ?>
		<span class="cart-images">
						 <?php
			if (!empty($prow->images[0])) {
				echo $prow->images[0]->displayMediaThumb ('', FALSE);
			}
			?>
						</span>
		<?php } ?>
		<?php echo JHtml::link ($prow->url, $prow->product_name);
			echo $this->customfieldsModel->CustomsFieldCartDisplay ($prow);
		 ?>

	</td>
	<td class="vm-cart-item-sku" ><?php  echo $prow->product_sku ?></td>
	<td class="vm-cart-item-basicprice" >
		<?php
		if (VmConfig::get ('checkout_show_origprice', 1) && $prow->prices['discountedPriceWithoutTax'] != $prow->prices['priceWithoutTax']) {
			echo '<div class="price-crossed">' . $this->currencyDisplay->createPriceDiv ('basePriceVariant', '', $prow->prices, TRUE, FALSE) . '</div>';
		}

		if ($prow->prices['discountedPriceWithoutTax']) {
			echo $this->currencyDisplay->createPriceDiv ('discountedPriceWithoutTax', '', $prow->prices, FALSE, FALSE, 1.0, false, true);
		} else {
			echo $this->currencyDisplay->createPriceDiv ('basePriceVariant', '', $prow->prices, FALSE, FALSE, 1.0, false, true);
		}
		?>
	</td>
	<td class="vm-cart-item-quantity" ><?php

				if ($prow->step_order_level)
					$step=$prow->step_order_level;
				else
					$step=1;
				if($step==0)
					$step=1;
				?>
		   <input type="text"
				   onblur="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   onclick="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   onchange="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   onsubmit="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   title="<?php echo  vmText::_('COM_VIRTUEMART_CART_UPDATE') ?>" class="quantity-input js-recalculate" size="3" maxlength="4" name="quantity[<?php echo $pkey; ?>]" value="<?php echo $prow->quantity ?>" />

			<button type="submit" class="btn btn-default" name="updatecart.<?php echo $pkey ?>" title="<?php echo  vmText::_ ('COM_VIRTUEMART_CART_UPDATE') ?>" ><i class="fa fa-refresh"></i></button>

			<button type="submit" class="btn btn-default" name="delete.<?php echo $pkey ?>" title="<?php echo vmText::_ ('COM_VIRTUEMART_CART_DELETE') ?>" ><i class="fa fa-trash"></i></button>
	</td>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td class="vm-cart-item-tax" ><?php echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('taxAmount', '', $prow->prices, FALSE, FALSE, $prow->quantity, false, true) . "</span>" ?></td>
	<?php } ?>
	<td class="vm-cart-item-discount" ><?php echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('discountAmount', '', $prow->prices, FALSE, FALSE, $prow->quantity, false, true) . "</span>" ?></td>
	<td class="vm-cart-item-total" align="right">
		<?php //vmdebug('hm',$prow->prices,$this->cart->cartPrices[$pkey]);
		if (VmConfig::get ('checkout_show_origprice', 1) && !empty($prow->prices['basePriceWithTax']) && $prow->prices['basePriceWithTax'] != $prow->prices['salesPrice']) {
			echo '<div class="price-crosses">' . $this->currencyDisplay->createPriceDiv ('basePriceWithTax', '', $prow->prices, TRUE, FALSE, $prow->quantity) . '</div>';
		}
		elseif (VmConfig::get ('checkout_show_origprice', 1) && empty($prow->prices['basePriceWithTax']) && !empty($prow->prices['basePriceVariant']) && $prow->prices['basePriceVariant'] != $prow->prices['salesPrice']) {
			echo '<div class="price-crossed">' . $this->currencyDisplay->createPriceDiv ('basePriceVariant', '', $prow->prices, TRUE, FALSE, $prow->quantity) . '</div>';
		}
		echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $prow->prices, FALSE, FALSE, $prow->quantity) ?></td>
</tr>
	<?php
	$i = ($i==1) ? 2 : 1;
} ?>
<!--Begin of SubTotal, Tax, Shipment, Coupon Discount and Total listing -->
<?php if (VmConfig::get ('show_tax')) {
	$colspan = 3;
} else {
	$colspan = 2;
} ?>

<tr class="sectiontableentry1">
	<td colspan="4" align="right"><strong><?php echo vmText::_ ('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></strong></td>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"><?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('taxAmount', '', $this->cart->cartPrices, FALSE, false, true) . "</span>" ?></td>
	<?php } ?>
	<td><?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('discountAmount', '', $this->cart->cartPrices, FALSE) . "</span>" ?></td>
	<td align="right"><strong><?php echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $this->cart->cartPrices, FALSE) ?></strong></td>
</tr>

<?php
if (VmConfig::get ('coupons_enable')) {
	?>
	<?php if (VmConfig::get ('show_tax')) {
		$colspan = 3;
	} else {
		$colspan = 2;
	} ?>
<tr class="sectiontableentry2">
	<td colspan="4" align="left">
		<?php if (!empty($this->layoutName) && $this->layoutName == 'default') {
		echo $this->loadTemplate ('coupon');
		} ?>

		<?php if (!empty($this->cart->cartData['couponCode'])) { ?>
		<?php
		echo $this->cart->cartData['couponCode'];
		echo $this->cart->cartData['couponDescr'] ? (' (' . $this->cart->cartData['couponDescr'] . ')') : '';
		?>
	</td>

		<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ('couponTax', '', $this->cart->cartPrices['couponTax'], FALSE); ?> </td>
		<?php } ?>
	<td align="right"> </td>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ('salesPriceCoupon', '', $this->cart->cartPrices['salesPriceCoupon'], FALSE); ?> </td>
	<?php } else { ?>

	&nbsp;</td>
	<td colspan="<?php echo $colspan ?>" align="left">&nbsp;</td>
	<?php }	?>
</tr>
<?php } ?>
<?php
foreach ($this->cart->cartData['DBTaxRulesBill'] as $rule) {
	?>
<tr class="sectiontableentry<?php echo $i ?>">
	<td colspan="4" align="right"><?php echo $rule['calc_name'] ?> </td>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"></td>
	<?php } ?>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?></td>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> </td>
</tr>
	<?php
	if ($i) {
		$i = 1;
	} else {
		$i = 0;
	}
} ?>

<?php

foreach ($this->cart->cartData['taxRulesBill'] as $rule) {
	if($rule['calc_value_mathop']=='avalara') continue;
	?>
<tr class="sectiontableentry<?php echo $i ?>">
	<td colspan="4" align="right"><?php echo $rule['calc_name'] ?> </td>
	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> </td>
	<?php } ?>
	<td align="right"><?php ?> </td>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> </td>
</tr>
	<?php
	if ($i) {
		$i = 1;
	} else {
		$i = 0;
	}
}

foreach ($this->cart->cartData['DATaxRulesBill'] as $rule) {
	?>
<tr class="sectiontableentry<?php echo $i ?>">
	<td colspan="4" align="right"><?php echo   $rule['calc_name'] ?> </td>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"></td>

	<?php } ?>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?>  </td>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ($rule['virtuemart_calc_id'] . 'Diff', '', $this->cart->cartPrices[$rule['virtuemart_calc_id'] . 'Diff'], FALSE); ?> </td>
</tr>
	<?php
	if ($i) {
		$i = 1;
	} else {
		$i = 0;
	}
}

// ADDRESS
if ( 	VmConfig::get('oncheckout_opc',true) or
	!VmConfig::get('oncheckout_show_steps',false) or
	(!VmConfig::get('oncheckout_opc',true) and VmConfig::get('oncheckout_show_steps',false) and
		!empty($this->cart->BT['address_1']))
) { 
	$addr_type = $this->cart->STsameAsBT == 1 ? "BT" : "ST";
?>
<tr class="sectiontableentry1" style="vertical-align:top;">
	<td colspan="6" style="align:left;vertical-align:top;">
		<?php
			echo '<h3>'.vmText::_ ('COM_VIRTUEMART_USER_FORM_SHIPTO_LBL').'</h3>';
			echo $this->cart->{$addr_type}['first_name'] .' '. $this->cart->{$addr_type}['last_name'] .'<br/>';
			echo !empty($this->cart->{$addr_type}['company']) ? $this->cart->{$addr_type}['company'] .'<br/>' : "";
			echo $this->cart->{$addr_type}['address_1'] .', '. $this->cart->{$addr_type}['city'] .' '. $this->cart->{$addr_type}['zip'] .'<br/>';
			echo shopfunctions::getCountryByID($this->cart->{$addr_type}['virtuemart_country_id']) . "<br/>";
			echo !empty($this->cart->{$addr_type}['phone_2']) ? $this->cart->{$addr_type}['phone_2'] . "<br/>" : "";

	if (!empty($this->layoutName) and $this->layoutName == 'default') {
		echo JHtml::_('link', JRoute::_(JURI::base() . "kosik/index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=BT", $this->useXHTML, $this->useSSL), 'Změnit adresu', 'class="link-shipment"');
	} else {
		echo vmText::_ ('COM_VIRTUEMART_USER_FORM_SHIPTO_LBL');
	} ?>
	</td>
</tr>
<?php } ?>

<?php if ( 	VmConfig::get('oncheckout_opc',true) or
	!VmConfig::get('oncheckout_show_steps',false) or
	(!VmConfig::get('oncheckout_opc',true) and VmConfig::get('oncheckout_show_steps',false) and
		!empty($this->cart->virtuemart_shipmentmethod_id) )
) { ?>
<tr class="sectiontableentry1" style="vertical-align:top;">
	<?php if (!$this->cart->automaticSelectedShipment) { ?>
		<td colspan="4" style="align:left;vertical-align:top;">
			<?php
				echo '<h3>'.vmText::_ ('COM_VIRTUEMART_CART_SELECTED_SHIPMENT').'</h3>';
				echo $this->cart->cartData['shipmentName'].'<br/>';

		if (!empty($this->layoutName) and $this->layoutName == 'default') {
			if (VmConfig::get('oncheckout_opc', 0)) {
				$previouslayout = $this->setLayout('select');
				echo $this->loadTemplate('shipment');
				$this->setLayout($previouslayout);
			} else {
				echo JHtml::_('link', JRoute::_('index.php?option=com_virtuemart&view=cart&task=edit_shipment', $this->useXHTML, $this->useSSL), $this->select_shipment_text, 'class="link-shipment"');
			}
		} else {
			echo vmText::_ ('COM_VIRTUEMART_CART_SHIPPING');
		}
		echo '</td>';
	} else {
	?>
	<td colspan="4" style="align:left;vertical-align:top;">
		<?php echo '<h4>'.vmText::_ ('COM_VIRTUEMART_CART_SELECTED_SHIPMENT').'</h4>'; ?>
		<?php echo $this->cart->cartData['shipmentName'];
		echo '<span class="floatright">' . $this->currencyDisplay->createPriceDiv ('shipmentValue', '', $this->cart->cartPrices['shipmentValue'], FALSE) . '</span>';
		?>
	</td>
	<?php } ?>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"><?php

	echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('shipmentTax', '', $this->cart->cartPrices['shipmentTax'], FALSE) . "</span>"; ?> </td>
	<?php } ?>
	<td align="right"><?php if($this->cart->cartPrices['salesPriceShipment'] < 0) echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->cartPrices['salesPriceShipment'], FALSE); ?></td>
	<td align="right"><?php echo $this->currencyDisplay->createPriceDiv ('salesPriceShipment', '', $this->cart->cartPrices['salesPriceShipment'], FALSE); ?> </td>
</tr>
<?php } ?>
<?php if ($this->cart->pricesUnformatted['salesPrice']>0.0 and
	( 	VmConfig::get('oncheckout_opc',true) or
		!VmConfig::get('oncheckout_show_steps',false) or
		( (!VmConfig::get('oncheckout_opc',true) and VmConfig::get('oncheckout_show_steps',false) ) and !empty($this->cart->virtuemart_paymentmethod_id))
	)
) { ?>
<tr class="sectiontableentry1" style="vertical-align:top;">
	<?php if (!$this->cart->automaticSelectedPayment) { ?>
		<td colspan="4" style="align:left;vertical-align:top;">
			<?php
				echo '<h3>'.vmText::_ ('COM_VIRTUEMART_CART_SELECTED_PAYMENT').'</h3>';
				echo $this->cart->cartData['paymentName'].'<br/>';

		if (!empty($this->layoutName) && $this->layoutName == 'default') {
			if (VmConfig::get('oncheckout_opc', 0)) {
				$previouslayout = $this->setLayout('select');
				echo $this->loadTemplate('payment');
				$this->setLayout($previouslayout);
			} else {
				echo JHtml::_('link', JRoute::_('index.php?option=com_virtuemart&view=cart&task=editpayment', $this->useXHTML, $this->useSSL), $this->select_payment_text, 'class="link-payment"');
			}
		} else {
		echo vmText::_ ('COM_VIRTUEMART_CART_PAYMENT');
	} ?> </td>

	<?php } else { ?>
		<td colspan="4" style="align:left;vertical-align:top;" >
			<?php echo '<h4>'.vmText::_ ('COM_VIRTUEMART_CART_SELECTED_PAYMENT').'</h4>'; ?>
			<?php echo $this->cart->cartData['paymentName']; ?> </td>
	<?php } ?>
	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"><?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('paymentTax', '', $this->cart->cartPrices['paymentTax'], FALSE) . "</span>"; ?> </td>
	<?php } ?>
	<td align="right" ><?php if($this->cart->cartPrices['salesPricePayment'] < 0) echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->cartPrices['salesPricePayment'], FALSE); ?></td>
	<td align="right" ><?php  echo $this->currencyDisplay->createPriceDiv ('salesPricePayment', '', $this->cart->cartPrices['salesPricePayment'], FALSE); ?> </td>
</tr>
<?php  } ?>

<tr class="sectiontableentry2 total-price">
	<td colspan="4" align="right"><strong><?php echo vmText::_ ('COM_VIRTUEMART_CART_TOTAL') ?>:</strong></td>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"> <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('billTaxAmount', '', $this->cart->cartPrices['billTaxAmount'], FALSE) . "</span>" ?> </td>
	<?php } ?>
	<td> <?php echo "<span  class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('billDiscountAmount', '', $this->cart->cartPrices['billDiscountAmount'], FALSE) . "</span>" ?> </td>
	<td align="right"><strong><?php echo $this->currencyDisplay->createPriceDiv ('billTotal', '', $this->cart->cartPrices['billTotal'], FALSE); ?></strong></td>
</tr>
<?php
if ($this->totalInPaymentCurrency) {
?>

<tr class="sectiontableentry2">
	<td colspan="4" align="right"><?php echo vmText::_ ('COM_VIRTUEMART_CART_TOTAL_PAYMENT') ?>:</td>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"></td>
	<?php } ?>
	<td align="right"></td>
	<td align="right"><strong><?php echo $this->totalInPaymentCurrency;   ?></strong></td>
</tr>
	<?php
}

//Show VAT tax seperated
if(!empty($this->cart->cartData)){
	if(!empty($this->cart->cartData['VatTax'])){
		$c = count($this->cart->cartData['VatTax']);
		if (!VmConfig::get ('show_tax') or $c>1) {
			if($c>0){
				?><tr class="sectiontableentry2">
				<td colspan="5" align="right"><?php echo vmText::_ ('COM_VIRTUEMART_TOTAL_INCL_TAX') ?></td>

				<?php if (VmConfig::get ('show_tax')) { ?>
					<td ></td>
				<?php } ?>
				<td></td>
				</tr><?php
			}
			foreach( $this->cart->cartData['VatTax'] as $vatTax ) {
				if(!empty($vatTax['result'])) {
					echo '<tr class="sectiontableentry'.$i.'">';
					echo '<td colspan="4" align="right">'.shopFunctionsF::getTaxNameWithValue($vatTax['calc_name'],$vatTax['calc_value']). '</td>';
					echo '<td align="right"><span class="priceColor2">'.$this->currencyDisplay->createPriceDiv( 'taxAmount', '', $vatTax['result'], FALSE, false, 1.0,false,true ).'</span></td>';
					echo '<td></td><td></td>';
					echo '</tr>';
				}
			}
		}
	}
}
?>

</table>
</div>
</fieldset>
