<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/kt3/standard_page.smarty */

$this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%96^96E^96E9718A%%standard_page.smarty.inc'] = 'be232bb6861fc8d36860772c0deab5f1';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/standard_page.smarty', 106, false),array('modifier', 'escape', '/var/www/knowledgeTree/templates/kt3/standard_page.smarty', 120, false),array('modifier', 'truncate', '/var/www/knowledgeTree/templates/kt3/standard_page.smarty', 122, false),)), $this); ?>
<?php
function _smarty_tplfunc_be232bb6861fc8d36860772c0deab5f1_0(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>You are here<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_be232bb6861fc8d36860772c0deab5f1_1(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>&copy; 2006 <a href="http://www.ktdms.com/">The Jam Warehouse Software (Pty) Ltd.</a> All Rights Reserved<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_be232bb6861fc8d36860772c0deab5f1_2(&$this)
{
$this->_tag_stack[] = array('i18n', array('arg_version' => ($this->_tpl_vars['versionname']))); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>KnowledgeTree Version: #version#<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_be232bb6861fc8d36860772c0deab5f1_3(&$this)
{
$this->_tag_stack[] = array('i18n', array('arg_timing' => $this->_tpl_vars['page']->getReqTime())); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Request created in #timing#s<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}



?>
