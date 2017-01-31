<?php /* Smarty version 2.6.9, created on 2007-11-17 01:37:29
         compiled from /var/www/knowledgeTree/templates/ktcore/folder/bulkUpload.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/folder/bulkUpload.smarty', 57, false),array('modifier', 'addQueryString', '/var/www/knowledgeTree/templates/ktcore/folder/bulkUpload.smarty', 59, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%AE^AEF^AEFF09DD%%bulkUpload.smarty.inc'] = 'ecb3f39d94bd724e4ff1d0c5985a3059';  echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/Base.js'); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/Async.js'); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/Iter.js'); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/DateTime.js'); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('thirdpartyjs/MochiKit/DOM.js'); ?>


<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('resources/js/taillog.js'); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource('resources/js/conditional_usage.js'); ?>


<?php echo $this->_tpl_vars['context']->oPage->requireCSSResource('resources/css/kt-treewidget.css'); ?>


<?php ob_start();  echo '
function swapInItem(elementId, req) {
    
    var cp = getElement(elementId);
    
    cp.innerHTML = req.responseText;
    initialiseConditionalFieldsets();
}

function xmlFailure(err) {
    alert(\'failed\');
}

function swapElementFromRequest(elementId, url) {
    var deff = doSimpleXMLHttpRequest(url);
    var cp = getElement(elementId);
    cp.innerHTML=_("loading...");
    deff.addCallback(partial(swapInItem, elementId));
    
    
}

function getMetadataForType(id) {
    swapElementFromRequest(\'type_metadata_fields\',
        \'';  echo $this->_tpl_vars['rootUrl'];  echo '/presentation/lookAndFeel/knowledgeTree/documentmanagement/getTypeMetadataFields.php?fDocumentTypeID=\'
        + id);
}

function document_type_changed() {
    typeselect = getElement(\'add-document-type\');
    getMetadataForType(typeselect.value);
}

function startupMetadata() {
    typeselect = getElement(\'add-document-type\');
    addToCallStack(typeselect, "onchange", document_type_changed, false);
    document_type_changed();
}

addLoadEvent(startupMetadata);
'; ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('sJavascript', ob_get_contents());ob_end_clean();  echo $this->_tpl_vars['context']->oPage->requireJSStandalone($this->_tpl_vars['sJavascript']); ?>


<h2><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:ecb3f39d94bd724e4ff1d0c5985a3059#0}';}$this->_tag_stack[] = array('i18n', array('arg_foldername' => $this->_tpl_vars['foldername'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Upload files into "#foldername#"<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:ecb3f39d94bd724e4ff1d0c5985a3059#0}';}?></h2>

<form method="POST" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('addQueryString', true, $_tmp, "postExpected=1&fFolderId=") : KTSmartyTemplate::addQueryString($_tmp, "postExpected=1&fFolderId="));  echo $this->_tpl_vars['context']->oFolder->getId(); ?>
" enctype="multipart/form-data">
<fieldset><legend><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:ecb3f39d94bd724e4ff1d0c5985a3059#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Bulk upload<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:ecb3f39d94bd724e4ff1d0c5985a3059#1}';}?></legend>
<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:ecb3f39d94bd724e4ff1d0c5985a3059#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>The bulk upload facility allows for a number
of documents to be added to the document management system.
Provide an archive (ZIP) file from your local computer, and all
documents and folders within that archive will be added to the document
management system.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:ecb3f39d94bd724e4ff1d0c5985a3059#2}';}?></p>

<input type="hidden" name="action" value="upload" />
<input type="hidden" name="fFolderId" value="<?php echo $this->_tpl_vars['context']->oFolder->getId(); ?>
" />

<?php $_from = $this->_tpl_vars['add_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oWidget']):
?>
  <?php echo $this->_tpl_vars['oWidget']->render(); ?>

<?php endforeach; endif; unset($_from); ?>


<p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:ecb3f39d94bd724e4ff1d0c5985a3059#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>If you do not need to modify any the metadata
for this document (see below), then you can simply click "Add" here to finish the
process and add the document.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:ecb3f39d94bd724e4ff1d0c5985a3059#3}';}?></p>
<input type="submit" name="submit" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:ecb3f39d94bd724e4ff1d0c5985a3059#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Add<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:ecb3f39d94bd724e4ff1d0c5985a3059#4}';}?>" />

<hr />


<div id="generic_metadata_fields">
<?php $_from = $this->_tpl_vars['generic_fieldsets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oFieldset']):
?>
    <?php echo $this->_tpl_vars['oFieldset']->renderEdit($this->_tpl_vars['document_data']); ?>

<?php endforeach; endif; unset($_from); ?>
</div>

<div id="type_metadata_fields">
<?php echo $this->_tpl_vars['type_metadata_fields']; ?>

</div>

<div class="form_actions">
  <input type="submit" name="submit" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:ecb3f39d94bd724e4ff1d0c5985a3059#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Upload<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:ecb3f39d94bd724e4ff1d0c5985a3059#5}';}?>" />
</div>
<input type="hidden" name="postReceived" value="1" />
</form>