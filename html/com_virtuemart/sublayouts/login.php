<?php
/**
*
* Layout for the login
*
* @package	VirtueMart
* @subpackage User
* @author Max Milbers, George Kostopoulos
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: cart.php 4431 2011-10-17 grtrustme $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

//set variables, usually set by shopfunctionsf::getLoginForm in case this layout is differently used
if (!isset( $this->show )) $this->show = TRUE;
if (!isset( $this->from_cart )) $this->from_cart = FALSE;
if (!isset( $this->order )) $this->order = FALSE ;


if (empty($this->url)){
	$url = vmURI::getCleanUrl();
} else{
	$url = $this->url;
}
//$url = JRoute::_($url, $this->useXHTML, $this->useSSL);

$user = JFactory::getUser();

if ($this->show and $user->id == 0  ) {
JHtml::_('behavior.formvalidation');

	//Extra login stuff, systems like openId and plugins HERE
    if (JPluginHelper::isEnabled('authentication', 'openid')) {
        $lang = JFactory::getLanguage();
        $lang->load('plg_authentication_openid', JPATH_ADMINISTRATOR);
        $langScript = '
//<![CDATA[
'.'var JLanguage = {};' .
                ' JLanguage.WHAT_IS_OPENID = \'' . vmText::_('WHAT_IS_OPENID') . '\';' .
                ' JLanguage.LOGIN_WITH_OPENID = \'' . vmText::_('LOGIN_WITH_OPENID') . '\';' .
                ' JLanguage.NORMAL_LOGIN = \'' . vmText::_('NORMAL_LOGIN') . '\';' .
                ' var comlogin = 1;
//]]>
                ';
		vmJsApi::addJScript('login_openid',$langScript);
        JHtml::_('script', 'openid.js');
    }

    $html = '';
    JPluginHelper::importPlugin('vmpayment');
    $dispatcher = JDispatcher::getInstance();
    $returnValues = $dispatcher->trigger('plgVmDisplayLogin', array($this, &$html, $this->from_cart));

    if (is_array($html)) {
		foreach ($html as $login) {
		    echo $login.'<br />';
		}
    }
    else {
		echo $html;
    }

    // XXX style CSS id com-form-login ?>
    <form id="com-form-login" class="cart-login" action="<?php echo $url; ?>" method="post" name="com-login" >
        <fieldset class="userdata">
           
            <legend>
                <span class="userfields_info"><?php echo vmText::_('COM_VIRTUEMART_ORDER_CONNECT_FORM'); ?></span>
            </legend>

            <div id="com-form-login-username" class="form-group">
                    <div class="control-label">
                        <label><?php echo vmText::_('COM_VIRTUEMART_USERNAME'); ?><span class="star"> *</span></label>
                    </div>
                    <div class="controls">
                        <input type="text" name="username" class="inputbox" size="18" title="<?php echo vmText::_('COM_VIRTUEMART_USERNAME'); ?>" onblur="if(this.value=='') this.value='<?php echo addslashes(vmText::_('COM_VIRTUEMART_USERNAME')); ?>';" onfocus="if(this.value=='<?php echo addslashes(vmText::_('COM_VIRTUEMART_USERNAME')); ?>') this.value='';" />
                    </div>
            </div>

            <div id="com-form-login-password" class="form-group">
                    <div class="control-label">
                        <label><?php echo vmText::_('COM_VIRTUEMART_PASSWORD'); ?><span class="star"> *</span></label>
                    </div>
                    <div class="controls">
                        <input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18" title="<?php echo vmText::_('COM_VIRTUEMART_PASSWORD'); ?>" onblur="if(this.value=='') this.value='<?php echo addslashes(vmText::_('COM_VIRTUEMART_PASSWORD')); ?>';" onfocus="if(this.value=='<?php echo addslashes(vmText::_('COM_VIRTUEMART_PASSWORD')); ?>') this.value='';" />
                    </div>
            </div>
            <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
            <div id="com-form-login-remember" class="form-group">
                    <div class="control-label">
                        <label for="remember"><?php echo $remember_me = vmText::_('JGLOBAL_REMEMBER_ME') ?></label>
                    </div>
                    <div class="controls">    
                        <input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" />
                    </div>
            </div>
            <?php endif; ?>
            
            <div class="form-group send-button">
                    <div class="controls">
                            <button type="submit" name="Submit" class="btn btn-info btn-lg">
                                <i class="fa fa-sign-in"></i><?php echo " " . JText::_('JLOGIN'); ?>
                            </button>
                    </div>
            </div>

            <div class="forget">
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>" rel="nofollow"><?php echo vmText::_('COM_VIRTUEMART_ORDER_FORGOT_YOUR_USERNAME'); ?></a>
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" rel="nofollow"><?php echo vmText::_('COM_VIRTUEMART_ORDER_FORGOT_YOUR_PASSWORD'); ?></a>
            </div>
        </fieldset>

        <input type="hidden" name="task" value="user.login" />
        <input type="hidden" name="option" value="com_users" />
        <input type="hidden" name="return" value="<?php echo base64_encode($url) ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </form>

<?php  } else if ( $user->id ) { ?>

<h3 class="hello"><?php echo vmText::sprintf( 'COM_VIRTUEMART_HINAME', $user->name ); ?></h3>

<?php }

?>

