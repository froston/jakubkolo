<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz, Max Galt
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9292 2016-09-19 08:07:15Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/* Let's see if we found the product */
if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));



if(vRequest::getInt('print',false)){ ?>
<body onload="javascript:print();">
<?php } ?>

<div class="product-details col-md-10" >

	<?php
	if ($this->product->virtuemart_category_id) {
		$catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
		$categoryName = vmText::_($this->product->category_name) ;
	} else {
		$catURL =  JRoute::_('index.php?option=com_virtuemart');
		$categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
	}
	?>

        <?php // Product Title   ?>
        <h1 itemprop="name"><?php echo $this->product->product_name ?></h1>
        <?php // Product Title END   ?>

        <?php // afterDisplayTitle Event
        echo $this->product->event->afterDisplayTitle ?>

        <?php
        // PDF - Print - Email Icon
        if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon')) {
            ?>
            <div class="icons">
                <?php

                $link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;

                    echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_icon', false);
                //echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
                    echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon',false,true,false,'class="printModal"');
                    $MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';
                echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend', false,true,false,'class="recommened-to-friend"');
                ?>
            <div class="clear"></div>
            </div>
        <?php } // PDF - Print - Email Icon END
        ?>

        <?php
        // Product Short Description
        if (!empty($this->product->product_s_desc)) {
            ?>
            <div class="product-short-description">
                <?php
                /** @todo Test if content plugins modify the product description */
                echo nl2br($this->product->product_s_desc);
                ?>
            </div>
            <?php
        } // Product Short Description END
        
            //rating
            echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$this->showRating,'product'=>$this->product, 'small' => false));

            //custom fields
            echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'ontop'));
        ?>

        <div class="vm-product-container">
            <div class="vm-product-media-container">
    <?php
    echo $this->loadTemplate('images');
    ?>
            </div>

            <div class="vm-product-details-container">
                <div class="spacer-buy-area">
                    <h3>Cena produktu</h3>
                    <?php
                    //In case you are not happy using everywhere the same price display fromat, just create your own layout
                    //in override /html/fields and use as first parameter the name of your file
                    echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$this->product,'currency'=>$this->currency));
                    ?> 
                    <div class="clear"></div><hr>

                    <?php echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product)); ?>
                    <hr>

                </div>
            </div>
            <div class="clear"></div>


        </div>
    <?php
            $count_images = count ($this->product->images);
            if ($count_images > 1) {
                    echo "<h3>Další obrázky</h3>";  
                    echo $this->loadTemplate('images_additional');
            }

            // event onContentBeforeDisplay
            echo $this->product->event->beforeDisplayContent; ?>

            <?php
            //echo ($this->product->product_in_stock - $this->product->product_ordered);
            // Product Description
            if (!empty($this->product->product_desc)) {
                ?>
            <div class="product-description" >
            <?php /** @todo Test if content plugins modify the product description */ ?>
            <h3 class="title"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></h3>
                <?php echo $this->product->product_desc; ?>
            </div>
            <?php
        } // Product Description END

            echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'normal'));

        // Product Packaging
        $product_packaging = '';
        if ($this->product->product_box) {
            ?>
            <div class="product-box">
                <?php
                    echo vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;
                ?>
            </div>
        <?php } // Product Packaging END ?>

        <?php 
            echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));

            echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));

            echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));

            ?>
        
            <hr>

    <?php // onContentAfterDisplay event
    echo $this->product->event->afterDisplayContent;
    
    //assign
    $this->catURL = $catURL;
    $this->categoryName = $categoryName;

    echo $this->loadTemplate('reviews');

    $j = 'jQuery(document).ready(function($) {
            $("form.js-recalculate").each(function(){
                    if ($(this).find(".product-fields").length && !$(this).find(".no-vm-bind").length) {
                            var id= $(this).find(\'input[name="virtuemart_product_id[]"]\').val();
                            Virtuemart.setproducttype($(this),id);

                    }
            });
    });';
    //vmJsApi::addJScript('recalcReady',$j);

    if(VmConfig::get ('jdynupdate', TRUE)){

            /** GALT
             * Notice for Template Developers!
             * Templates must set a Virtuemart.container variable as it takes part in
             * dynamic content update.
             * This variable points to a topmost element that holds other content.
             */
            $j = "Virtuemart.container = jQuery('.productdetails-view');
    Virtuemart.containerSelector = '.productdetails-view';
    //Virtuemart.recalculate = true;	//Activate this line to recalculate your product after ajax
    ";

            vmJsApi::addJScript('ajaxContent',$j);

            $j = "jQuery(document).ready(function($) {
            Virtuemart.stopVmLoading();
            var msg = '';
            $('a[data-dynamic-update=\"1\"]').off('click', Virtuemart.startVmLoading).on('click', {msg:msg}, Virtuemart.startVmLoading);
            $('[data-dynamic-update=\"1\"]').off('change', Virtuemart.startVmLoading).on('change', {msg:msg}, Virtuemart.startVmLoading);
    });";

            vmJsApi::addJScript('vmPreloader',$j);
    }

    echo vmJsApi::writeJS();

    if ($this->product->prices['salesPrice'] > 0) {
       echo shopFunctionsF::renderVmSubLayout('snippets',array('product'=>$this->product, 'currency'=>$this->currency, 'showRating'=>$this->showRating));
    }

    ?>
</div>



