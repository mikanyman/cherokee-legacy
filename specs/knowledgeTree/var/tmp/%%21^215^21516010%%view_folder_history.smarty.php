<?php /* Smarty version 2.6.9, created on 2007-11-17 00:52:53
         compiled from /var/www/knowledgeTree/templates/kt3/view_folder_history.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/view_folder_history.smarty', 1, false),array('function', 'cycle', '/var/www/knowledgeTree/templates/kt3/view_folder_history.smarty', 18, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%21^215^21516010%%view_folder_history.smarty.inc'] = '0ac6a2f7305d12db25fbf87dde0ceaca'; ?><h2><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0ac6a2f7305d12db25fbf87dde0ceaca#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Transaction History<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0ac6a2f7305d12db25fbf87dde0ceaca#0}';}?>: <?php echo $this->_tpl_vars['folder']->getName(); ?>
</h2>

<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0ac6a2f7305d12db25fbf87dde0ceaca#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>This page provides details of all activities that have been carried out on the folder.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0ac6a2f7305d12db25fbf87dde0ceaca#1}';}?></p>


    <table class="document_history" summary="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0ac6a2f7305d12db25fbf87dde0ceaca#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Folder History<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0ac6a2f7305d12db25fbf87dde0ceaca#2}';}?>" cellspacing="0">

        <thead>
            <tr>
                <th class="username"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0ac6a2f7305d12db25fbf87dde0ceaca#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>User<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0ac6a2f7305d12db25fbf87dde0ceaca#3}';}?></th>
                <th class="action"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0ac6a2f7305d12db25fbf87dde0ceaca#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Action<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0ac6a2f7305d12db25fbf87dde0ceaca#4}';}?></th>
                <th class="date"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0ac6a2f7305d12db25fbf87dde0ceaca#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Date<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0ac6a2f7305d12db25fbf87dde0ceaca#5}';}?></th>
                <th class="comment"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0ac6a2f7305d12db25fbf87dde0ceaca#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Comment<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0ac6a2f7305d12db25fbf87dde0ceaca#6}';}?></th>
            </tr>
        </thead>
        <tbody>
          <?php $_from = $this->_tpl_vars['transactions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aTransactionRow']):
?>
            <tr class="<?php echo smarty_function_cycle(array('values' => "even,odd"), $this);?>
">
                <td class="username"><?php echo $this->_tpl_vars['aTransactionRow']['user_name']; ?>
</td>
                <td class="action"><?php echo $this->_tpl_vars['aTransactionRow']['transaction_name']; ?>
</td>
                <td class="date"><?php echo $this->_tpl_vars['aTransactionRow']['datetime']; ?>
</td>
                <td class="comment"><?php echo $this->_tpl_vars['aTransactionRow']['comment']; ?>
</td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
        
    </table>