{if isset($foot_js)}
{foreach from=$foot_js item=fjs_file}
<script type="text/javascript" src="{$fjs_file}"></script>
{/foreach}
{/if}
</body>
</html>