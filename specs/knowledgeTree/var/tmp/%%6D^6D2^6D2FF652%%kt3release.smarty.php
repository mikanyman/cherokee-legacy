<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/ktcore/dashlets/kt3release.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ktLink', '/var/www/knowledgeTree/templates/ktcore/dashlets/kt3release.smarty', 5, false),array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/dashlets/kt3release.smarty', 5, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%6D^6D2^6D2FF652%%kt3release.smarty.inc'] = '1abcac9ad6bb89c24649c4b09d881e80';  echo $this->_tpl_vars['body']; ?>


<?php if ($this->_tpl_vars['can_edit']): ?>
<p><a class="ktAction ktEdit ktInline" 
      href="<?php echo KTSmartyTemplate::ktLink(array('base' => "admin.php",'subpath' => "/misc/helpmanagement",'query' => "action=customise&name=".($this->_tpl_vars['target_name'])), $this);?>
" ><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:1abcac9ad6bb89c24649c4b09d881e80#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Edit this introduction.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:1abcac9ad6bb89c24649c4b09d881e80#0}';}?></a>
<a href="<?php echo KTSmartyTemplate::ktLink(array('base' => "admin.php",'subpath' => "/misc/helpmanagement",'query' => "action=customise&name=".($this->_tpl_vars['target_name'])), $this);?>
"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:1abcac9ad6bb89c24649c4b09d881e80#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Edit this introduction.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:1abcac9ad6bb89c24649c4b09d881e80#1}';}?></a>
<?php if ($this->_tpl_vars['help_id']): ?>| <a class="ktActionLink ktDelete" href="<?php echo KTSmartyTemplate::ktLink(array('base' => "admin.php",'subpath' => "/misc/helpmanagement",'query' => "action=deleteReplacement&id=".($this->_tpl_vars['help_id'])), $this);?>
"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:1abcac9ad6bb89c24649c4b09d881e80#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Use the standard introduction.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:1abcac9ad6bb89c24649c4b09d881e80#2}';}?></a>

<?php endif; ?>
</p>
<?php endif; ?>