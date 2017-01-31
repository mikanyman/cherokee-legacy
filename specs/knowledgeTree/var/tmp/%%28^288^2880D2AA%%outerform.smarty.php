<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:13
         compiled from /var/www/knowledgeTree/templates/ktcore/forms/outerform.smarty */ ?>
<form method="<?php echo $this->_tpl_vars['context']->_method; ?>
" action="<?php echo $this->_tpl_vars['context']->_actionurl; ?>
"
<?php if ($this->_tpl_vars['context']->_noframe): ?>class="noframe" <?php endif;  if ($this->_tpl_vars['context']->_enctype): ?>enctype="<?php echo $this->_tpl_vars['context']->_enctype; ?>
"<?php endif; ?>>
<fieldset>
    <?php if (! empty ( $this->_tpl_vars['context']->sLabel )): ?><legend><?php echo $this->_tpl_vars['context']->sLabel; ?>
</legend><?php endif; ?>
    <?php if (! empty ( $this->_tpl_vars['context']->sDescription )): ?><p class="descriptiveText"><?php echo $this->_tpl_vars['context']->sDescription; ?>
</p><?php endif; ?>
    
        <input type="hidden" name="<?php echo $this->_tpl_vars['context']->_event; ?>
" value="<?php echo $this->_tpl_vars['context']->_action; ?>
">
    <?php $_from = $this->_tpl_vars['context']->_extraargs; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
    <input type="hidden" name="<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['v']; ?>
">
    <?php endforeach; endif; unset($_from); ?>
    
    
    
    <?php echo $this->_tpl_vars['inner']; ?>

    
</fieldset>
</form>