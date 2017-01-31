<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/ktstandard/adminversion/dashlet.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktstandard/adminversion/dashlet.smarty', 19, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%55^55C^55C03B7A%%dashlet.smarty.inc'] = '25bb332285c3da349eb4ae54795afc88';  echo '
<style type="text/css">
#admin_version_dashlet {
	display: none;
}

#up_single, #up_multi { display: none; }
.up_new_version { font-weight: bold; }
</style>

'; ?>



<script type="text/javascript" src="resources/js/adminversiondashlet.js"> </script>
<script type="text/javascript">var _KT_VERSIONS = <?php echo $this->_tpl_vars['kt_versions']; ?>
;</script>
<script type="text/javascript">var _KT_VERSIONS_URL = "<?php echo $this->_tpl_vars['kt_versions_url']; ?>
";</script>

<p>
<span id="up_single"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:25bb332285c3da349eb4ae54795afc88#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The following upgrade is available:<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:25bb332285c3da349eb4ae54795afc88#0}';}?></span>
<span id="up_multi"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:25bb332285c3da349eb4ae54795afc88#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The following upgrades are available:<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:25bb332285c3da349eb4ae54795afc88#1}';}?></span>
<span id="up_upgrades"></span>
<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:25bb332285c3da349eb4ae54795afc88#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Please visit <a href="http://www.knowledgetree.com">www.knowledgetree.com</a> to find out more.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:25bb332285c3da349eb4ae54795afc88#2}';}?>
</p>