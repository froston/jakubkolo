<?php
/**
 *
 * Template for the shipment selection
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
 * @version $Id: cart.php 2400 2010-05-11 19:30:47Z milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$step = $viewData['step'];

//set classes according to step number
switch ($step) {
    case 1: 
        $class1 = "class='current'"; 
        // ok je to prasarna .. ale porad mensi prasarna nez virtuemart ;)
        $link1 = JRoute::_(JURI::base() . "kosik/index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=BT");
        break;
    case 2: 
        $class1 = "class='visited'"; 
        $class2 = "class='current'";
        $link1 = JRoute::_(JURI::base() . "kosik/index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=BT");
        $link2 = JRoute::_("index.php?option=com_virtuemart&view=cart&task=edit_shipment");
        break;
    case 3: 
        $class1 = "class='visited'"; 
        $class2 = "class='visited'"; 
        $class3 = "class='current'"; 
        $link1 = JRoute::_(JURI::base() . "kosik/index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=BT");
        $link2 = JRoute::_("index.php?option=com_virtuemart&view=cart&task=edit_shipment");
        $link3 = JRoute::_("index.php?option=com_virtuemart&view=cart&task=edit_payment");
        break;
    case 4: 
        $class1 = "class='visited'"; 
        $class2 = "class='visited'"; 
        $class3 = "class='visited'"; 
        $class4 = "class='current'"; 
        $link1 = JRoute::_(JURI::base() . "kosik/index.php?option=com_virtuemart&view=user&task=editaddresscart&addrtype=BT");
        $link2 = JRoute::_("index.php?option=com_virtuemart&view=cart&task=edit_shipment");
        $link3 = JRoute::_("index.php?option=com_virtuemart&view=cart&task=edit_payment");
        break;
}
?>

<nav>
    <ol class="cd-multi-steps text-bottom count">
        <li <?php echo (!empty($class1) ? $class1 : "") ?>>
            <?php if (!empty($link1)) { ?>
                <a href="<?php echo $link1; ?>">Adresa</a>
            <?php }else { ?>
                <em>Adresa</em>
            <?php } ?>
        </li>
        <li <?php echo (!empty($class2) ? $class2 : "") ?>>
            <?php if (!empty($link2)) { ?>
                <a href="<?php echo $link2; ?>">Doprava</a>
            <?php }else { ?>
                <em>Doprava</em>
            <?php } ?>
        </li>
        <li <?php echo (!empty($class3) ? $class3 : "") ?>>
            <?php if (!empty($link3)) { ?>
                <a href="<?php echo $link3; ?>">Platba</a>
            <?php }else { ?>
                <em>Platba</em>
            <?php } ?>
        </li>
        <li <?php echo (!empty($class4) ? $class4 : "") ?>>
            <em>Potvrzení</em>
        </li>
    </ol>
</nav>