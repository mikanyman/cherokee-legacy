<?php /* Smarty version 2.6.9, created on 2007-11-17 00:37:52
         compiled from /var/www/knowledgeTree/templates/ktcore/login.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/login.smarty', 5, false),array('modifier', 'escape', '/var/www/knowledgeTree/templates/ktcore/login.smarty', 23, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%D2^D21^D21921A2%%login.smarty.inc'] = 'c382b6ad17014622a5bb81d0e6ca9d6c'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Login<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#0}';}?> | KnowledgeTree</title>
    
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/css/kt-login.css" type="text/css" />


    <link rel="icon" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/graphics/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/graphics/favicon.ico" type="image/x-icon"> 

</head>
<body onload="document.getElementById('username').focus()">

    <div id="loginbox" <?php if (( $this->_tpl_vars['disclaimer'] )): ?> class="hasDisclaimer" <?php endif; ?>>

        <div id="formbox">

	    <form action="<?php echo $_SERVER['PHP_SELF']; ?>
" method="POST" name="login">
	        <input type="hidden" name="action" value="login" />
		<input type="hidden" name="cookieverify" value="<?php echo $this->_tpl_vars['cookietest']; ?>
" />
		<input type="hidden" name="redirect" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['redirect'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		<img src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/graphics/ktlogo-topbar-right.png" alt="KnowledgeTree DMS" class="logoimage" height="50" width="252"/><br />
            
	        <?php if (( $this->_tpl_vars['errorMessage'] == null )): ?>
		    <p class="descriptiveText"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Please enter your details below to login.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#1}';}?></p>
		<?php else: ?>
		    <div class="ktError"><p><?php echo $this->_tpl_vars['errorMessage']; ?>
</p></div>
		<?php endif; ?>
            
	        <label for="username"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#2}';}?></label>
		<input type="text" id="username" name="username"/>
		
		<label for="password"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#3}';}?></label>
		<input type="password" id="password" name="password"/>

		<label for="language"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Language<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#4}';}?></label>
		<select id="language" name="language">
		<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sLang'] => $this->_tpl_vars['sLanguageName']):
?>
		    <option value="<?php echo $this->_tpl_vars['sLang']; ?>
" <?php if ($this->_tpl_vars['sLang'] == $this->_tpl_vars['selected_language']): ?>SELECTED="yes"<?php endif; ?>><?php echo $this->_tpl_vars['sLanguageName']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
            
	        <div class="form_actions">
                    <input type="submit" value="<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>login<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#5}';}?>" />
		</div>
            </form>
	</div>
        <?php if (( $this->_tpl_vars['disclaimer'] )): ?>
        <div id="disclaimerbox">
	    <?php echo $this->_tpl_vars['disclaimer']; ?>

	</div>
	<?php endif; ?>

	<span class="descriptiveText version">
	<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>KnowledgeTree Version<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#6}';}?><br /><?php echo $this->_tpl_vars['versionName']; ?>
<br/>
	<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c382b6ad17014622a5bb81d0e6ca9d6c#7}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>&copy; 2006 <a href="http://www.knowledgetree.com/">The Jam Warehouse Software (Pty) Ltd.</a> All Rights Reserved<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:c382b6ad17014622a5bb81d0e6ca9d6c#7}';}?> 
	</span>
        <div id="bottomspacer"></div>
        <div id="loginboxTopLeft"></div>
        <div id="loginboxTopMiddle"></div>
        <div id="loginboxTopRight"></div>
        <div id="loginboxBottomLeft"></div>
        <div id="loginboxBottomMiddle"></div>
        <div id="loginboxBottomRight"></div>
        <div id="loginboxLeftTop"></div>
        <div id="loginboxRightTop"></div>
        <div id="loginboxLeftBottom"></div>
        <div id="loginboxRightBottom"></div>

    </div>




</body>
</html>