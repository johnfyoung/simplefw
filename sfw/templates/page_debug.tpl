<!-- debug text -->
<table style="background-color:#EBB641; color:#DEC3AD; border:1px dashed white; margin:0 auto; margin-top:20px;" cellpadding="0" cellspacing="0">
<tr>
 <td colspan="2" style="background-color:#8A2A1A;text-align:center;border-bottom:2px solid Yellow;padding:10px 10px 0 10px;font-size:16pt;">SFW DEBUG VALUES</td>
</tr>
{foreach from=$sfw_debug key=k item=v}
<tr>
 <td style="color:#8A2A1A; padding:10px 10px 0 10px; border-right:1px solid Yellow; border-bottom:1px solid Yellow;">{$k}</td>
 <td style="color:#8A2A1A; padding-left:20px; border-bottom:1px solid Yellow;">{$v}</td>
</tr>
{/foreach}
</table>
<!-- end debug -->