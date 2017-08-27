<?php
/**
 *TODO Improve the CSS , ADD CATCHA ?
 * Show the form Ask a Question
 *
 * @package	VirtueMart
 * @subpackage
 * @author Kohl Padivick, Maik K�nnemann
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as disdivibuted it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
* @version $Id: default.php 2810 2011-03-02 19:08:24Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Resdivicted access' );
$min = VmConfig::get('asks_minimum_comment_length', 20);
$max = VmConfig::get('asks_maximum_comment_length', 2000) ;
vmJsApi::JvalideForm();
vmJsApi::addJScript('askform','
	jQuery(function($){
			jQuery("#askform").validationEngine("attach");
			jQuery("#comment").keyup( function () {
				var result = $(this).val();
					$("#counter").val( result.length );
			});
	});
');
/* Let's see if we found the product */
if (empty ( $this->product )) {
	echo vmText::_ ( 'COM_VIRTUEMART_PRODUCT_NOT_FOUND' );
	echo '<br /><br />  ' . $this->continue_link_html;
} else {
	$session = JFactory::getSession();
	$sessData = $session->get('askquestion', 0, 'vm');
	if(!empty($this->login)){
		echo $this->login;
	}
	if(empty($this->login) or VmConfig::get('recommend_unauth',false)){
		?>
		<div id="component" class="ask-a-question-view">
			<h1><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ASK_QUESTION')  ?> - <?php echo $this->product->product_name ?></h1>
                        <hr>
			<div class="product-summary">
                            <div class="width30 floatleft center">
                                    <?php // Product Image
                                    echo $this->product->images[0]->displayMediaThumb('class="product-image"',false); ?>
                            </div>

                            <div class="clear"></div>
			</div>
                        
                        <hr>

			<div class="form-field">

				<form method="post" class="form-validate" action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$this->product->virtuemart_product_id.'&virtuemart_category_id='.$this->product->virtuemart_category_id.'&tmpl=component', FALSE) ; ?>" name="askform" id="askform" onSubmit="ga('send', 'event', 'Contact', 'askquestion', 'Dotaz na produkt');">

					<div class="askform">
						<div class="form-group">
							<div class="form-label">
                                                            <label for="name"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_NAME')  ?> : </label>
                                                        </div>
							<div class="controls">
                                                            <input type="text" class="validate[required,minSize[3],maxSize[64]]" value="<?php echo $this->user->name ? $this->user->name : $sessData['name'] ?>" name="name" id="name" size="30"  validation="required name"/>
                                                        </div>
						</div>
						<div class="form-group">
							<div class="form-label">
                                                            <label for="email"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_EMAIL')  ?> : </label>
                                                        </div>
                                                        <div class="controls">
                                                            <input type="text" class="validate[required,custom[email]]" value="<?php echo $this->user->email ? $this->user->email : $sessData['email'] ?>" name="email" id="email" size="30"  validation="required email"/>
                                                        </div>
						</div>
						<div class="form-group">
							<div class="form-label">
                                                            <label for="comment"><?php echo vmText::sprintf('COM_VIRTUEMART_ASK_COMMENT', $min, $max); ?></label>
                                                        </div>
							<div class="controls">
                                                            <textarea class="form-control validate[required,minSize[<?php echo $min ?>],maxSize[<?php echo $max ?>]] field" id="comment" name="comment" rows="3" cols="26"><?php echo $sessData['comment'] ?></textarea>
                                                        </div>
						</div>
					</div>

					<div class="submit">
						<?php echo $this->captcha; ?>
                                            <div class="form-group">
                                              <div class="controls">
                                                <input class="btn btn-lg btn-info send-input" type="submit" name="submit_ask" title="<?php echo vmText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" value="<?php echo vmText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" />
                                              </div>
                                              <div class="clearfix"></div>
                                            </div>
					</div>

					<input type="hidden" name="virtuemart_product_id" value="<?php echo vRequest::getInt('virtuemart_product_id',0); ?>" />
					<input type="hidden" name="tmpl" value="component" />
					<input type="hidden" name="view" value="productdetails" />
					<input type="hidden" name="option" value="com_virtuemart" />
					<input type="hidden" name="virtuemart_category_id" value="<?php echo vRequest::getInt('virtuemart_category_id'); ?>" />
					<input type="hidden" name="task" value="mailAskquestion" />
					<?php echo JHTML::_( 'form.token' ); ?>
				</form>

			</div>
		</div>
<?php
	}
} ?>
