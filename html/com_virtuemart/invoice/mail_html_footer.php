<?php
/**
*
* Layout for the shopping cart, look in mailshopper for more details
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
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
/* TODO Chnage the footer place in helper or assets ???*/
if (empty($this->vendor)) {
    $vendorModel = VmModel::getModel('vendor');
    $this->vendor = $vendorModel->getVendor();
}

$link = JURI::root();

echo "<p>" . vmText::_('COM_VIRTUEMART_MAIL_FOOTER' ) . '<a href="'.$link.'">'.$this->vendor->vendor_store_name.'</a></p>';

if ($this->orderDetails['details']['BT']->order_status === "S") {
    #heureka mesage
    echo "<p>Těší nás, že jste si pro nákup vybrali náš eshop. Budeme velice rádi pokud nám napíšete kladné hodnocení na serveru Heureka.cz. Hlavní prioritou našeho eshopu je prozákaznický přístup. Pokud jste s čímkoliv nespokojeni, kontaktujte nejprve prosím nás. Pokud je to možné, snažíme se vyjít vstříc i mimo zákonné požadavky na záruční lhůty kladené na eshopy. Jakýkoli spor bude vyřešen k oboustranné spokojenosti. Pokud jste nebyli s nákupem spokojeni, nehodnoťte prosím bez předchozí komunikace s námi na serveru Heureka.cz. Děkujeme za pochopení!</p>";
}