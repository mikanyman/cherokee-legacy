<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:06
         compiled from /var/www/knowledgeTree/templates/kt3/portlets/actions_portlet.smarty */ ?>
<ul class="actionlist">
<?php $_from = $this->_tpl_vars['context']->actions; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['action']):
?>
<li <?php if ($this->_tpl_vars['action']['active']): ?>class="active"<?php endif; ?>><?php if (( $this->_tpl_vars['action']['url'] )): ?><a href="<?php echo $this->_tpl_vars['action']['url']; ?>
"
<?php if ($this->_tpl_vars['action']['description']): ?>title="<?php echo $this->_tpl_vars['action']['description']; ?>
"<?php endif; ?>
     ><?php echo $this->_tpl_vars['action']['name']; ?>
</a><?php else:  echo $this->_tpl_vars['action']['name'];  endif; ?></li>
<?php endforeach; endif; unset($_from); ?>
</ul>