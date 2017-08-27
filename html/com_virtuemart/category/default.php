<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9288 2016-09-12 15:20:56Z Milbo $
 */

defined ('_JEXEC') or die('Restricted access');

if(vRequest::getInt('dynamic')){
	if (!empty($this->products)) {
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

		echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	}

	return ;
}

if (empty($this->keyword) and !empty($this->category)) { ?>
    <div class="category-view-header">
        <?php if (!(empty($this->category->category_name))) { ?>
            <h1><?php echo vmText::_($this->category->category_name); ?></h1>
        <?php } ?>
        <div class="category_description">
                <?php echo $this->category->category_description; ?>
        </div>
    </div>
<?php } ?> 
    
<div class="category-view col-md-10"> <?php
$js = "
jQuery(document).ready(function () {
	jQuery('.orderlistcontainer').hover(
		function() { jQuery(this).find('.orderlist').stop().show()},
		function() { jQuery(this).find('.orderlist').stop().hide()}
	)
});
";
vmJsApi::addJScript('vm.hover',$js);

// Show child categories
if ($this->showcategory and empty($this->keyword)) {
	if (!empty($this->category->haschildren)) { ?>
            <div class="row">
		<?php echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=>$this->category->children));?>
            </div>
        <?php }
}

if($this->showproducts){
?>
<div class="browse-view">
        <div class="row">
            <?php if(!empty($this->orderByList)) { ?>
                <div class="orderby-displaynumber vm-order-list">
                        <?php echo $this->orderByList['orderby']; ?>
                        <div class="clearfix"></div>
                </div>
            <?php } ?>

            <?php if ($this->showsearch or !empty($this->keyword)) {
                //id taken in the view.html.php could be modified
                $category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>
                <div class="virtuemart_search">
                    <form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0', FALSE); ?>" method="get">
                        <?php if(!empty($this->searchCustomList)) { ?>
                        <div class="vm-search-custom-list"><?php echo $this->searchCustomList ?></div>
                        <?php } ?>
                        <?php if(!empty($this->searchCustomValues)) { ?>
                        <div class="vm-search-custom-values"><?php echo $this->searchCustomValues ?></div>
                        <?php } ?>
                        <div class="vm-search-custom-search-input">
                            <input name="keyword" class="keyword-input" type="text" size="25" value="<?php echo $this->keyword ?>"/>
                            <input type="submit" value="<?php echo "&#xf002;"; ?>" class="search-input" onclick="this.form.keyword.focus();"/>
                        </div>
                        <input type="hidden" name="view" value="category"/>
                        <input type="hidden" name="option" value="com_virtuemart"/>
                        <input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
                        <input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>"/>
                    </form>
                    <div class="clearfix"></div>
                </div>
            <?php
                $j = 'jQuery(document).ready(function() {
                jQuery(".changeSendForm")
                        .off("change",Virtuemart.sendCurrForm)
                    .on("change",Virtuemart.sendCurrForm);
                })';
                vmJsApi::addJScript('sendFormChange',$j);
            } ?>
            <div class="clearfix"></div>
        </div>
    
        <hr>

	<?php
	if (!empty($this->products)) {
		//revert of the fallback in the view.html.php, will be removed vm3.2
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

                echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

                if(!empty($this->orderByList)) { ?>
                        <div class="vm-pagination vm-pagination-bottom">
                            <?php echo $this->vmPagination->getPagesLinks (); ?>
                        </div>
                        <div class="vm-page-counter"><?php echo $this->vmPagination->getPagesCounter (); ?></div>
                        <div class="clearfix"></div>
                <?php }
        } elseif (!empty($this->keyword)) {
                echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
        }
        ?>
</div>

<?php } ?>

</div>

<?php
if(VmConfig::get ('jdynupdate', TRUE)){
	$j = "Virtuemart.container = jQuery('.category-view');
	Virtuemart.containerSelector = '.category-view';";

	//vmJsApi::addJScript('ajaxContent',$j);
}
?>
<!-- end browse-view -->