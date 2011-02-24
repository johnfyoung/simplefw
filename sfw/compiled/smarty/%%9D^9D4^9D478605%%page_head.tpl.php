<?php /* Smarty version 2.6.17, created on 2010-02-26 21:20:09
         compiled from file:/Users/johnyoung/Sites/simplefw/sfw/templates/page_head.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php if (isset ( $this->_tpl_vars['head_meta'] )): ?>
<?php echo $this->_tpl_vars['head_meta']; ?>

<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['head_css'] )): ?>
<?php echo $this->_tpl_vars['head_css']; ?>

<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['head_js'] )): ?>
<?php echo $this->_tpl_vars['head_js']; ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['head_title']; ?>

</head>
<body <?php if (isset ( $this->_tpl_vars['body_id'] )): ?><?php echo $this->_tpl_vars['body_id']; ?>
 <?php endif; ?><?php if (isset ( $this->_tpl_vars['body_class'] )): ?><?php echo $this->_tpl_vars['body_class']; ?>
 <?php endif; ?><?php if (isset ( $this->_tpl_vars['body_tags'] )): ?><?php echo $this->_tpl_vars['body_tags']; ?>
 <?php endif; ?><?php if (isset ( $this->_tpl_vars['body_onload'] )): ?><?php echo $this->_tpl_vars['body_onload']; ?>
<?php endif; ?>>
