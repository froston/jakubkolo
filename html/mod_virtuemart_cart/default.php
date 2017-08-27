<?php // no direct access
defined('_JEXEC') or die('Restricted access');

//dump ($cart,'mod cart');
// Ajax is displayed in vm_cart_products
// ALL THE DISPLAY IS Done by Ajax using "hiddencontainer" ?>

<!-- Virtuemart 2 Ajax Card -->
<div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>" id="vmCartModule<?php echo $params->get('moduleid_sfx'); ?>">
    <?php if ($show_product_list) { ?>
        <div class="hiddencontainer" style=" display: none; ">
                <div class="vmcontainer">
                        <div class="product_row">
                                <span class="quantity"></span>&nbsp;x&nbsp;<span class="product_name"></span>

                        <?php if ($show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
                                <div class="subtotal_with_tax" style="float: right;"></div>
                        <?php } ?>
                        <div class="customProductData"></div><br>
                        </div>
                </div>
        </div>
    <?php } ?>
    
    <a class="cart-count" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart'); ?>">
        <span class="bag-count"><?php echo  $data->totalProduct ?></span>
        <span class="bag-text">POLOŽEK</span>
    </a>
    
    <div class="clearfix"></div>

    <noscript>
        <?php echo vmText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
    </noscript>

</div>

