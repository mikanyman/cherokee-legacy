<?php /* Smarty version 2.6.9, created on 2007-11-17 00:44:32
         compiled from /var/www/knowledgeTree/templates/kt3/fieldsets/generic.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/fieldsets/generic.smarty', 2, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%36^36B^36B73219%%generic.smarty.inc'] = '0a99d8fb2bc35f178282d3994e0a6333'; ?><div class="detail_fieldset">
    <h3><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Generic Information<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#0}';}?></h3>
    <p class="descriptiveText">
        <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The information in this section is stored by KnowledgeTree&trade; for every
        document.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#1}';}?>
    </p>

    <table class="metadatatable" cellspacing="0" cellpadding="5">
    <tr class="even first">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Document Filename<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#2}';}?></th>
        <td><?php echo $this->_tpl_vars['filename']; ?>
 (<?php echo $this->_tpl_vars['context']->_sizeHelper($this->_tpl_vars['document']->getSize()); ?>
)</td>
    </tr>
    
    <tr class="odd">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>File is a<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#3}';}?></th>
        <td><?php echo $this->_tpl_vars['context']->_mimeHelper($this->_tpl_vars['document']->getMimeTypeID()); ?>
</td>
    </tr>

    <tr class="even">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Document Version<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#4}';}?></th>
        <td><?php echo $this->_tpl_vars['document']->getMajorVersionNumber(); ?>
.<?php echo $this->_tpl_vars['document']->getMinorVersionNumber(); ?>
</td>
    </tr>
        
    <tr class="odd">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Created by<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#5}';}?></th>
        <td><?php echo $this->_tpl_vars['creator']; ?>
 (<?php echo $this->_tpl_vars['creation_date']; ?>
)</td>
    </tr>

    <tr class="even">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Owned by<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#6}';}?></th>
        <td><?php echo $this->_tpl_vars['owner']; ?>
</td>
    </tr>

    <tr class="odd">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#7}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Last update by<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#7}';}?></th>
        <td><?php echo $this->_tpl_vars['last_modified_by']; ?>
 (<?php echo $this->_tpl_vars['last_modified_date']; ?>
)</td>
    </tr>

    <tr class="even">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#8}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Document Type<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#8}';}?></th>
        <td><?php echo $this->_tpl_vars['document_type']; ?>
</td>
    </tr>

    <tr class="odd">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#9}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Workflow status<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#9}';}?></th>
        <td>
<?php if ($this->_tpl_vars['workflow_state']):  echo $this->_tpl_vars['workflow_state']->getName(); ?>

<?php else:  if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#10}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>No workflow<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#10}';} endif; ?></td>
    </tr>

    <tr class="even">
        <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:0a99d8fb2bc35f178282d3994e0a6333#11}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Document ID<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:0a99d8fb2bc35f178282d3994e0a6333#11}';}?></th>
        <td><?php echo $this->_tpl_vars['document']->getId(); ?>
</td>
    </tr>

    </table>
</div>