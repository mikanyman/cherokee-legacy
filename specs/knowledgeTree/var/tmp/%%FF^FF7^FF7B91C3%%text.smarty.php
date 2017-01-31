<?php /* Smarty version 2.6.9, created on 2007-11-17 00:50:49
         compiled from /var/www/knowledgeTree/templates/ktcore/forms/widgets/text.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', '/var/www/knowledgeTree/templates/ktcore/forms/widgets/text.smarty', 5, false),)), $this); ?>
      <textarea name="<?php echo $this->_tpl_vars['name']; ?>
"
        <?php if ($this->_tpl_vars['has_id']): ?> id="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?>
        <?php if ($this->_tpl_vars['options']['rows']): ?> rows="<?php echo $this->_tpl_vars['options']['rows']; ?>
"<?php else: ?> rows="7"<?php endif; ?>
        <?php if ($this->_tpl_vars['options']['cols']): ?> cols="<?php echo $this->_tpl_vars['options']['cols']; ?>
"<?php else: ?> cols="45"<?php endif; ?>
      ><?php if ($this->_tpl_vars['has_value']):  echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp));  endif; ?></textarea>