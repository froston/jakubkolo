<?php
/**
 * @package	AcyMailing for Joomla!
 * @version	5.5.0
 * @author	acyba.com
 * @copyright	(C) 2009-2016 ACYBA S.A.R.L. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');

$style = array(); ?>

    <p><?php echo $introText; ?></p>
    
    <form id="<?php echo $formName; ?>" action="<?php echo JRoute::_('index.php'); ?>" onsubmit="return submitacymailingform('optin','<?php echo $formName;?>')" method="post" name="<?php echo $formName ?>" <?php if(!empty($fieldsClass->formoption)) echo $fieldsClass->formoption; ?> >
        
        <input class="email-input inputbox" id="user_email_<?php echo $formName; ?>" <?php if(!empty($identifiedUser->userid)) echo 'readonly="readonly" ';  if(!$displayOutside){ ?> onfocus="if(this.value == '<?php echo $emailCaption;?>') this.value = '';" onblur="if(this.value=='') this.value='<?php echo $emailCaption?>';"<?php } ?> type="text" name="user[email]" style="width:<?php echo $fieldsize; ?>" placeholder="<?php if(!empty($identifiedUser->userid)) echo $identifiedUser->email; elseif(!$displayOutside) echo $emailCaption; ?>" title="<?php echo $emailCaption;?>"/>
        <input class="subbutton" type="submit" value="<?php echo "&#xf003;"; ?>" name="Submit" onclick="try{ return submitacymailingform('optin','<?php echo $formName;?>'); }catch(err){alert('The form could not be submitted '+err);return false;}"/>
        
        <?php $ajax = ($params->get('redirectmode') == '3') ? 1 : 0;?>
        <input type="hidden" name="ajax" value="<?php echo $ajax; ?>" />
        <input type="hidden" name="acy_source" value="<?php echo 'module_'.$module->id ?>" />
        <input type="hidden" name="ctrl" value="sub"/>
        <input type="hidden" name="task" value="notask"/>
        <input type="hidden" name="redirect" value="<?php echo urlencode($redirectUrl); ?>"/>
        <input type="hidden" name="redirectunsub" value="<?php echo urlencode($redirectUrlUnsub); ?>"/>
        <input type="hidden" name="option" value="<?php echo ACYMAILING_COMPONENT ?>"/>
        <?php if(!empty($identifiedUser->userid)){ ?><input type="hidden" name="visiblelists" value="<?php echo $visibleLists;?>"/><?php } ?>
        <input type="hidden" name="hiddenlists" value="<?php echo $hiddenLists;?>"/>
        <input type="hidden" name="acyformname" value="<?php echo $formName; ?>" />
        <?php if(JRequest::getCmd('tmpl') == 'component'){ ?>
                <input type="hidden" name="tmpl" value="component" />
                <?php if($params->get('effect','normal') == 'mootools-box' AND !empty($redirectUrl)){ ?>
                        <input type="hidden" name="closepop" value="1" />
                <?php } } ?>
        <?php $myItemId = $config->get('itemid',0); if(empty($myItemId)){ global $Itemid; $myItemId = $Itemid;} if(!empty($myItemId)){ ?><input type="hidden" name="Itemid" value="<?php echo $myItemId;?>"/><?php } ?>
    </form>
