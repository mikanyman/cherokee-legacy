<?php /* Smarty version 2.6.9, created on 2007-11-17 00:51:11
         compiled from /var/www/knowledgeTree/templates/ktcore/bulk_action_complete.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/bulk_action_complete.smarty', 3, false),array('function', 'cycle', '/var/www/knowledgeTree/templates/ktcore/bulk_action_complete.smarty', 19, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%2F^2FA^2FA267FC%%bulk_action_complete.smarty.inc'] = '4bfa21c6832d913d813940029a62c412'; ?><h2><?php echo $this->_tpl_vars['context']->getDisplayName(); ?>
</h2>

<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:4bfa21c6832d913d813940029a62c412#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>These are the results of the bulk action:<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:4bfa21c6832d913d813940029a62c412#0}';}?></p>

<?php if (count ( $this->_tpl_vars['list']['folders'] )): ?>
<table class="kt_collection">
<thead>
<tr>
    <th colspan="2"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:4bfa21c6832d913d813940029a62c412#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Folders<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:4bfa21c6832d913d813940029a62c412#1}';}?></th>
</tr>
<tr>
    <th width="20%"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:4bfa21c6832d913d813940029a62c412#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:4bfa21c6832d913d813940029a62c412#2}';}?></th>
    <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:4bfa21c6832d913d813940029a62c412#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:4bfa21c6832d913d813940029a62c412#3}';}?></th>
</tr>
</thead>

<tbody>
<?php $_from = $this->_tpl_vars['list']['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => "even,odd"), $this);?>
">
        <td><?php echo $this->_tpl_vars['item']['0']; ?>
</td>
        <td><?php echo $this->_tpl_vars['item']['1']; ?>
</td>
    </tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>
<br/>
<?php endif; ?>

<?php if (count ( $this->_tpl_vars['list']['documents'] )): ?>
<table class="kt_collection">
<thead>
<tr>
    <th colspan="2"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:4bfa21c6832d913d813940029a62c412#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Documents<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:4bfa21c6832d913d813940029a62c412#4}';}?></th>
</tr>
<tr>
    <th width="20%"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:4bfa21c6832d913d813940029a62c412#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:4bfa21c6832d913d813940029a62c412#5}';}?></th>
    <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:4bfa21c6832d913d813940029a62c412#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:4bfa21c6832d913d813940029a62c412#6}';}?></th>
</tr>
</thead>

<tbody>

<?php $_from = $this->_tpl_vars['list']['documents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => "even,odd"), $this);?>
">
        <td><?php echo $this->_tpl_vars['item']['0']; ?>
</td>
        <td><?php echo $this->_tpl_vars['item']['1']; ?>
</td>
    </tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>
<?php endif; ?>

<?php echo $this->_tpl_vars['form']->render(); ?>
