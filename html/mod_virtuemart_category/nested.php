<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<ul class="menu<?php echo $class_sfx ?> parent" >
<?php foreach ($categories as $category) {
		$active_menu = '';
		$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$category->virtuemart_category_id);
		$cattext = $category->category_name;
    if (in_array( $category->virtuemart_category_id, $parentCategories)) {
      $active_menu = 'class="active"';
    } ?>

<li <?php echo $active_menu ?>>
        <?php echo $category->childs ? "<i class='fa fa-arrow-circle-right arrow'></i>" : ""; ?>
        <?php echo JHTML::link($caturl, $cattext); ?>
<?php if ($category->childs ) {


?>
<ul class="menu<?php echo $class_sfx; ?> child">
<?php
	foreach ($category->childs as $child) {
    $active_menu = '';
		$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$child->virtuemart_category_id);
    $cattext = vmText::_($child->category_name);
    if (in_array( $child->virtuemart_category_id, $parentCategories)) {
      $active_menu = 'class="active"';
    }
		?>
<li <?php echo $active_menu ?>>
  <?php echo $child->childs ? "<i class='fa fa-arrow-circle-right arrow'></i>" : ""; ?>
  <?php echo JHTML::link($caturl, $cattext); ?>
  
    <?php if ($child->childs ) { ?>
    
    <ul class="menu<?php echo $class_sfx; ?> baby">
    <?php
      foreach ($child->childs as $baby) {
        $active_menu = '';
        $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$baby->virtuemart_category_id);
        $cattext = vmText::_($baby->category_name);
        if ($active_category_id == $baby->virtuemart_category_id) {
          $active_menu = 'class="active"';
        }
        ?>
    <li <?php echo $active_menu ?>>
      <?php echo JHTML::link($caturl, $cattext); ?>
    </li>
    <?php } ?>
    </ul>
    <?php 	} ?>

</li>
<?php } ?>
</ul>
<?php 	} ?>
</li>
<?php
	} ?>
</ul>
