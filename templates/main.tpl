<div class="outerwrapper">
<div id="content_title">{$content_title}</div>
<div class="content_body">{$welcome_msg}</div>
{if isset($link)}<div class="content_body"><a href="{$link}">{$link_label}</a></div>{/if}
{if isset($logout_link)}<div class="content_body"><a href="{$logout_link}">{$logout_link_label}</a></div>{/if}
</div>