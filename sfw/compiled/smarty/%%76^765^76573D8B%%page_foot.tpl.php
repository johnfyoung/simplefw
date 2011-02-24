<?php /* Smarty version 2.6.17, created on 2010-02-26 21:20:09
         compiled from file:/Users/johnyoung/Sites/simplefw/sfw/templates/page_foot.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['foot_js'] )): ?>
<?php $_from = $this->_tpl_vars['foot_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fjs_file']):
?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['fjs_file']; ?>
"></script>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</body>
</html>