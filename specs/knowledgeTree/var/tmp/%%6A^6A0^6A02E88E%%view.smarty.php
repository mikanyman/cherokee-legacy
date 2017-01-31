<?php /* Smarty version 2.6.9, created on 2007-11-17 00:44:32
         compiled from /var/www/knowledgeTree/templates/ktcore/document/view.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/knowledgeTree/templates/ktcore/document/view.smarty', 1, false),array('modifier', 'truncate', '/var/www/knowledgeTree/templates/ktcore/document/view.smarty', 1, false),array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/document/view.smarty', 7, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%6A^6A0^6A02E88E%%view.smarty.inc'] = '5b52d44938eb8963d32aa9d0b244b15e'; ?><h2><img src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/graphics/title_bullet.png"/><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['document']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...") : smarty_modifier_truncate($_tmp, 40, "...")); ?>
</h2>

<?php if (( $this->_tpl_vars['document']->getIsCheckedOut() == 1 )):  ob_start(); ?><strong><?php echo $this->_tpl_vars['sCheckoutUser']; ?>
</strong><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('checkout_user', ob_get_contents());ob_end_clean();  if (( $this->_tpl_vars['isCheckoutUser'] )): ?>
<div class="ktInfo">
<p><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5b52d44938eb8963d32aa9d0b244b15e#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is currently checked out by <strong>you</strong>.  If 
this is incorrect, or you no longer need to make changes to it, please cancel the checkout.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5b52d44938eb8963d32aa9d0b244b15e#0}';}?></p>
</div>
<?php else:  if (( $this->_tpl_vars['canCheckin'] )): ?>
<div class="ktInfo">
<p><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5b52d44938eb8963d32aa9d0b244b15e#1}';}$this->_tag_stack[] = array('i18n', array('arg_checkoutuser' => $this->_tpl_vars['checkout_user'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is currently checked out by #checkoutuser#, but you 
have sufficient priviledges to cancel their checkout.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5b52d44938eb8963d32aa9d0b244b15e#1}';}?></p>
</div>
<?php else: ?>
<div class="ktInfo">
<p><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5b52d44938eb8963d32aa9d0b244b15e#2}';}$this->_tag_stack[] = array('i18n', array('arg_checkoutuser' => $this->_tpl_vars['checkout_user'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is currently checked out by #checkoutuser#.  You cannot make 
changes until that user checks it in.  If you have urgent modifications to make, please
contact your KnowledgeTree Administrator.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5b52d44938eb8963d32aa9d0b244b15e#2}';}?></p>
</div>
<?php endif;  endif;  endif; ?>    

<?php if (( $this->_tpl_vars['document']->getImmutable() == true )): ?>
<div class="ktInfo">
<p><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5b52d44938eb8963d32aa9d0b244b15e#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This document is immutable.  No further content changes can be
made to this document, and only administrators (in administration mode)
can make changes to the metadata or can move or delete it.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5b52d44938eb8963d32aa9d0b244b15e#3}';} if (1): ?>
  <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5b52d44938eb8963d32aa9d0b244b15e#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>If you require assistance from an administrator to perform one of
these tasks, use the Request Assistance action.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:5b52d44938eb8963d32aa9d0b244b15e#4}';} endif; ?>
</p>
</div>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['fieldsets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oFieldset']):
 echo $this->_tpl_vars['oFieldset']->render($this->_tpl_vars['document_data']); ?>

<?php endforeach; endif; unset($_from); ?>

<?php if (! empty ( $this->_tpl_vars['viewlet_data'] )): ?>

<!--  Document "Views" -->
<div id="document-views">

<?php echo $this->_tpl_vars['viewlet_data']; ?>


</div>
<?php endif; ?>