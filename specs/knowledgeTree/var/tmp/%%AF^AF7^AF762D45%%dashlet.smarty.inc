<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty */

$this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%AF^AF7^AF762D45%%dashlet.smarty.inc'] = '46beb130039c8bd86ee9634aca43b418';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ktLink', '/var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty', 1, false),array('block', 'i18n', '/var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty', 3, false),array('modifier', 'generateControllerUrl', '/var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty', 16, false),)), $this); ?>
<?php
function _smarty_tplfunc_46beb130039c8bd86ee9634aca43b418_0(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_46beb130039c8bd86ee9634aca43b418_1(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Advanced
Search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_46beb130039c8bd86ee9634aca43b418_2(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Saved Searches<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_46beb130039c8bd86ee9634aca43b418_3(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Saved Search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}



?>
