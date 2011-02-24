<!-- begin admin_user content -->
{literal}
<script type="text/javascript">
  function verifyForm()
  {
    var success = false;
  	if(isNotEmpty(document.userform.userform_uname,true))
  	{
  	  if(isNotEmpty(document.userform.userform_fname,true))
  	  {
  	    if(isNotEmpty(document.userform.userform_lname,true))
  	    {
          if(isEmailAddr(document.userform.userform_email,true))
  	      {
  	        success = true;
  	      }
  	    }
  	  }
  	}
  	
  	if(success == true && isNotEmpty(document.userform.userform_password))
  	{
  	  if(!isPassword(document.userform.userform_password,true))
  	  {
        success = false;
  	  }
  	}
    return success;
  }
</script>
{/literal}
<div class="outerwrapper">
<div id="content_title">{$content_title}</div>
<div class="content_body">{$welcome_msg}
 <div id="content_breadcrumbs">Back to <a href="admin.php">Admin</a>&nbsp;&gt;&nbsp;<a href="admin_users.php">User List</a></div></div>
<div><a href="{$logout_href}">Logout</a></div>
{if isset($error)}
<div style="color:Red;">{$error}</div>
{/if}
<table style="margin:0 auto;border:1px solid black;width:400px;">
 <tr>
  <td colspan="2" class="table_title">
   <form name="userform" id="adduserform" method="post" action="admin_users.php" onsubmit="return verifyForm();">
   {$userform_label_title}
  </td>
 </tr>
  <tr>
  <td colspan="2" style="width:100px;">* = {$userform_label_inputrequired}</td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;">{$userform_label_uname} *</td>
  <td class="table_odd"><input type="text" name="uname" id="userform_uname" style="width:99%;" value="{$user.uname}"/></td>
 </tr>
 <tr>
  <td class="table_even" style="width:100px;">{$userform_label_fname} *</td>
  <td class="table_even"><input type="text" name="fname" id="userform_fname" style="width:99%;" value="{$user.fname}"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;">{$userform_label_lname} *</td>
  <td class="table_odd"><input type="text" name="lname" id="userform_lname" style="width:99%;" value="{$user.lname}"/></td>
 </tr>
 <tr>
  <td class="table_even" style="width:100px;">{$userform_label_password} *</td>
  <td class="table_even"><input type="password" name="password" id="userform_password" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;">{$userform_label_passwordconfirm} *</td>
  <td class="table_odd"><input type="password" name="passwordconfirm" id="userform_passwordconfirm" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_even" style="width:100px;">{$userform_label_email} *</td>
  <td class="table_even"><input type="text" name="email" id="userform_email" style="width:99%;" value="{$user.email}"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;">{$userform_label_nick}</td>
  <td class="table_odd"><input type="text" name="nick" id="userform_nick" style="width:99%;" value="{$user.nick}"/></td>
 </tr>
  <td colspan="2" style="background-color:#7FADFD; color:#032A6F;text-align:center;">
   <input type="hidden" name="action" value="edit" />
   <input type="submit" name="submit" value="{$submit}" />
   <input type="hidden" name="oldpassword" id="userform_oldpassword" value="{$user.password}" />
   <input type="hidden" name="userid" value="{$userid}" />   
  </td>
</table>
</div>