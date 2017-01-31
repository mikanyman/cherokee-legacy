<?php /* Smarty version 2.6.9, created on 2007-11-17 00:49:13
         compiled from /var/www/knowledgeTree/templates/kt3/portlets/admin_categories.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ktLink', '/var/www/knowledgeTree/templates/kt3/portlets/admin_categories.smarty', 3, false),)), $this); ?>
<ul class="actionlist">
   <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aCategory']):
?>
      <li><a href="<?php echo KTSmartyTemplate::ktLink(array('base' => "admin.php",'query' => "action=viewCategory&fCategory=".($this->_tpl_vars['aCategory']['name'])), $this);?>
"><?php echo $this->_tpl_vars['aCategory']['title']; ?>
</a></li>
   <?php endforeach; endif; unset($_from); ?>
</ul>