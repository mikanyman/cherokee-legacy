<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:13
         compiled from /var/www/knowledgeTree/templates/ktcore/forms/buttons.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/forms/buttons.smarty', 4, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%12^12C^12CA834D%%buttons.smarty.inc'] = '1a9dbca81f514bc076f0596dbecc6836'; ?><div class="form_actions">
    <input type="submit" name="" value="<?php echo $this->_tpl_vars['context']->_submitlabel; ?>
" /> 
    <?php if (( $this->_tpl_vars['context']->bCancel )): ?>
        <a class="form_cancel" href="<?php echo $this->_tpl_vars['context']->_cancelurl; ?>
"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:1a9dbca81f514bc076f0596dbecc6836#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Cancel<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:1a9dbca81f514bc076f0596dbecc6836#0}';}?></a>
    <?php endif; ?>
</div>