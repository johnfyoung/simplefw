<!-- begin admin_user content -->
{literal}
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
{/literal}
<div class="outerwrapper">
<div id="content_title">{$content_title}</div>
<div class="content_body">{$welcome_msg}
 <div id="content_breadcrumbs">Back to <a href="admin.php">Admin</a></div></div>
<div><a href="{$logout_href}">Logout</a></div>
{if isset($user_msg)}<p style="color:Orange;">{$user_msg}</p>{/if}
{if isset($error)}
{if is_array($error)}
{foreach from=$error item=e}
<div style="color:Red;">{$e}</div>
{/foreach}
{else}
<div style="color:Red;">{$error}</div>
{/if}
{/if}
<table style="margin:0 auto;border:1px solid black;width:600px;margin-bottom:40px;">
 <tr>
  <td colspan="6" class="table_title">
   {$userlist_label_title}
  </td>
 </tr>
 <tr>
  <td class="table_head" style="width:150px;">{$userlist_label_uname}</td>
  <td class="table_head" style="width:150px;">{$userlist_label_fname}</td>
  <td class="table_head" style="width:150px;">{$userlist_label_lname}</td>
  <td class="table_head" style="width:150px;">{$userlist_label_email}</td>
  <td class="table_head" style="width:150px;">{$userlist_label_nick}</td>
  <td class="table_head" style="width:150px;">{$userlist_label_action}</td>
 </tr>
 {if !empty($users)}
 {foreach from=$users key=k item=u name=userlist}
 <tr>
  <td class="{if $smarty.foreach.userlist.iteration % 2}table_odd{else}table_even{/if}" style="width:150px;">{$u.uname}</td>
  <td class="{if $smarty.foreach.userlist.iteration % 2}table_odd{else}table_even{/if}" style="width:150px;">{$u.fname}</td>
  <td class="{if $smarty.foreach.userlist.iteration % 2}table_odd{else}table_even{/if}" style="width:150px;">{$u.lname}</td>
  <td class="{if $smarty.foreach.userlist.iteration % 2}table_odd{else}table_even{/if}" style="width:150px;">{$u.email}</td>
  <td class="{if $smarty.foreach.userlist.iteration % 2}table_odd{else}table_even{/if}" style="width:150px;">{$u.nick}</td>
  <td class="{if $smarty.foreach.userlist.iteration % 2}table_odd{else}table_even{/if}" style="width:150px;">
   <form name="edit_{$u_uname}" id="edit_{$u_uname}" method="get" action="admin_users.php">
    <input type="submit" value="Edit" />
    <input type="hidden" name="action" value="get" />
    <input type="hidden" name="userid" value="{$k}" />
   </form>
  </td>
 </tr>
 {/foreach}
 {else}
 <tr>
  <td colspan="5">{$userlist_msg_nousers}</td>
 </tr>
 {/if}
</table
<table style="margin:0 auto;border:1px solid black;width:400px;">
 <tr>
  <td colspan="2" class="table_title">
   <form name="userform" id="userform" method="post" action="admin_users.php" onsubmit="return verifyForm();">
   {$userform_label_title}
  </td>
 </tr>
 <tr>
  <td colspan="2" style="width:100px;">* = {$userform_label_inputrequired}</td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;">{$userform_label_uname} *</td>
  <td class="table_odd"><input type="text" name="uname" id="userform_uname" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_even" style="width:100px;">{$userform_label_fname} *</td>
  <td class="table_even"><input type="text" name="fname" id="userform_fname" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;">{$userform_label_lname} *</td>
  <td class="table_odd"><input type="text" name="lname" id="userform_lname" style="width:99%;"/></td>
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
  <td class="table_even"><input type="text" name="email" id="userform_email" style="width:99%;"/></td>
 </tr>
 <tr>
  <td class="table_odd" style="width:100px;">{$userform_label_nick}</td>
  <td class="table_odd"><input type="text" name="nick" id="userform_nick" style="width:99%;"/></td>
 </tr>
  <td colspan="2" style="background-color:#7FADFD; color:#032A6F;text-align:center;">
   <input type="hidden" name="action" value="adduser" />
   <input type="submit" name="submit" value="{$submit}" />
  </td>
</table>
</div>
<!-- end admin_user content -->