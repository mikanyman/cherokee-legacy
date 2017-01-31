<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:12
         compiled from /var/www/knowledgeTree/templates/ktcore/forms/widgets/base.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/forms/widgets/base.smarty', 2, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%82^829^82979059%%base.smarty.inc'] = 'dd90dab4c36f959efdd5aeccb1d53b41'; ?>    <div class="field <?php if (( $this->_tpl_vars['has_errors'] )): ?>error<?php endif; ?>">
      <label for="<?php echo $this->_tpl_vars['name']; ?>
"><?php echo $this->_tpl_vars['label'];  if (( $this->_tpl_vars['required'] === true )): ?><span class="required">(<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:dd90dab4c36f959efdd5aeccb1d53b41#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Required<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:dd90dab4c36f959efdd5aeccb1d53b41#0}';}?>)</span><?php endif; ?></label>
      <?php if (( $this->_tpl_vars['description'] )): ?><p class="descriptiveText"><?php echo $this->_tpl_vars['description']; ?>
</p><?php endif; ?>
      <?php if (( $this->_tpl_vars['options']['important_description'] )): ?><p class="descriptiveText important"><?php echo $this->_tpl_vars['options']['important_description']; ?>
</p><?php endif; ?>
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

        <?php echo $this->_tpl_vars['widget']; ?>


     </div>