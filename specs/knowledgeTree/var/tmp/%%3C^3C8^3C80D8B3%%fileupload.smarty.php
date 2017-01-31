<?php /* Smarty version 2.6.9, created on 2007-11-17 01:37:29
         compiled from /var/www/knowledgeTree/templates/kt3/fields/fileupload.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/fields/fileupload.smarty', 2, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%3C^3C8^3C80D8B3%%fileupload.smarty.inc'] = '0f025c316e28d0d701f221bb14d1a3b1'; ?>    <div class="field <?php if (( $this->_tpl_vars['has_errors'] )): ?>error<?php endif; ?>">
      <label for="<?php echo $this->_tpl_vars['name']; ?>
"><?php echo $this->_tpl_vars['label'];  if (( $this->_tpl_vars['required'] === true )): ?><span class="required">(<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0f025c316e28d0d701f221bb14d1a3b1#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Required<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0f025c316e28d0d701f221bb14d1a3b1#0}';}?>)</span><?php endif; ?></label>
      <p class="descriptiveText"><?php echo $this->_tpl_vars['description']; ?>
</p>
      <?php if (( $this->_tpl_vars['has_errors'] )): ?>
      <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sError']):
?>
      <p class="errorMessage">
         <?php echo $this->_tpl_vars['sError']; ?>

      </p>
      <?php endforeach; endif; unset($_from); ?>
      <?php else: ?>
      <p class="errorMessage"></p>
      <?php endif; ?>
      
      <input type="file" name="<?php echo $this->_tpl_vars['name']; ?>
" <?php if ($this->_tpl_vars['has_id']): ?>id="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['options']['width']): ?>size="<?php echo $this->_tpl_vars['options']['width']; ?>
"<?php endif; ?>/>
      <input type="hidden" name="kt_core_fieldsets_expect[<?php echo $this->_tpl_vars['name']; ?>
]" value ="1"  />
     </div>