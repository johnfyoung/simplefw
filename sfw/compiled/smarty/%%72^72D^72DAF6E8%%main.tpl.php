<?php /* Smarty version 2.6.17, created on 2010-02-26 21:20:09
         compiled from main.tpl */ ?>
<div class="outerwrapper">
<div id="content_title"><?php echo $this->_tpl_vars['content_title']; ?>
</div>
<div class="content_body"><?php echo $this->_tpl_vars['welcome_msg']; ?>
</div>
<?php if (isset ( $this->_tpl_vars['link'] )): ?><div class="content_body"><a href="<?php echo $this->_tpl_vars['link']; ?>
"><?php echo $this->_tpl_vars['link_label']; ?>
</a></div><?php endif; ?>
<?php if (isset ( $this->_tpl_vars['logout_link'] )): ?><div class="content_body"><a href="<?php echo $this->_tpl_vars['logout_link']; ?>
"><?php echo $this->_tpl_vars['logout_link_label']; ?>
</a></div><?php endif; ?>
</div>