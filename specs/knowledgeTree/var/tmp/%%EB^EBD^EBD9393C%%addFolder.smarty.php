<?php /* Smarty version 2.6.9, created on 2007-11-17 00:50:16
         compiled from /var/www/knowledgeTree/templates/ktcore/action/addFolder.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/action/addFolder.smarty', 1, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%EB^EBD^EBD9393C%%addFolder.smarty.inc'] = '8d25e73096540f4b2b8675d3bc6797ce'; ?><h2><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8d25e73096540f4b2b8675d3bc6797ce#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Add a folder<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8d25e73096540f4b2b8675d3bc6797ce#0}';}?></h2>

<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8d25e73096540f4b2b8675d3bc6797ce#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Folders are one way of organising documents
in the document management system.  Folders provide meaning in the
traditional file storage way - through a file path.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8d25e73096540f4b2b8675d3bc6797ce#1}';}?></p>

<?php echo $this->_tpl_vars['form']->render(); ?>
