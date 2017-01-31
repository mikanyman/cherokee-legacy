<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:13
         compiled from /var/www/knowledgeTree/templates/ktcore/forms/widgets/selection.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlentities', '/var/www/knowledgeTree/templates/ktcore/forms/widgets/selection.smarty', 9, false),)), $this); ?>
<?php if (empty ( $this->_tpl_vars['vocab'] )): ?>
    <div class="ktInfo"><p><?php echo $this->_tpl_vars['context']->sEmptyMessage; ?>
</p></div>
<?php else: ?>
  <select name="<?php echo $this->_tpl_vars['name']; ?>
" 
    <?php if ($this->_tpl_vars['has_id']): ?>id="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?> 
    <?php if ($this->_tpl_vars['options']['multi']): ?>multiple="true"<?php endif; ?> 
    >
    <?php if ($this->_tpl_vars['options']['initial_string']): ?>
    <option value=""><?php echo ((is_array($_tmp=$this->_tpl_vars['options']['initial_string'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</option>
    <?php endif; ?>    
  <?php $_from = $this->_tpl_vars['vocab']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lookup_key'] => $this->_tpl_vars['lookup']):
?>

       <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lookup_key'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
" <?php if (( $this->_tpl_vars['value'] == $this->_tpl_vars['lookup_key'] )): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['lookup'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</option>
  <?php endforeach; endif; unset($_from); ?>
  </select>
<?php endif; ?>