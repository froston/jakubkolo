<?php // no direct access
defined('_JEXEC') or die('Restricted access');
//JHTML::stylesheet ( 'menucss.css', 'modules/mod_virtuemart_category/css/', false );

/* ID for jQuery dropdown */
$ID = str_replace('.', '_', substr(microtime(true), -8, 8));
$js="
//<![CDATA[
jQuery(document).ready(function() {
		jQuery('#VMmenu".$ID." li.VmClose ul').hide();
		jQuery('#VMmenu".$ID." li .VmArrowdown').click(
		function() {

			if (jQuery(this).parent().next('ul').is(':hidden')) {
				jQuery('#VMmenu".$ID." ul:visible').delay(500).slideUp(500,'linear').parents('li').addClass('VmClose').removeClass('VmOpen');
				jQuery(this).parent().next('ul').slideDown(500,'linear');
				jQuery(this).parents('li').addClass('VmOpen').removeClass('VmClose');
			}
		});
	});
//]]>
" ;

		$document = JFactory::getDocument();
		$document->addScriptDeclaration($js);?>

<ul class="nav VMmenu<?php echo $class_sfx ?>" id="<?php echo "VMmenu".$ID ?>" >
<?php foreach ($categories as $category) {
		 $active_menu = 'class="VmClose"';
		$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$category->virtuemart_category_id);
		$cattext = $category->category_name;
		//if ($active_category_id == $category->virtuemart_category_id) $active_menu = 'class="active"';
		if (in_array( $category->virtuemart_category_id, $parentCategories)) $active_menu = 'class="VmOpen"';

		?>

<li <?php echo $active_menu ?>>
            <?php echo JHTML::link($caturl, $cattext);
            if ($category->childs) {
                    ?>
                    <span class="VmArrowdown"> </span>
                    <?php
            }
            ?>
<?php if (!empty($category->childs)) { ?>
<ul class="nav menu<?php echo $class_sfx; ?>">
<?php
		foreach ($category->childs as $child) {

		$active_child_menu = 'class="VmClose"';
		$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$child->virtuemart_category_id);
		$cattext = vmText::_($child->category_name);
		if ($child->virtuemart_category_id == $active_category_id) $active_child_menu = 'class="VmOpen"';
		?>
		<li <?php echo $active_child_menu ?>>
<li>
	<?php echo JHTML::link($caturl, $cattext); ?>
</li>
<?php		} ?>
</ul>
<?php 	} ?>
</li>
<?php
	} ?>
</ul>
