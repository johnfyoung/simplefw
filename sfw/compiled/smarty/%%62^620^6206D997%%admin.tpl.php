<?php /* Smarty version 2.6.17, created on 2010-02-26 21:20:12
         compiled from admin.tpl */ ?>
<div class="outerwrapper">
<div id="content_title"><?php echo $this->_tpl_vars['content_title']; ?>
</div>
<div class="content_body"><?php echo $this->_tpl_vars['welcome_msg']; ?>
</div>
<div class="content_subhead"><?php echo $this->_tpl_vars['section_title']; ?>
</div>
<ul>
<?php $_from = $this->_tpl_vars['tasks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
<li><a href="<?php echo $this->_tpl_vars['t']['url']; ?>
"><?php echo $this->_tpl_vars['t']['label']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</ul>
<div><a href="<?php echo $this->_tpl_vars['logout_href']; ?>
">Logout</a></div>
</div>