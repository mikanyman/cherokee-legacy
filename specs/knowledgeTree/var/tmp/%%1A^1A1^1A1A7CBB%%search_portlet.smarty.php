<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/kt3/portlets/search_portlet.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/portlets/search_portlet.smarty', 2, false),array('function', 'ktLink', '/var/www/knowledgeTree/templates/kt3/portlets/search_portlet.smarty', 4, false),array('modifier', 'generateControllerUrl', '/var/www/knowledgeTree/templates/kt3/portlets/search_portlet.smarty', 12, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%1A^1A1^1A1A7CBB%%search_portlet.smarty.inc'] = 'f3708daae2fb0199a3f3653c785e184e'; ?><form action="<?php echo $this->_tpl_vars['rootUrl']; ?>
/search/simpleSearch.php" method="GET">
<input type="text" name="fSearchableText" id="portlet-search-text" size="15" /><input type="submit" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f3708daae2fb0199a3f3653c785e184e#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f3708daae2fb0199a3f3653c785e184e#0}';}?>" class="searchbutton" />
</form>
<p><a href="<?php echo KTSmartyTemplate::ktLink(array('base' => "help.php",'subpath' => "ktcore/search.html"), $this);?>
" class="ktInline ktHelp" style="float: left; margin: 0 0.5em 0.5em 5px;" ><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f3708daae2fb0199a3f3653c785e184e#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>How do I search?<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f3708daae2fb0199a3f3653c785e184e#1}';}?></a>
<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f3708daae2fb0199a3f3653c785e184e#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>How do I search?<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f3708daae2fb0199a3f3653c785e184e#2}';}?></p>

<?php if (( ! empty ( $this->_tpl_vars['saved_searches'] ) )): ?>
<h4><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f3708daae2fb0199a3f3653c785e184e#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Saved Searches<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f3708daae2fb0199a3f3653c785e184e#3}';}?></h4>
<ul class="actionlist">
<?php $_from = $this->_tpl_vars['saved_searches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oSearch']):
?>
<li>
<?php if (( $this->_tpl_vars['oSearch']->getUserId() )): ?><a class="ktInline ktAction ktDelete" href="<?php echo ((is_array($_tmp='booleanSearch')) ? $this->_run_mod_handler('generateControllerUrl', true, $_tmp) : generateControllerUrl($_tmp)); ?>
&qs[action]=deleteSearch&qs[fSavedSearchId]=<?php echo $this->_tpl_vars['oSearch']->getId(); ?>
&qs[fFolderId]=<?php echo $this->_tpl_vars['folder_id']; ?>
&qs[fDocumentId]=<?php echo $this->_tpl_vars['document_id']; ?>
"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f3708daae2fb0199a3f3653c785e184e#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f3708daae2fb0199a3f3653c785e184e#4}';}?></a><?php endif; ?><a href="<?php echo ((is_array($_tmp='booleanSearch')) ? $this->_run_mod_handler('generateControllerUrl', true, $_tmp) : generateControllerUrl($_tmp)); ?>
&qs[action]=performSearch&qs[fSavedSearchId]=<?php echo $this->_tpl_vars['oSearch']->getId(); ?>
"><?php echo $this->_tpl_vars['oSearch']->getName(); ?>
</a>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<hr />
<?php endif; ?>
<ul class="actionlist">
<li><a href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/search/booleanSearch.php"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f3708daae2fb0199a3f3653c785e184e#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Advanced Search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f3708daae2fb0199a3f3653c785e184e#5}';}?></a></li>
</ul>