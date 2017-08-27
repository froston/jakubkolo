<?php
/**
*
* Modify user form view
*
* @package	VirtueMart
* @subpackage User
* @author Oscar van Eijk
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit.php 9272 2016-08-29 11:39:18Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Implement Joomla's form validation
JHtml::_('behavior.formvalidation');
JHtml::stylesheet('vmpanels.css', JURI::root().'components/com_virtuemart/assets/css/'); // VM_THEMEURL
?>

<?php
$url = vmURI::getCleanUrl();
$cancelUrl = $url.'?task=cancel';
if(!JFactory::getConfig()->get('sef',0)){
	$cancelUrl = $url.'&task=cancel';
}
?>

<div class="profile-edit col-md-6 col-md-offset-3 <?php echo $this->pageclass_sfx?>">

    <h1><?php echo ($this->address_type == "ST" ? vmText::_("COM_VIRTUEMART_USER_FORM_SHIPTO_LBL") : $this->page_title); ?></h1>
    
    <form method="post" id="adminForm" name="userForm" action="<?php echo $url ?>" class="form-validate">
	
        <?php // Loading Templates in Tabs

        $tabarray = array();

        $tabarray['shopper'] = 'COM_VIRTUEMART_SHOPPER_FORM_LBL';

        if (!empty($this->shipto)) {
                $tabarray['shipto'] = 'COM_VIRTUEMART_USER_FORM_ADD_SHIPTO_LBL';
        }
        if (($_ordcnt = count($this->orderlist)) > 0 and $this->address_type != "ST") {
                $tabarray['orderlist'] = 'COM_VIRTUEMART_YOUR_ORDERS';
        }

        shopFunctionsF::buildTabs ( $this, $tabarray);
        ?>

        <input type="hidden" name="option" value="com_virtuemart" />
        <input type="hidden" name="controller" value="user" />
        <?php echo JHtml::_( 'form.token' ); ?>
    </form>
</div>
