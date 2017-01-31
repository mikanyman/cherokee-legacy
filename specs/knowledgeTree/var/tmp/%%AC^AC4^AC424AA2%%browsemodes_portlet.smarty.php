<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:06
         compiled from /var/www/knowledgeTree/templates/kt3/portlets/browsemodes_portlet.smarty */ ?>
<ul class="actionlist">
<?php $_from = $this->_tpl_vars['modes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sModeKey'] => $this->_tpl_vars['sModeName']):
?>
   <li><?php if (( $this->_tpl_vars['sModeKey'] == $this->_tpl_vars['current_action'] )): ?>
      <strong><?php echo $this->_tpl_vars['sModeName']['name']; ?>
</strong>
   <?php else: ?>
      <?php if (( $this->_tpl_vars['sModeName']['target'] != null )): ?> <a href="<?php require_once(KT_LIB_DIR .  '/browse/browseutil.inc.php'); print KTBrowseUtil::getBrowseBaseUrl() ?>?action=<?php echo $this->_tpl_vars['sModeName']['target']; ?>
"><?php echo $this->_tpl_vars['sModeName']['name']; ?>
</a>
      <?php else: ?>
        <?php echo $this->_tpl_vars['sModeName']['name']; ?>

      <?php endif; ?>
   <?php endif; ?>
   </li>
<?php endforeach; endif; unset($_from); ?>
</ul>