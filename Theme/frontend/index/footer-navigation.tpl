{extends file="parent:frontend/index/footer-navigation.tpl"}

{*
{block name="frontend_index_footer_column_newsletter" append}
   Danach
{/block}
*}

{*
{block name="frontend_index_footer_column_newsletter" prepend}
    Davor
{/block}
*}

{block name="frontend_index_footer_column_newsletter"}
    {*
    {s name="PreBlockExample"}Davor2{/s}
    {$smarty.block.parent}
    {s name="IndexSearchFieldPlaceholder" namespace="frontend/index/search"}{/s}


    {action module=widgets controller=checkout action=info}

    {url controller=checkout action=cart}?test=123

    <img src="{link file="frontend/_public/src/img/dummyimage.png"}" />
*}

    <form action="{url controller=test action=test}" method="POST">
        <input name="test" />
        <button type="submit">Absenden</button>
    </form>
{/block}