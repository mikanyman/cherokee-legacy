<?php /* Smarty version 2.6.9, created on 2007-11-17 01:37:31
         compiled from /var/www/knowledgeTree/templates/ktcore/metadata/editable_metadata_fieldsets.smarty */ ?>
<?php $_from = $this->_tpl_vars['fieldsets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oFieldset']):
?>
    <?php echo $this->_tpl_vars['oFieldset']->renderEdit($this->_tpl_vars['document_data']); ?>

<?php endforeach; endif; unset($_from); ?>