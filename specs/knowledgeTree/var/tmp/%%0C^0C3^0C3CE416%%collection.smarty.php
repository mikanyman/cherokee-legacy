<?php /* Smarty version 2.6.9, created on 2007-11-17 00:50:51
         compiled from /var/www/knowledgeTree/templates/ktcore/forms/widgets/collection.smarty */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/css/kt-framing.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/css/kt-contenttypes.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/css/kt-headings.css" />
<!--[if lt IE 7]><style type="text/css" media="all">@import url(<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/css/kt-ie-icons.css);</style><![endif]-->    
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/thirdpartyjs/MochiKit/Base.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/thirdpartyjs/MochiKit/Iter.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/thirdpartyjs/MochiKit/DOM.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/thirdpartyjs/MochiKit/Logging.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/thirdpartyjs/MochiKit/Async.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/thirdpartyjs/MochiKit/Signal.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/js/kt-utility.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/resources/js/toggleselect.js"> </script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['rootUrl']; ?>
/presentation/i18nJavascript.php"> </script>
</head>

<body class="browse_body">
<div class="noportlets">
<div id="content">

<input type="hidden" name="<?php echo $this->_tpl_vars['targetname']; ?>
" value="<?php echo $this->_tpl_vars['folder']->getId(); ?>
" />

<?php $_from = $this->_tpl_vars['breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bc'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bc']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['breadcrumb']):
        $this->_foreach['bc']['iteration']++;
?>
<a href="<?php echo $this->_tpl_vars['breadcrumb']['url']; ?>
"><?php echo $this->_tpl_vars['breadcrumb']['name']; ?>
</a>
<?php if (! ($this->_foreach['bc']['iteration'] == $this->_foreach['bc']['total'])): ?>
&raquo;
<?php endif;  endforeach; endif; unset($_from);  echo $this->_tpl_vars['collection']->render(); ?>

</div>
</div>

</body>
</html>