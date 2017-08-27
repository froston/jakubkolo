<?php
/**
 *
 * Order detail view
 * //index.php?option=com_virtuemart&view=invoice&layout=invoice&format=pdf&tmpl=component&order_number=xx&order_pass=p_yy
 * @package    VirtueMart
 * @subpackage Orders
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: details.php 5412 2012-02-09 19:27:55Z alatak $
 */

defined('_JEXEC') or die('Restricted access');
JHtml::stylesheet('vmpanels.css', JURI::root() . 'components/com_virtuemart/assets/css/');
if ($this->_layout == "invoice") {
	$document = JFactory::getDocument();
	$document->setTitle(vmText::_('COM_VIRTUEMART_ORDER_PRINT_PO_NUMBER') . ' ' . $this->orderDetails['details']['BT']->order_number . ' ' . $this->vendor->vendor_store_name);
}

$vendorCompanyName = (!empty($this->vendor->vendorFields["fields"]["company"]["value"])) ? $this->vendor->vendorFields["fields"]["company"]["value"] : $this->vendor->vendor_store_name;

if(!empty($this->vendor->vendor_letter_css)) { ?>
	<style type="text/css">
		<?php echo $this->vendor->vendor_letter_css; ?>
	</style>
<?php }

if ($this->print) { ?>
<body onload="javascript:print();">
<?php }
    
    if (!empty($this->vendor->images)) { ?>
        <div class='spaceStyle'>
            <?php $img = $this->vendor->images[0]; ?>
            <div class="vendor-image" style="text-align: center;"><img src="<?php echo JURI::root() . $img->file_url?>" alt="Logo"></div>
            <hr style="margin: 20px 0;">
            <br>
        </div>
    <?php } ?>

    <div class='spaceStyle'>
        <?php echo $this->loadTemplate('order'); ?>
    </div>
    <hr style="margin: 20px 0;">
    <div class='spaceStyle'>
        <br>
        <?php echo $this->loadTemplate('items');?>
    </div>
    <br clear="all">
<?php if ($this->print) { ?>
</body>
<?php
} ?>




