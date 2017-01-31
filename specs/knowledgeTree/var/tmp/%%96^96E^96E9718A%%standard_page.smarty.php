<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/kt3/standard_page.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/standard_page.smarty', 106, false),array('modifier', 'escape', '/var/www/knowledgeTree/templates/kt3/standard_page.smarty', 120, false),array('modifier', 'truncate', '/var/www/knowledgeTree/templates/kt3/standard_page.smarty', 122, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%96^96E^96E9718A%%standard_page.smarty.inc'] = 'be232bb6861fc8d36860772c0deab5f1'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title><?php echo $this->_tpl_vars['page']->title;  if (( $this->_tpl_vars['page']->secondary_title != null )): ?> &mdash; <?php echo $this->_tpl_vars['page']->secondary_title;  endif; ?> | <?php echo $this->_tpl_vars['page']->systemName; ?>
</title>
    
    <!-- CSS Files. -->
    
    <?php $_from = $this->_tpl_vars['page']->getCSSResources(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sResourceURL']):
?>
       <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/<?php echo $this->_tpl_vars['sResourceURL']; ?>
" />
    <?php endforeach; endif; unset($_from); ?>
    
       <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/css/kt-print.css"
           media="print" />

    <link rel="icon" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/graphics/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/graphics/favicon.ico" type="image/x-icon"> 

<?php if ($this->_tpl_vars['refreshTimeout']): ?>
       <meta http-equiv="refresh" content="<?php echo $this->_tpl_vars['refreshTimeout']; ?>
" />
<?php endif; ?>
    
    <!-- evil CSS workarounds - inspired by Plone's approach -->
    <!-- Internet Explorer CSS Fixes -->
    <!--[if lt IE 7]>
        <?php $_from = $this->_tpl_vars['page']->getCSSResourcesForIE(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sResourceURL']):
?>
        <style type="text/css" media="all">@import url(<?php echo $this->_tpl_vars['rootUrl']; ?>
/<?php echo $this->_tpl_vars['sResourceURL']; ?>
);</style>
        <?php endforeach; endif; unset($_from); ?>
    <![endif]-->
    
    <!-- Standalone CSS. -->
    <?php $_from = $this->_tpl_vars['page']->getCSSStandalone(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sCSS']):
?>
       <style>
<?php echo $this->_tpl_vars['sCSS']; ?>

       </style>
    <?php endforeach; endif; unset($_from); ?>

    <!-- Javascript Files. -->
    <?php $_from = $this->_tpl_vars['page']->getJSResources(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sResourceURL']):
?>
       <script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/<?php echo $this->_tpl_vars['sResourceURL']; ?>
"> </script>
    <?php endforeach; endif; unset($_from); ?>

    <!-- Standalone Javascript. -->
    <?php $_from = $this->_tpl_vars['page']->getJSStandalone(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sJavascript']):
?>
       <script type="text/javascript">
<?php echo $this->_tpl_vars['sJavascript']; ?>

       </script>
    <?php endforeach; endif; unset($_from); ?>
    <!--[if IE 7]>
        <style type="text/css" media="all">@import url(<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/css/kt-ie-7.css);</style>
    <![endif]-->
</head>
<body <?php if (( ! $this->_tpl_vars['page']->show_portlets )): ?>class="noportlets"<?php endif; ?>>
<input type="hidden" name="kt-core-baseurl" id="kt-core-baseurl" value="<?php echo $this->_tpl_vars['rootUrl']; ?>
" />
    <div id="pageBody">
        <div id="bodyTopLeft"></div>
        <div id="bodyTopRepeat"></div>
        <div id="bodyTopRight"></div>        
        <div id="bodyPad">
            <div id="logobar">
                <a href="<?php echo $this->_tpl_vars['page']->systemURL; ?>
"><img src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/graphics/ktlogo-topbar-right.png" class="primary" title="<?php echo $this->_tpl_vars['page']->systemName; ?>
"/></a>
                <a href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/"><img src="<?php echo $this->_tpl_vars['config']->get("ui/companyLogo"); ?>
" height="50px" width="<?php echo $this->_tpl_vars['config']->get("ui/companyLogoWidth"); ?>
" alt="<?php echo $this->_tpl_vars['config']->get("ui/companyLogoTitle"); ?>
" title="<?php echo $this->_tpl_vars['config']->get('companyLogoTitle'); ?>
" class="secondary" /></a>
                <div class="floatClear"></div>
            </div>
            <?php if (( ! $this->_tpl_vars['page']->hide_navbar )): ?>
		<div id="navbarBorder">
                    <div id="navbar">
                        <ul>
                            <!-- area menu -->
                            <?php $_from = $this->_tpl_vars['page']->menu; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['aMenuItem']):
?>
                                <?php if (( $this->_tpl_vars['aMenuItem']['active'] == 1 )): ?>
                                    <li class="active"><a href="<?php echo $this->_tpl_vars['aMenuItem']['url']; ?>
"><?php echo $this->_tpl_vars['aMenuItem']['label']; ?>
</a></li>
                                <?php else: ?>
                                    <li><a href="<?php echo $this->_tpl_vars['aMenuItem']['url']; ?>
"><?php echo $this->_tpl_vars['aMenuItem']['label']; ?>
</a></li>
                                <?php endif; ?>
                                    <li><div id="menu_divider"></div></li>
                            <?php endforeach; endif; unset($_from); ?>
        
                            <!-- user menu -->
                            <li class="pref">
                                <?php if (( $this->_tpl_vars['page']->user )): ?>
                                    <span class="ktLoggedInUser"><?php echo $this->_tpl_vars['page']->user->getName(); ?>
</span>
                                <?php endif; ?>
                                <?php if (! empty ( $this->_tpl_vars['page']->userMenu )): ?>
                                    &middot;
                                <?php endif; ?> 
                                <?php $_from = $this->_tpl_vars['page']->userMenu; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prefmenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prefmenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['aMenuItem']):
        $this->_foreach['prefmenu']['iteration']++;
?>
                                    <?php if (( $this->_tpl_vars['aMenuItem']['active'] == 1 )): ?>
                                        <a style='border: 4px solid red;' href="<?php echo $this->_tpl_vars['aMenuItem']['url']; ?>
"><?php echo $this->_tpl_vars['aMenuItem']['label']; ?>
</a>
                                    <?php else: ?>
                                        <a href="<?php echo $this->_tpl_vars['aMenuItem']['url']; ?>
"><?php echo $this->_tpl_vars['aMenuItem']['label']; ?>
</a>
                                    <?php endif; ?>
                                    <?php if (! ($this->_foreach['prefmenu']['iteration'] == $this->_foreach['prefmenu']['total'])): ?>
                                        &middot;
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </li>
                        </ul>
                    </div>
                    <div id="navbarLeft"></div>
                    <div id="navbarRight"></div>
		</div>
            <?php endif; ?>
            <?php if (( ! $this->_tpl_vars['page']->hide_section )): ?>
                <div id="breadcrumbs">
                    <span class="additional"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:be232bb6861fc8d36860772c0deab5f1#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>You are here<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:be232bb6861fc8d36860772c0deab5f1#0}';}?>: </span>
                    <?php if (( $this->_tpl_vars['page']->breadcrumbSection !== false )): ?>
                        <?php if (( $this->_tpl_vars['page']->breadcrumbSection['url'] )): ?>
                            <a href="<?php echo $this->_tpl_vars['page']->breadcrumbSection['url']; ?>
" class="primary"><?php echo $this->_tpl_vars['page']->breadcrumbSection['label']; ?>
</a> 
                        <?php else: ?>
                            <span  class="primary"><?php echo $this->_tpl_vars['page']->breadcrumbSection['label']; ?>
</span> 
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (( ( $this->_tpl_vars['page']->breadcrumbSection !== false ) && ( $this->_tpl_vars['page']->breadcrumbs !== false ) )): ?>
                        &raquo; 
                    <?php endif; ?>
                    <?php if (( $this->_tpl_vars['page']->breadcrumbs !== false )): ?>
                        <?php $_from = $this->_tpl_vars['page']->breadcrumbs; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bc'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bc']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['aCrumb']):
        $this->_foreach['bc']['iteration']++;
?>
                            <?php if (( $this->_tpl_vars['aCrumb']['url'] )): ?>
                                <a href="<?php echo $this->_tpl_vars['aCrumb']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['aCrumb']['label'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a> 
                            <?php else: ?>
                                <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['aCrumb']['label'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...", true) : smarty_modifier_truncate($_tmp, 40, "...", true)); ?>
</span> 
                            <?php endif; ?>
                            <?php if (( ! ($this->_foreach['bc']['iteration'] == $this->_foreach['bc']['total']) )): ?>
                                &raquo;
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    <?php endif; ?>
                    <?php if (( $this->_tpl_vars['page']->breadcrumbDetails !== false )): ?>
                        <span class="additional">(<?php echo $this->_tpl_vars['page']->breadcrumbDetails; ?>
)</span> 
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div id="kt-wrapper">
            <div id="portletbar">
                <?php $_from = $this->_tpl_vars['page']->portlets; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oPortlet']):
?>
                    <?php $this->assign('portlet_output', $this->_tpl_vars['oPortlet']->render()); ?>
                    <?php if ($this->_tpl_vars['portlet_output']): ?>
                        <div class="portlet <?php if ($this->_tpl_vars['oPortlet']->getActive()): ?>expanded<?php endif; ?>">
                            <h4 onclick="toggleElementClass('expanded',this.parentNode)"><?php echo $this->_tpl_vars['oPortlet']->getTitle(); ?>
</h4>
                            <div class="portletTopRepeat"></div>
                            <div class="portletTopRight"></div>
                            <div class="portletbody">
                                <?php echo $this->_tpl_vars['portlet_output']; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <div class="floatClear"></div>
            </div>
            <div id="content" <?php if ($this->_tpl_vars['page']->content_class): ?>class="<?php echo $this->_tpl_vars['page']->content_class; ?>
"<?php endif; ?>>

                <?php if (( ! $this->_tpl_vars['page']->hide_section )): ?>
                    <h1 class="<?php echo $this->_tpl_vars['page']->componentClass; ?>
"><span class="fahrner"><?php echo $this->_tpl_vars['page']->componentLabel; ?>
</span>
                        <?php if (( $this->_tpl_vars['page']->getHelpURL() != null )): ?><a class="ktHelp" href="<?php echo $this->_tpl_vars['page']->getHelpURL(); ?>
">Help</a> <?php endif; ?>
                    </h1>
                <?php endif; ?>

                <!-- any status / error messages get added here. -->
                <?php if (( ! empty ( $this->_tpl_vars['page']->errStack ) )): ?>
                    <div class="ktError">
                        <?php $_from = $this->_tpl_vars['page']->errStack; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sError']):
?>
                            <p><?php echo $this->_tpl_vars['sError']; ?>
</p>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                <?php endif; ?>

                <?php if (( ! empty ( $this->_tpl_vars['page']->infoStack ) )): ?>
                    <div class="ktInfo">
                        <?php $_from = $this->_tpl_vars['page']->infoStack; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sInfo']):
?>
                            <p><?php echo $this->_tpl_vars['sInfo']; ?>
</p>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                <?php endif; ?>
                <!-- and finally, the content. -->
                <?php echo $this->_tpl_vars['page']->contents; ?>

                <div class="floatClear"></div>
	    </div>
        </div>
        <div id="pageBodyBg"></div>
        <div id="bodyLeftRepeatTop"></div>
        <div id="bodyLeftRepeatQuartTop"></div>
        <div id="bodyLeftRepeatMiddleTop"></div>
        <div id="bodyLeftRepeatMiddleBottom"></div>
        <div id="bodyLeftRepeatQuartBottom"></div>
        <div id="bodyLeftRepeatBottom"></div>
        <div id="bodyRightRepeatTop"></div>
        <div id="bodyRightRepeatQuartTop"></div>
        <div id="bodyRightRepeatMiddleTop"></div>
        <div id="bodyRightRepeatMiddleBottom"></div>
        <div id="bodyRightRepeatQuartBottom"></div>
        <div id="bodyRightRepeatBottom"></div>
        <div id="bodyBottomRepeat"></div>
        <div id="bodyBottomRight"></div>
        <div id="bodyBottomLeft"></div>
    </div>
    <div id="copyrightbarBorder">
        <div id="copyrightbarLeft"></div>
        <div id="copyrightbarRight"></div>
        <div id="copyrightbarBg"></div>
        <div id="copyrightbar">
            <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:be232bb6861fc8d36860772c0deab5f1#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>&copy; 2006 <a href="http://www.ktdms.com/">The Jam Warehouse Software (Pty) Ltd.</a> All Rights Reserved<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:be232bb6861fc8d36860772c0deab5f1#1}';}?>
            &mdash; <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:be232bb6861fc8d36860772c0deab5f1#2}';}$this->_tag_stack[] = array('i18n', array('arg_version' => ($this->_tpl_vars['versionname']))); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>KnowledgeTree Version: #version#<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:be232bb6861fc8d36860772c0deab5f1#2}';}?> &mdash; <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:be232bb6861fc8d36860772c0deab5f1#3}';}$this->_tag_stack[] = array('i18n', array('arg_timing' => $this->_tpl_vars['page']->getReqTime())); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Request created in #timing#s<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:be232bb6861fc8d36860772c0deab5f1#3}';}?>
            <?php echo $this->_tpl_vars['page']->getDisclaimer(); ?>

        </div>
    </div>    
</body>
</html>