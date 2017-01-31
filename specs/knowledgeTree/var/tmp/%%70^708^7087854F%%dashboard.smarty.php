<?php /* Smarty version 2.6.9, created on 2007-11-17 00:42:53
         compiled from /var/www/knowledgeTree/templates/kt3/dashboard.smarty */ ?>
<div id="dashboard-container-left">
    <div class="dashboard_block empty" id="start-left">&nbsp;</div>
    <?php $_from = $this->_tpl_vars['dashlets_left']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oDashlet']):
?>
    <div class="dashboard_block" id="<?php echo $this->_tpl_vars['context']->_getDashletId($this->_tpl_vars['oDashlet']); ?>
">
        <div class="<?php echo $this->_tpl_vars['oDashlet']->sClass; ?>
">
            <div class="dashboard_block_icons">
                <a href="#" class="action action_rollup">&nbsp;</a>
                <a href="#" class="action action_close">&nbsp;</a>
            </div>

            <h2 class="dashboard_block_handle"><?php echo $this->_tpl_vars['oDashlet']->sTitle; ?>
</h2>

            <div class="dashboard_block_body">
                <?php echo $this->_tpl_vars['oDashlet']->render(); ?>

            </div>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
    <div class="dashboard_block empty" id="end-left">&nbsp;</div>
</div>

<div id="dashboard-container-right">
    <div class="dashboard_block empty" id="start-right">&nbsp;</div>
    <?php $_from = $this->_tpl_vars['dashlets_right']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oDashlet']):
?>
    <div class="dashboard_block" id="<?php echo $this->_tpl_vars['context']->_getDashletId($this->_tpl_vars['oDashlet']); ?>
">
        <div class="<?php echo $this->_tpl_vars['oDashlet']->sClass; ?>
">
            <div class="dashboard_block_icons">
                <a href="#" class="action action_rollup">&nbsp;</a>
                <a href="#" class="action action_close">&nbsp;</a>
            </div>

            <h2 class="dashboard_block_handle"><?php echo $this->_tpl_vars['oDashlet']->sTitle; ?>
</h2>

            <div class="dashboard_block_body">
                <?php echo $this->_tpl_vars['oDashlet']->render(); ?>

            </div>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?>
    <div class="dashboard_block empty" id="end-right">&nbsp;</div>
</div>

