<div class="outerwrapper">
 <div id="content_title">{$content_title}</div>
 <div style="width:100%;">
   <table style="margin:0 auto;width:400px; border:1px solid black;"> 
    {if isset($error)}
    <tr>
     <td colspan="2" class="form_login_error">{$error}</td>
    </tr>     
    {/if}
    <tr>
     <td class="form_label">
     	<form id="loginform" name="loginform" action="login.php" onsubmit="" method="post">
     	{$lang_login_username}</td>
     <td class="form_item"><input id="form_login_username" name="form_login_username" type="text" style="width:200px;" /></td>
    </tr>
    <tr>
     <td class="form_label">{$lang_login_password}</td>
     <td class="form_item"><input id="form_login_password" name="form_login_password" type="password" style="width:200px;" /></td>
    </tr>
    <tr>
     <td colspan="2"><input type="submit" name="form_login_submit" value="Submit" /></td>
    </tr>
    <input type="hidden" name="originating_uri" value="{$redirect}" />
   </table>
  </form>
 </div>
</div>