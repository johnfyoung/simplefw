<?php /* Smarty version 2.6.17, created on 2010-02-26 21:20:28
         compiled from admin_users.tpl */ ?>
<!-- begin admin_user content -->
<?php echo '
<script type="text/javascript">
  function verifyForm()
  {
  	if(isNotEmpty(document.userform.userform_uname,true))
  	{
  	  if(isNotEmpty(document.userform.userform_fname,true))
  	  {
  	    if(isNotEmpty(document.userform.userform_lname,true))
  	    {
  	      if(isPassword(document.userform.userform_password,true))
  	      {
  	        if(isEmailAddr(document.userform.userform_email,true))
  	        {
  	          return true;
  	        }
  	      }
  	    }
  	  }
  	}
    return false;
  }
</script>
'; ?>

<div class="outerwrapper">
<div id="content_title"><?php echo $this->_tpl_vars['content_title']; ?>
</div>
<div class="content_body"><?php echo $this->_tpl_vars['welcome_msg']; ?>

 <div id="content_breadcrumbs">Back to <a href="admin.php">Admin</a></div></div>
<div><a href="<?php echo $this->_tpl_vars['logout_href']; ?>
">Logout</a></div>
<?php if (isset ( $this->_tpl_vars['user_msg'] )): ?><p style="color:Orange;"><?php echo $this->_tpl_vars['user_msg']; ?>
</p><?php endif; ?>
<?php if (isset ( $this->_tpl_vars['error'] )): ?>
<?php if (is_array ( $this->_tpl_vars['error'] )): ?>
<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
<div style="color:Red;"><?php echo $this->_tpl_vars['e']; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<div style="color:Red;"><?php echo $this->_tpl_vars['error']; ?>
</div>
<?php endif; ?>
<?php endif; ?>
<table style="margin:0 auto;border:1px solid black;width:600px;margin-bottom:40px;">
 <tr>
  <td colspan="6" class="table_title">
   <?php echo $this->_tpl_vars['userlist_label_title']; ?>

  </td>
 </tr>
 <tr>
  <td class="table_head" style="width:150px;"><?php echo $this->_tpl_vars['userlist_label_uname']; ?>
</td>
  <td class="table_head" style="width:150px;"><?php echo $this->_tpl_vars['userlist_label_fname']; ?>
</td>
  <td class="table_head" style="width:150px;"><?php echo $this->_tpl_vars['userlist_label_lname']; ?>
</td>
  <td class="table_head" style="width:150px;"><?php echo $this->_tpl_vars['userlist_label_email']; ?>
</td>
  <td class="table_head" style="width:150px;"><?php echo $this->_tpl_vars['userlist_label_nick']; ?>
</td>
  <td class="table_head" style="width:150px;"><?php echo $this->_tpl_vars['userlist_label_action']; ?>
</td>
 </tr>
 <?php if (! empty ( $this->_tpl_vars['users'] )): ?>
 <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['userlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['userlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['u']):
        $this->_foreach['userlist']['iteration']++;
?>
 <tr>
  <td class="<?php if ($this->_foreach['userlist']['iteration'] % 2): ?>table_odd<?php else: ?>table_even<?php endif; ?>" style="width:150px;"><?php echo $this->_tpl_vars['u']['uname']; ?>
</td>
  <td class="<?php if ($this->_foreach['userlist']['iteration'] % 2): ?>table_odd<?php else: ?>table_even<?php endif; ?>" style="width:150px;"><?php echo $this->_tpl_vars['u']['fname']; ?>
</td>
  <td class="<?php if ($this->_foreach['userlist']['iteration'] % 2): ?>table_odd<?php else: ?>table_even<?php endif; ?>" style="width:150px;"><?php echo $this->_tpl_vars['u']['lname']; ?>
</td>
  <td class="<?php if ($this->_foreach['userlist']['iteration'] % 2): ?>table_odd<?php else: ?>table_even<?php endif; ?>" style="width:150px;"><?php echo $this->_tpl_vars['u']['email']; ?>
</td>
  <td class="<?php if ($this->_foreach['userlist']['iteration'] % 2): ?>table_odd<?php else: ?>table_even<?php endif; ?>" style="width:150px;"><?php echo $this->_tpl_vars['u']['nick']; ?>
</td>
  <td class="<?php if ($this->_foreach['userlist']['iteration'] % 2): ?>table_odd<?php else: ?>table_even<?php endif; ?>" style="width:150px;">
   <form name="edit_<?php echo $this->_tpl_vars['u_uname']; ?>
" id="edit_<?php echo $this->_tpl_vars['u_uname']; ?>
" method="get" action="admin_users.php">
    <input type="submit" value="Edit" />
    <input type="hidden" name="action" value="get" />
    <input type="hidden" name="userid" value="<?php echo $this->_tpl_vars['k']; ?>
" />
   </form>
  </td>
 </tr>
 <?php endforeach; endif; unset($_from); ?>
 <?php else: ?>
 <tr>
  <td colspan="5"><?php echo $this->_tpl_vars['userlist_msg_nousers']; ?>
</td>
 </tr>
 <?php endif; ?>
</table
<table style="margin:0 auto;border:1px solid black;width:400px;">
 <tr>
  <td colspan="2" class="table_title">
   <form name="userform" id="userform" method="post" action="admin_users.php" onsubmit="return verifyForm();">
   <?php echo $this->_tpl_vars['userform_label_title']; ?>

  </td>
 </tr>
 <tr>
  <td colspan="2" style="width:100px;">* = <?php echo $this->_tpl_vars['userform_label_inputrequired']; ?>
</td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;"><?php echo $this->_tpl_vars['userform_label_uname']; ?>
 *</td>
  <td class="table_odd"><input type="text" name="uname" id="userform_uname" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_even" style="width:100px;"><?php echo $this->_tpl_vars['userform_label_fname']; ?>
 *</td>
  <td class="table_even"><input type="text" name="fname" id="userform_fname" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;"><?php echo $this->_tpl_vars['userform_label_lname']; ?>
 *</td>
  <td class="table_odd"><input type="text" name="lname" id="userform_lname" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_even" style="width:100px;"><?php echo $this->_tpl_vars['userform_label_password']; ?>
 *</td>
  <td class="table_even"><input type="password" name="password" id="userform_password" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;"><?php echo $this->_tpl_vars['userform_label_passwordconfirm']; ?>
 *</td>
  <td class="table_odd"><input type="password" name="passwordconfirm" id="userform_passwordconfirm" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_even" style="width:100px;"><?php echo $this->_tpl_vars['userform_label_email']; ?>
 *</td>
  <td class="table_even"><input type="text" name="email" id="userform_email" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;"><?php echo $this->_tpl_vars['userform_label_nick']; ?>
</td>
  <td class="table_odd"><input type="text" name="nick" id="userform_nick" style="width:99%;"/></td>
 </tr>
  <td colspan="2" style="background-color:#7FADFD; color:#032A6F;text-align:center;">
   <input type="hidden" name="action" value="adduser" />
   <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['submit']; ?>
" />
  </td>
</table>
</div>
<!-- end admin_user content -->