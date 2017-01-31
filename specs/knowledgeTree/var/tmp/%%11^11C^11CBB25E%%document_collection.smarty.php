<?php /* Smarty version 2.6.9, created on 2007-11-17 00:43:06
         compiled from /var/www/knowledgeTree/templates/kt3/document_collection.smarty */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 19, false),array('block', 'i18n', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 48, false),array('modifier', 'range', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 63, false),array('modifier', 'htmlentities', '/var/www/knowledgeTree/templates/kt3/document_collection.smarty', 107, false),)), $this); ?>
<?php $this->_cache_serials['/var/www/knowledgeTree/var/tmp/%%11^11C^11CBB25E%%document_collection.smarty.inc'] = 'd7a847145deca46919c1f01fd4b026e6'; ?>    <table class="kt_collection" cellspacing="0">
        <thead>
            <tr>
              <?php $_from = $this->_tpl_vars['context']->columns; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oColumn']):
?>
                
                <?php if ($this->_tpl_vars['oColumn']->getSortedOn()): ?>
                  <th class="sort_on sort_<?php echo $this->_tpl_vars['oColumn']->getSortDirection(); ?>
">
                <?php else: ?>
                  <th>
                <?php endif; ?>
                
                <?php echo $this->_tpl_vars['oColumn']->renderHeader($this->_tpl_vars['context']->returnURL); ?>
</th>
              <?php endforeach; endif; unset($_from); ?>
            </tr>
        </thead>
        <tbody>
          <?php if (( $this->_tpl_vars['context']->itemCount != 0 )): ?>
            <?php $_from = $this->_tpl_vars['context']->activeset['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rowiter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rowiter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['folder_row_id']):
        $this->_foreach['rowiter']['iteration']++;
?>            <tr class="<?php echo smarty_function_cycle(array('name' => 'rows','values' => ",odd"), $this);?>
 folder_row">
              <?php $_from = $this->_tpl_vars['context']->columns; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['coliter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['coliter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['oColumn']):
        $this->_foreach['coliter']['iteration']++;
?>
                <td class="browse_column <?php echo $this->_tpl_vars['oColumn']->name; ?>
 <?php if ($this->_tpl_vars['oColumn']->getSortedOn()): ?>sort_on<?php endif; ?>">
                   <?php echo $this->_tpl_vars['oColumn']->renderData($this->_tpl_vars['context']->getFolderInfo($this->_tpl_vars['folder_row_id']['id'])); ?>
 
                </td>
              <?php endforeach; endif; unset($_from); ?>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            
            <?php $_from = $this->_tpl_vars['context']->activeset['documents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rowiter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rowiter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['document_row_id']):
        $this->_foreach['rowiter']['iteration']++;
?>            <tr class="<?php echo smarty_function_cycle(array('name' => 'rows','values' => ",odd"), $this);?>
">
              <?php $_from = $this->_tpl_vars['context']->columns; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['coliter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['coliter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['oColumn']):
        $this->_foreach['coliter']['iteration']++;
?>
                <td class="browse_column <?php echo $this->_tpl_vars['oColumn']->name; ?>
 <?php if ($this->_tpl_vars['oColumn']->getSortedOn()): ?>sort_on<?php endif; ?>">
                   <?php echo $this->_tpl_vars['oColumn']->renderData($this->_tpl_vars['context']->getDocumentInfo($this->_tpl_vars['document_row_id']['id'])); ?>

                </td>
              <?php endforeach; endif; unset($_from); ?>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
          <?php else: ?>
            <tr><td colspan="<?php echo $this->_tpl_vars['columncount']; ?>
"><?php echo $this->_tpl_vars['context']->empty_message; ?>
</td></tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <?php if (( $this->_tpl_vars['bIsBrowseCollection'] )): ?>
                <td colspan="<?php echo $this->_tpl_vars['columncount']-1; ?>
"><span class="descriptiveText">
                <?php else: ?>
                <td colspan="<?php echo $this->_tpl_vars['columncount']; ?>
"><span class="descriptiveText">                
                <?php endif;  if ($this->caching && !$this->_cache_including) { echo '{nocache:d7a847145deca46919c1f01fd4b026e6#0}';}$this->_tag_stack[] = array('i18n', array('arg_itemCount' => $this->_tpl_vars['context']->itemCount,'arg_batchSize' => $this->_tpl_vars['context']->batchSize)); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>#itemCount# items, #batchSize# per page<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:d7a847145deca46919c1f01fd4b026e6#0}';}?></span>
                <span class="collectionNavigation">
                <?php if (( $this->_tpl_vars['pagecount'] > 1 )): ?>
                  <?php if (( $this->_tpl_vars['currentpage'] == 0 )): ?>
                    <span class="notactive">&laquo; prev</a> 
                  <?php else: ?>
                    <a href="<?php echo $this->_tpl_vars['context']->pageLink($this->_tpl_vars['currentpage']-1); ?>
">&laquo; <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:d7a847145deca46919c1f01fd4b026e6#1}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>prev<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:d7a847145deca46919c1f01fd4b026e6#1}';}?></a> 
                  <?php endif; ?>
                    &middot; 
                  <?php if (( $this->_tpl_vars['currentpage'] == $this->_tpl_vars['pagecount']-1 )): ?>
                    <span class="notactive"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:d7a847145deca46919c1f01fd4b026e6#2}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>next<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:d7a847145deca46919c1f01fd4b026e6#2}';}?> &raquo;</a> 
                  <?php else: ?>
                    <a href="<?php echo $this->_tpl_vars['context']->pageLink($this->_tpl_vars['currentpage']+1); ?>
"><?php if ($this->caching && !$this->_cache_including) { echo '{nocache:d7a847145deca46919c1f01fd4b026e6#3}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>next<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:d7a847145deca46919c1f01fd4b026e6#3}';}?> &raquo;</a> 
                  <?php endif; ?>
                  <?php $this->assign('shownEllipsis', false); ?>
                  <?php $_from = ((is_array($_tmp=1)) ? $this->_run_mod_handler('range', true, $_tmp, $this->_tpl_vars['pagecount']) : range($_tmp, $this->_tpl_vars['pagecount'])); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pagecrumbs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pagecrumbs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['showPage']):
        $this->_foreach['pagecrumbs']['iteration']++;
?>
                    <?php $this->assign('showCrumb', false); ?>
                    <?php ob_start();  echo $this->_tpl_vars['showPage']-1-$this->_tpl_vars['currentpage'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('relative', ob_get_contents());ob_end_clean(); ?>
                    <?php if ($this->_foreach['pagecrumbs']['total'] <= 27): ?>
                    <?php $this->assign('showCrumb', true); ?>
                    <?php elseif ($this->_tpl_vars['showPage'] <= 5): ?>
                    <?php $this->assign('showCrumb', true); ?>
                    <?php elseif (abs ( $this->_tpl_vars['relative'] ) <= 5): ?>
                    <?php $this->assign('showCrumb', true); ?>
                    <?php elseif ($this->_tpl_vars['relative'] > 0 && $this->_tpl_vars['relative'] <= 10): ?>
                    <?php $this->assign('showCrumb', true); ?>
                    <?php elseif (abs ( $this->_foreach['pagecrumbs']['total'] - ( $this->_tpl_vars['showPage'] - 1 ) ) <= 3): ?>
                    <?php $this->assign('showCrumb', true); ?>
                    <?php elseif ($this->_tpl_vars['currentpage'] < 13 && $this->_tpl_vars['showPage'] <= 23): ?>
                    <?php $this->assign('showCrumb', true); ?>
                    <?php elseif (( $this->_foreach['pagecrumbs']['total'] - $this->_tpl_vars['currentpage'] ) < 16 && ( $this->_foreach['pagecrumbs']['total'] - $this->_tpl_vars['showPage'] ) < 20): ?>
                    <?php $this->assign('showCrumb', true); ?>
                    <?php endif; ?>

                    <?php if ($this->_tpl_vars['showCrumb']): ?>
                      &middot; 
                      <?php if (( $this->_tpl_vars['showPage']-1 != $this->_tpl_vars['currentpage'] )): ?>
                        <a href="<?php echo $this->_tpl_vars['context']->pageLink($this->_tpl_vars['showPage']-1); ?>
"><?php echo $this->_tpl_vars['showPage']; ?>
</a>
                      <?php else: ?>
                        <span class="batchCurrent"><?php echo $this->_tpl_vars['showPage']; ?>
</span>
                      <?php endif; ?>
                      <?php $this->assign('shownEllipsis', false); ?>
                    <?php else: ?>
                      <?php if (! $this->_tpl_vars['shownEllipsis']): ?>
                        &middot; &hellip;
                        <?php $this->assign('shownEllipsis', true); ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?> 
                </span>
                </td>
                <?php if (( $this->_tpl_vars['bIsBrowseCollection'] )): ?>                
                <td>
                    <select name="perpage" onchange="document_collection_setbatching(this.value, '<?php echo ((is_array($_tmp=$this->_tpl_vars['returnURL'])) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
');">
                    <option value="10" <?php if (( $this->_tpl_vars['batch_size'] == 10 )): ?>selected="true"<?php endif; ?>>10</option>
                    <option value="25" <?php if (( $this->_tpl_vars['batch_size'] == 25 )): ?>selected="true"<?php endif; ?>>25</option>                    
                    <option value="50" <?php if (( $this->_tpl_vars['batch_size'] == 50 )): ?>selected="true"<?php endif; ?>>50</option>                    
                    </select> <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:d7a847145deca46919c1f01fd4b026e6#4}';}$this->_tag_stack[] = array('i18n', array()); KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>per page<?php $_block_content = ob_get_contents(); ob_end_clean(); echo KTSmartyTemplate::i18n_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including) { echo '{/nocache:d7a847145deca46919c1f01fd4b026e6#4}';}?>
                </td>
                <?php endif; ?>
            </tr>
        </tfoot>
    </table>