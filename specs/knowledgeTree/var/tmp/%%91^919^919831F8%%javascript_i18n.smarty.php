<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:55
         compiled from /var/www/knowledgeTree/templates/ktcore/javascript_i18n.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'i18n', '/var/www/knowledgeTree/templates/ktcore/javascript_i18n.smarty', 29, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%91^919^919831F8%%javascript_i18n.smarty.inc'] = '8b190156346bcf5018967c50e5e842e2'; ?>
/*
 *  Javascript (actual translations);
 */
 
<?php echo '
var i18n = {};

function _(trans_string) {
    var newstr = i18n[trans_string];
    if (!isUndefinedOrNull(newstr)) { return newstr; } 
    else {
       return trans_string;
    }
}
'; ?>




// strings for file: resources/js/add_document.js

// strings for file: resources/js/adminversiondashlet.js

// strings for file: resources/js/browsehelper.js

// strings for file: resources/js/collectionframe.js

// strings for file: resources/js/conditional_complex_edit.js
i18n['Finish with this column\'s behaviours.'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#0}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Finish with this column\'s behaviours.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#0}';}?>';
i18n['Assuming this field has behaviour "'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Assuming this field has behaviour "<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#1}';}?>';

// strings for file: resources/js/conditional_simple_edit.js
i18n['Dependencies saved. (at '] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Dependencies saved. (at <?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#2}';}?>';
i18n['Dependencies for value "'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Dependencies for value "<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#3}';}?>';
i18n['Now editing field "'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Now editing field "<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#4}';}?>';
i18n['Loading Dependencies for value "'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#5}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Loading Dependencies for value "<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#5}';}?>';

// strings for file: resources/js/conditional_usage.js
i18n['Undo'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#6}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Undo<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#6}';}?>';
i18n['Undo'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#7}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Undo<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#7}';}?>';

// strings for file: resources/js/constructed_search.js
i18n['loading...'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#8}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>loading...<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#8}';}?>';
i18n['Remove'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#9}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Remove<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#9}';}?>';
i18n['first select a type of query'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#10}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>first select a type of query<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#10}';}?>';
i18n['Add'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#11}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Add<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#11}';}?>';
i18n['Criteria Group'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#12}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Criteria Group<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#12}';}?>';
i18n['Criteria'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#13}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Criteria<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#13}';}?>';
i18n['Values'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#14}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Values<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#14}';}?>';
i18n['Return items which match'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#15}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>Return items which match<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#15}';}?>';
i18n['all'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#16}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>all<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#16}';}?>';
i18n['any'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#17}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>any<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#17}';}?>';
i18n['of the criteria specified.'] = '<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:8b190156346bcf5018967c50e5e842e2#18}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>of the criteria specified.<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:8b190156346bcf5018967c50e5e842e2#18}';}?>';

// strings for file: resources/js/constructed_search_postprocess.js

// strings for file: resources/js/dashboard.js

// strings for file: resources/js/help.js

// strings for file: resources/js/jsonlookup.js

// strings for file: resources/js/kt3calendar.js

// strings for file: resources/js/kt-utility.js

// strings for file: resources/js/permissions.js

// strings for file: resources/js/reorder.js

// strings for file: resources/js/taillog.js

// strings for file: resources/js/toggleselect.js
