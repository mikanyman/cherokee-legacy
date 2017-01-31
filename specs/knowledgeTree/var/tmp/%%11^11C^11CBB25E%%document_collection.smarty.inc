<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:06
         compiled from /var/www/knowledgeTree/templates/kt3/document_collection.smarty */

$this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%11^11C^11CBB25E%%document_collection.smarty.inc'] = 'd7a847145deca46919c1f01fd4b026e6';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 19, false),array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 48, false),array('modifier', 'range', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 63, false),array('modifier', 'htmlentities', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 107, false),)), $this); ?>
<?php
function _smarty_tplfunc_d7a847145deca46919c1f01fd4b026e6_0(&$this)
{
$this->_tag_stack[] = array('i18n', array('arg_itemCount' => $this->_tpl_vars['context']->itemCount,'arg_batchSize' => $this->_tpl_vars['context']->batchSize)); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>#itemCount# items, #batchSize# per page<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_d7a847145deca46919c1f01fd4b026e6_1(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>prev<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_d7a847145deca46919c1f01fd4b026e6_2(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>next<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_d7a847145deca46919c1f01fd4b026e6_3(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>next<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_d7a847145deca46919c1f01fd4b026e6_4(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>per page<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}



?>
