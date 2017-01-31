<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:06
         compiled from /var/www/knowledgeTree/templates/kt3/browse.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/browse.smarty', 14, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%AE^AE2^AE2A2A6B%%browse.smarty.inc'] = '5e67e59b6efe643db0ab9503094ff6b1';  echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/Base.js'); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/Iter.js'); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/DOM.js'); ?>


<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('resources/js/toggleselect.js'); ?>


<?php if (( $this->_tpl_vars['custom_title'] != null )): ?>
<h2><?php echo $this->_tpl_vars['custom_title']; ?>
</h2>
<?php endif; ?>


<?php if (( $this->_tpl_vars['params'] )): ?>
<div class="collapsible">
<h4 onclick="toggleElementClass('expanded', this.parentNode)"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Parameters<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#0}';}?></h4>
<div class="collapsiblebody">
<?php $this->assign('mainjoin', $this->_tpl_vars['joins']['main']); ?>

<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#1}';}$this->_tag_stack[] = array('i18n', array('arg_join' => $this->_tpl_vars['mainjoin'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Match <b>#join#</b> of the following:<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#1}';}?></p>
<?php $_from = $this->_tpl_vars['params']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['group']):
 $this->assign('join', $this->_tpl_vars['joins'][$this->_tpl_vars['key']]); ?>

<b><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#2}';}?></b> (<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#3}';}$this->_tag_stack[] = array('i18n', array('arg_join' => $this->_tpl_vars['join'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>match <b>#join#</b><?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#3}';}?>)
<ul>
<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['param']):
?>
<li><?php echo $this->_tpl_vars['param']; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endforeach; endif; unset($_from); ?>
</div>
</div>
<?php endif; ?>

<form action="<?php echo $this->_tpl_vars['browseutil']->getActionBaseUrl(); ?>
" method="post">

<?php if (( $this->_tpl_vars['isEditable'] )): ?>

<?php if (( $this->_tpl_vars['context']->oFolder )): ?>
<input type="hidden" name="fFolderId" value="<?php echo $this->_tpl_vars['context']->oFolder->getId(); ?>
" />
<?php endif; ?>

<?php endif; ?>

<?php echo $this->_tpl_vars['collection']->render(); ?>

<?php if (( $this->_tpl_vars['isEditable'] )): ?>
<div class="form_actions">
  <input type="hidden" name="sListCode" value="<?php echo $this->_tpl_vars['code']; ?>
" />
  <input type="hidden" name="action" value="bulkaction" />
  <input type="hidden" name="fReturnAction" value="<?php echo $this->_tpl_vars['returnaction']; ?>
" />
  <input type="hidden" name="fReturnData" value="<?php echo $this->_tpl_vars['returndata']; ?>
" />

  <?php $_from = $this->_tpl_vars['bulkactions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['bulkaction']):
?>
      <input type="submit" name="submit[<?php echo $this->_tpl_vars['bulkaction']->getName(); ?>
]" value="<?php echo $this->_tpl_vars['bulkaction']->getDisplayName(); ?>
" />
  <?php endforeach; endif; unset($_from); ?>

</div>
<?php endif; ?>
</form>


<?php if (( $this->_tpl_vars['save_fields'] )): ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post">
<fieldset>
<legend>Edit search</legend>
<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>To modify this search, press the 'Edit' button.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#4}';}?></p>
<input type="hidden" name="action" value="editSearch" />
<input type="hidden" name="boolean_search" value="<?php echo $this->_tpl_vars['boolean_search']; ?>
" />
<div class="form_actions">
<input type="submit" name="submit" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Edit<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#5}';}?>" />
</div>
</fieldset>
</form>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="post">
<fieldset>
<legend><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Save this search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#6}';}?></legend>
<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#7}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>To save this search permanently, so that you can run it again at any time, fill in a name below and click 'Save'.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#7}';}?></p>
<input type="hidden" name="action" value="saveSearch" />
<input type="hidden" name="boolean_search" value="<?php echo $this->_tpl_vars['boolean_search']; ?>
" />
<?php $_from = $this->_tpl_vars['save_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oWidget']):
?>
    <?php echo $this->_tpl_vars['oWidget']->render(); ?>

<?php endforeach; endif; unset($_from); ?>
<div class="form_actions">
<input type="submit" name="submit" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5e67e59b6efe643db0ab9503094ff6b1#8}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Save<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5e67e59b6efe643db0ab9503094ff6b1#8}';}?>" />
</div>
</fieldset>
</form>
<?php endif; ?>
