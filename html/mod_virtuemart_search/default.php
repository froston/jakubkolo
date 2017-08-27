<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<!--BEGIN Search Box -->
<form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=category&search=true&limitstart=0&virtuemart_category_id='.$category_id ); ?>" method="get" class="search-form">
    <?php $output = '<input name="keyword" id="mod_virtuemart_search" maxlength="'.$maxlength.'" class="inputbox'.$moduleclass_sfx.' search-input" type="text" size="'.$width.'" placeholder="'.$text.'"  onblur="if(this.value==\'\') this.value=\''.$text.'\';" onfocus="if(this.value==\''.$text.'\') this.value=\'\';" />';
        echo $output;
    ?>
    <input type="hidden" name="limitstart" value="0" />
    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="category" />
    <input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
<?php if(!empty($set_Itemid)){
	echo '<input type="hidden" name="Itemid" value="'.$set_Itemid.'" />';
} ?>
</form>

<!-- End Search Box -->