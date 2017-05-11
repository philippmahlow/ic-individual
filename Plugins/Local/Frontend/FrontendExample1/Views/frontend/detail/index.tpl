{extends file="parent:frontend/detail/index.tpl"}

{block name='frontend_detail_index_name' append}
    Foo: {$sArticle.foo}
{/block}