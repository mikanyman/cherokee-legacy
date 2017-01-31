<?php /* Smarty version 2.6.9, created on 2007-11-17 00:49:13
         compiled from /var/www/knowledgeTree/templates/kt3/admin_categories.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'addQueryString', '/var/www/knowledgeTree/templates/kt3/admin_categories.smarty', 3, false),)), $this); ?>
<dl class="panel_menu">
   <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aCategory']):
?>
   <dt><?php ob_start();  echo $this->_tpl_vars['aCategory']['name'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('cat_id', ob_get_contents());ob_end_clean(); ?><a href="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('addQueryString', true, $_tmp, "action=viewCategory&fCategory=".($this->_tpl_vars['cat_id'])) : KTSmartyTemplate::addQueryString($_tmp, "action=viewCategory&fCategory=".($this->_tpl_vars['cat_id']))); ?>
"><?php echo $this->_tpl_vars['aCategory']['title']; ?>
</a></dt>
   <dd class="descriptiveText"><?php echo $this->_tpl_vars['aCategory']['description']; ?>
</dd>
   <?php endforeach; endif; unset($_from); ?>
</dl>