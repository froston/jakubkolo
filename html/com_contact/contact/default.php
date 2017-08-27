<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams('com_media');

jimport('joomla.html.html.bootstrap');
?>
<div class="contact col-md-6 col-md-offset-3">
        
        <h1>Kontaktujte nás přes formulář</h1>
        <p>Telefon: +420 775 311 151 <br> Email: jakubkolo@jakubkolo.cz <br> Zpětná adresa: Jakubkolo.cz Karlovice 327 76843 Kostelec u Holešova</p>
        
        <hr>

	<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<?php  echo $this->loadTemplate('form');  ?>
	<?php endif; ?>
	
</div>
