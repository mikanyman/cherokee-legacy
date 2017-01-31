<?php /* Smarty version 2.6.9, created on 2007-11-17 00:48:05
         compiled from /var/www/knowledgeTree/templates/ktcore/boolean_search.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/boolean_search.smarty', 50, false),array('modifier', 'default', '/var/www/knowledgeTree/templates/ktcore/boolean_search.smarty', 52, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%45^45E^45E075F4%%boolean_search.smarty.inc'] = 'f989d621b90ac557409421a7550083c7';  echo $this->_tpl_vars['context']->oPage->requireJSResource("resources/js/taillog.js"); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource("resources/js/constructed_search.js"); ?>


<?php echo $this->_tpl_vars['context']->oPage->requireJSResource("resources/js/kt3calendar.js"); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource("thirdpartyjs/jscalendar-1.0/calendar.js"); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource("thirdpartyjs/jscalendar-1.0/lang/calendar-en.js"); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireJSResource("thirdpartyjs/jscalendar-1.0/calendar-setup.js"); ?>

<?php echo $this->_tpl_vars['context']->oPage->requireCSSResource("thirdpartyjs/jscalendar-1.0/calendar-system.css"); ?>


<?php ob_start();  echo '
function testStartup() {
    simpleLog(\'INFO\',\'Log initialised.\');
}

addLoadEvent(testStartup);
'; ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('sJS', ob_get_contents());ob_end_clean();  echo $this->_tpl_vars['context']->oPage->requireJSStandalone($this->_tpl_vars['sJS']); ?>


<?php ob_start();  echo '
fieldset { border: 1px dotted #999; }
legend { border: 1px dotted #999;}

.helpText { color: #666; }

/*   logging support */
#brad-log thead th { border-bottom: 1px solid black; }
#brad-log {font-size: smaller; }
#brad-log .severity-INFO { color: blue; font-weight: bold; }
#brad-log .severity-DEBUG { color: green; font-weight: bold; }
#brad-log .severity-ERROR { color: red; font-weight: bold; }
#brad-log .explanation { font-family: monospace; white-space: pre; }
'; ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('sCSS', ob_get_contents());ob_end_clean();  echo $this->_tpl_vars['context']->oPage->requireCSSStandalone($this->_tpl_vars['sCSS']); ?>


<!-- this is bad, but we really don't need a roundtrip -->
<div style="display: none" id="search-criteria-container">
    <select name="querytype">
        <?php $_from = $this->_tpl_vars['aCriteria']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oCriteria']):
?>  <?php if (( $this->_tpl_vars['oCriteria']->bVisible == true )): ?>
        <option value="<?php echo $this->_tpl_vars['oCriteria']->getNamespace(); ?>
"><?php echo $this->_tpl_vars['oCriteria']->headerDisplay(); ?>
</option>
		<?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
</div>

<?php ob_start();  if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Boolean Search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#0}';} $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('defaulttitle', ob_get_contents());ob_end_clean(); ?>
<h2><?php echo ((is_array($_tmp=@$this->_tpl_vars['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['defaulttitle']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['defaulttitle'])); ?>
</h2>

<form method="POST">
    <input type="hidden" name="action" value="performSearch" />
<?php if ($this->_tpl_vars['sNameTitle']): ?>
    <?php echo $this->_tpl_vars['sNameTitle']; ?>
: <input type="text" name="name" value="" /> <br />
<?php endif; ?>

<?php ob_start(); ?>
<select name="boolean_search[join]"><option value="AND"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>all<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#1}';}?></option><option value="OR"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#2}';}?></option></select>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('options', ob_get_contents());ob_end_clean(); ?>

   <p class="helpText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#3}';}$this->_tag_stack[] = array('i18n', array('arg_options' => $this->_tpl_vars['options'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Return items which match &nbsp;#options# of the <strong>criteria groups</strong> specified.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#3}';}?></p>    
    
    <fieldset>
        <legend><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Criteria Group<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#4}';}?></legend>

	<?php ob_start(); ?>
	<select name="boolean_search[subgroup][0][join]"><option value="AND"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>all<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#5}';}?></option><option value="OR"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#6}';}?></option></select>
	<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('options', ob_get_contents());ob_end_clean(); ?>
        <p class="helpText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#7}';}$this->_tag_stack[] = array('i18n', array('arg_options' => $this->_tpl_vars['options'])); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Return items which match &nbsp;#options# of the criteria specified below.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#7}';}?></p>

        <table class="advanced-search-form">
            <tbody>
                <tr>
                <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#8}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Criteria<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#8}';}?></th>
                <th><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#9}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Values<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#9}';}?></th>
                <th>&nbsp;</th>
                </tr>
                <tr>
                    <td><select name="querytype">
                         <?php $_from = $this->_tpl_vars['aCriteria']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oCriteria']):
?> <?php if (( $this->_tpl_vars['oCriteria']->bVisible == true )): ?>
                             <option value="<?php echo $this->_tpl_vars['oCriteria']->getNamespace(); ?>
"><?php echo $this->_tpl_vars['oCriteria']->headerDisplay(); ?>
</option>
							 <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        </select>
                        </td>
                    <td><p class="helpText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#10}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>first select a type of query<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#10}';}?></p></td>
                    <td><input type="button" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#11}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Add<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#11}';}?>" onclick="addNewCriteria(this);" /></td>                    
                </tr>
            </tbody>
        </table>

    </fieldset>
    
    <input type="button" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#12}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Add another set of criteria<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#12}';}?>" onclick="addBooleanGroup(this)" />
    
    
<?php ob_start();  if ($this->caching && !$this->_cache_including) { echo '{nocache:f989d621b90ac557409421a7550083c7#13}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Search<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:f989d621b90ac557409421a7550083c7#13}';} $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('defaultsubmit', ob_get_contents());ob_end_clean(); ?>
    <input type="submit" name="submit" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['searchButton'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['defaultsubmit']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['defaultsubmit'])); ?>
" />
</form>

<!--
<table id="brad-log" width="100%">
<thead>
    <tr>
        <th width="10%">Severity</th>
        <th width="10%">Time</th>
        <th>Entry</th>
    </tr>
</thead>
<tbody>
   
</tbody>
</table>
-->
