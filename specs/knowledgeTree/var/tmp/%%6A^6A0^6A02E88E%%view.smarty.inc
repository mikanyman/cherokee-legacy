<?php /* Smarty version 2.6.9, created on 2007-11-17 00:44:32
         compiled from /var/www/knowledgeTree/templates/ktcore/document/view.smarty */

$this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%6A^6A0^6A02E88E%%view.smarty.inc'] = '5b52d44938eb8963d32aa9d0b244b15e';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/knowledgeTree/templates/ktcore/document/view.smarty', 1, false),array('modifier', 'truncate', '/var/www/knowledgeTree/templates/ktcore/document/view.smarty', 1, false),array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/document/view.smarty', 7, false),)), $this); ?>
<?php
function _smarty_tplfunc_5b52d44938eb8963d32aa9d0b244b15e_0(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is currently checked out by <strong>you</strong>.  If 
this is incorrect, or you no longer need to make changes to it, please cancel the checkout.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_5b52d44938eb8963d32aa9d0b244b15e_1(&$this)
{
$this->_tag_stack[] = array('i18n', array('arg_checkoutuser' => $this->_tpl_vars['checkout_user'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is currently checked out by #checkoutuser#, but you 
have sufficient priviledges to cancel their checkout.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_5b52d44938eb8963d32aa9d0b244b15e_2(&$this)
{
$this->_tag_stack[] = array('i18n', array('arg_checkoutuser' => $this->_tpl_vars['checkout_user'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is currently checked out by #checkoutuser#.  You cannot make 
changes until that user checks it in.  If you have urgent modifications to make, please
contact your KnowledgeTree Administrator.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_5b52d44938eb8963d32aa9d0b244b15e_3(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is immutable.  No further content changes can be
made to this document, and only administrators (in administration mode)
can make changes to the metadata or can move or delete it.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_5b52d44938eb8963d32aa9d0b244b15e_4(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>If you require assistance from an administrator to perform one of
these tasks, use the Request Assistance action.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}



?>
