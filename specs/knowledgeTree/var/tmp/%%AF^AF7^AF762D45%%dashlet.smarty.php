<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ktLink', '/var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty', 1, false),array('block', 'i18n', '/var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty', 3, false),array('modifier', 'generateControllerUrl', '/var/www/knowledgeTree/templates/ktstandard/searchdashlet/dashlet.smarty', 16, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%AF^AF7^AF762D45%%dashlet.smarty.inc'] = '46beb130039c8bd86ee9634aca43b418'; ?><form action="<?php echo KTSmartyTemplate::ktLink(array('base' => "search/simpleSearch.php"), $this);?>
" method="GET">
<input onclick="this.focus()" type="text" name="fSearchableText" id="dashlet-search-text"
size="15" /><input type="submit" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:46beb130039c8bd86ee9634aca43b418#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:46beb130039c8bd86ee9634aca43b418#0}';}?>"
class="searchbutton frontpage" />
</form>

<a href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/search/booleanSearch.php"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:46beb130039c8bd86ee9634aca43b418#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Advanced
Search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:46beb130039c8bd86ee9634aca43b418#1}';}?></a>

<?php if (( ! empty ( $this->_tpl_vars['saved_searches'] ) )): ?>
<hr />
<h3><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:46beb130039c8bd86ee9634aca43b418#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Saved Searches<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:46beb130039c8bd86ee9634aca43b418#2}';}?></h3>

<?php $_from = $this->_tpl_vars['saved_searches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oSearch']):
?>
<span class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:46beb130039c8bd86ee9634aca43b418#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Saved Search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:46beb130039c8bd86ee9634aca43b418#3}';}?>: </span><a
href="<?php echo ((is_array($_tmp='booleanSearch')) ? $this->_run_mod_handler('generateControllerUrl', true, $_tmp) : generateControllerUrl($_tmp)); ?>
&qs[action]=performSearch&qs[fSavedSearchId]=<?php echo $this->_tpl_vars['oSearch']->getId(); ?>
"><?php echo $this->_tpl_vars['oSearch']->getName(); ?>
</a><br />
<?php endforeach; endif; unset($_from); ?>


<?php endif; ?>