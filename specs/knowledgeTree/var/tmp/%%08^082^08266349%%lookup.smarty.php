<?php /* Smarty version 2.6.9, created on 2007-11-17 01:37:29
         compiled from /var/www/knowledgeTree/templates/kt3/fields/lookup.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/fields/lookup.smarty', 2, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%08^082^08266349%%lookup.smarty.inc'] = '80301a5cb48299084d9f476a6b436a0c'; ?>    <div class="field <?php if (( $this->_tpl_vars['has_errors'] )): ?>error<?php endif; ?>">
      <label for="<?php echo $this->_tpl_vars['name']; ?>
"><?php echo $this->_tpl_vars['label'];  if (( $this->_tpl_vars['required'] === true )): ?><span class="required">(<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:80301a5cb48299084d9f476a6b436a0c#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Required<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:80301a5cb48299084d9f476a6b436a0c#0}';}?>)</span><?php endif; ?></label>
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
      
      <select name="<?php echo $this->_tpl_vars['name']; ?>
" <?php if ($this->_tpl_vars['has_id']): ?>id="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['options']['multi']): ?>multiple="true"<?php endif; ?> <?php if ($this->_tpl_vars['options']['size']): ?>size="<?php echo $this->_tpl_vars['options']['size']; ?>
"<?php endif; ?>>
      <?php $_from = $this->_tpl_vars['options']['vocab']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lookup_key'] => $this->_tpl_vars['lookup']):
?>
           <option value="<?php echo $this->_tpl_vars['lookup_key']; ?>
" <?php if (( $this->_tpl_vars['value'] == $this->_tpl_vars['lookup_key'] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lookup']; ?>
</option>
      <?php endforeach; endif; unset($_from); ?>
      </select>
      <input type="hidden" name="kt_core_fieldsets_expect[<?php echo $this->_tpl_vars['name']; ?>
]" value ="1" />
     </div>