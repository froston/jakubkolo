<?php
/**
 *
 * Layout for the order email
 * shows the chosen adresses of the shopper
 * taken from the stored order
 *
 * @package	VirtueMart
 * @subpackage Order
 * @author Max Milbers,   Valerie Isaksen
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
?>
<table class="html-email" cellspacing="0" cellpadding="0" border="0" width="100%" style="border:solid #dad8d8 1px;margin: 10px auto;">  
    <tr  >
	<th width="50%" style="text-align: left;background: #ddd none repeat scroll 0 0;margin: 0;padding: 10px;">
	    <strong><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_BILLTO_LBL'); ?></strong>
	</th>
	<th width="50%" style="text-align: left;background: #ddd none repeat scroll 0 0;margin: 0;padding: 10px;">
	    <strong><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_SHIPTO_LBL'); ?></strong>
	</th>
    </tr>
    <tr>
	<td valign="top" width="50%" style="padding: 10px;">

	    <?php

	    foreach ($this->userfields['fields'] as $field) {
		if (!empty($field['value'])) { ?>
	    	    <span class="values vm2<?php echo '-' . $field['name'] ?>" ><?php echo $field['value'] ?></span>
			<?php if ($field['name'] != 'title' and $field['name'] != 'first_name' and $field['name'] != 'middle_name' and $field['name'] != 'zip') { ?>
			    <br class="clear" />
			    <?php
			}
		    }
		 
	    }
	    ?>

	</td>
	<td valign="top" width="50%" style="padding: 10px;">
	    <?php
	    foreach ($this->shipmentfields['fields'] as $field) {

		if (!empty($field['value'])) { ?>
			    <span class="values vm2<?php echo '-' . $field['name'] ?>" ><?php echo $field['value'] ?></span>
			    <?php if ($field['name'] != 'title' and $field['name'] != 'first_name' and $field['name'] != 'middle_name' and $field['name'] != 'zip') { ?>
		    	    <br class="clear" />
				<?php
			    }
			}
	    }

	    ?>
	</td>
    </tr>
</table>
