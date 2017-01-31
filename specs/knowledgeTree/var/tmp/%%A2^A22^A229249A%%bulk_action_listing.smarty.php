<?php /* Smarty version 2.6.9, created on 2007-11-17 00:50:45
         compiled from /var/www/knowledgeTree/templates/ktcore/bulk_action_listing.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/bulk_action_listing.smarty', 3, false),array('function', 'cycle', '/var/www/knowledgeTree/templates/ktcore/bulk_action_listing.smarty', 19, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%A2^A22^A229249A%%bulk_action_listing.smarty.inc'] = '0073c8ecb633180f413034ac3e6e4cac'; ?><h2><?php echo $this->_tpl_vars['context']->getDisplayName(); ?>
</h2>

<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The following list shows documents and folders in your list which cannot be acted on by this bulk action:<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#0}';}?></p>

<?php if (count ( $this->_tpl_vars['failed']['folders'] )): ?>
<table class="kt_collection">
<thead>
<tr>
    <th colspan="2"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Folders<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#1}';}?></th>
</tr>
<tr>
    <th width="20%"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#2}';}?></th>
    <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Reason for failure<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#3}';}?></th>
</tr>
</thead>

<tbody>
<?php $_from = $this->_tpl_vars['failed']['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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

<?php if (( count ( $this->_tpl_vars['failed']['documents'] ) )): ?>

<table class="kt_collection">
<thead>
<tr>
    <th colspan="2"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Documents<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#4}';}?></th>
</tr>
<tr>
    <th width="20%"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#5}';}?></th>
    <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Reason for failure<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#6}';}?></th>
</tr>
</thead>

<tbody>

<?php $_from = $this->_tpl_vars['failed']['documents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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


<?php if (( count ( $this->_tpl_vars['documents'] ) || count ( $this->_tpl_vars['folders'] ) )): ?>
<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#7}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The action will be performed on the following documents and folders:<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#7}';}?></p>

<?php if (( count ( $this->_tpl_vars['folders'] ) )): ?>
<h3><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#8}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Folders<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#8}';}?></h3>
<ul>
<?php $_from = $this->_tpl_vars['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['folder']):
?>
<li><?php echo $this->_tpl_vars['folder']; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

<?php if (count ( $this->_tpl_vars['documents'] )): ?>
<h3><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#9}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Documents<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#9}';}?></h3>
<ul>
<?php $_from = $this->_tpl_vars['documents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['document']):
?>
<li><?php echo $this->_tpl_vars['document']; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif;  endif; ?>




<?php if (( ! count ( $this->_tpl_vars['failed']['folders'] ) && ! count ( $this->_tpl_vars['failed']['documents'] ) )): ?>
<p><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#10}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The action can be performed on the entire selection.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#10}';}?></p>
<?php endif; ?>

<?php if (( ! $this->_tpl_vars['activecount'] )): ?>
<p><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0073c8ecb633180f413034ac3e6e4cac#11}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The action cannot be performed on any of the selected entities.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0073c8ecb633180f413034ac3e6e4cac#11}';}?></p>
<?php echo $this->_tpl_vars['failedform']->render(); ?>

<?php else:  echo $this->_tpl_vars['form']->render(); ?>

<?php endif; ?>