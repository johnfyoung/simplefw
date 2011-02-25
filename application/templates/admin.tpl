<div class="outerwrapper">
<div id="content_title">{$content_title}</div>
<div class="content_body">{$welcome_msg}</div>
<div class="content_subhead">{$section_title}</div>
<ul>
{foreach from=$tasks item=t}
<li><a href="{$t.url}">{$t.label}</a>
{/foreach}
</ul>
<div><a href="{$logout_href}">Logout</a></div>
</div>