<?php

namespace Shopware\Themes\ShopwareDemo;

use Shopware\Components\Form as Form;

class Theme extends \Shopware\Components\Theme
{
    protected $extend = 'Responsive';

    protected $name = <<<'SHOPWARE_EOD'
Shopware Demo
SHOPWARE_EOD;

    protected $description = <<<'SHOPWARE_EOD'

SHOPWARE_EOD;

    protected $author = <<<'SHOPWARE_EOD'

SHOPWARE_EOD;

    protected $license = <<<'SHOPWARE_EOD'

SHOPWARE_EOD;

    protected $javascript = [
        'src/js/jquery.add-article.js',
        'src/js/test.js'
    ];

    public function createConfig(Form\Container\TabContainer $container)
    {
    }
}