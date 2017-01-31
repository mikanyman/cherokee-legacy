<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/ktcore/dashlets/mailserver.smarty */

$this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%70^708^708A599C%%mailserver.smarty.inc'] = 'af7e633e369548e069add7de77d37498';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/dashlets/mailserver.smarty', 1, false),)), $this); ?>
<?php
function _smarty_tplfunc_af7e633e369548e069add7de77d37498_0(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Email has not been configured on this server.  Emailing of
documents and sending of notifications are disabled.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}


function _smarty_tplfunc_af7e633e369548e069add7de77d37498_1(&$this)
{
$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Edit the [email] section of the config.ini file to set your email
server and the sending address of the KnowledgeTree server.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); 
}



?>
