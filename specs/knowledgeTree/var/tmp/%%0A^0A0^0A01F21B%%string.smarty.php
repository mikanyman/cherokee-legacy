<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:12
         compiled from /var/www/knowledgeTree/templates/ktcore/forms/widgets/string.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', '/var/www/knowledgeTree/templates/ktcore/forms/widgets/string.smarty', 1, false),)), $this); ?>
  <input type="text" name="<?php echo $this->_tpl_vars['name']; ?>
" <?php if ($this->_tpl_vars['has_id']): ?>id="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['has_value']): ?>value="<?php echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
"<?php endif;  if (( $this->_tpl_vars['options']['autocomplete'] === false )): ?>autocomplete="off"<?php endif; ?>  <?php if ($this->_tpl_vars['options']['width']): ?>size="<?php echo $this->_tpl_vars['options']['width']; ?>
"<?php endif; ?> />