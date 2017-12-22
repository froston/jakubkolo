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
<div class="row">
  <div class="contact col-md-6 col-md-offset-3">
    <h1>Kontaktujte nás přes formulář</h1>
    <p>
      Telefon: +420 775 311 151<br> 
      Email: jakubkolo@jakubkolo.cz<br> 
      Zpětná adresa: Jakubkolo.cz Karlovice 327 76843 Kostelec u Holešova
    </p>
  </div>
</div>
<br>
<div class="google-maps">
  <iframe
    width="600"
    height="350"
    frameborder="0" 
    style="border:0"
    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDek7AAZcvP4eylh4Fd1O7iT8G1-IExmD4&q=Karlovice+327,Kostelec+u+Holešova,Czechia&zoom=10" 
    allowfullscreen
  >
  </iframe>
</div>
<br>
<div class="row">
  <div class="contact col-md-6 col-md-offset-3">
    <?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
      <?php  echo $this->loadTemplate('form');  ?>
    <?php endif; ?>
  </div>
</div>
