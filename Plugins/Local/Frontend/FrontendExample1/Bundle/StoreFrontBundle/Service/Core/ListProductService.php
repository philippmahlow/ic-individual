<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace FrontendExample1\Bundle\StoreFrontBundle\Service\Core;

use Shopware\Bundle\StoreFrontBundle\Gateway;
use Shopware\Bundle\StoreFrontBundle\Service;
use Shopware\Bundle\StoreFrontBundle\Struct;

/**
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class ListProductService implements Service\ListProductServiceInterface
{

    /**
     * @var Service\ListProductServiceInterface
     */
    protected $service;

    /**
     * @var Service\CacheInterface
     */
    protected $cacheService;

    /**
     * ListProductService constructor.
     * @param Service\ListProductServiceInterface $service
     * @param Service\CacheInterface $cacheService
     */
    public function __construct(Service\ListProductServiceInterface $service, Service\CacheInterface $cacheService)
    {
        $this->service = $service;
        $this->cacheService = $cacheService;
    }


    /**
     * {@inheritdoc}
     */
    public function get($number, Struct\ProductContextInterface $context)
    {
        $products = $this->getList([$number], $context);

        return array_shift($products);
    }

    /**
     * {@inheritdoc}
     */
    public function getList(array $numbers, Struct\ProductContextInterface $context)
    {
        $cacheKey = 'my-list-' . md5(implode('/', $numbers));

        $cacheResult = $this->cacheService->fetch($cacheKey);

        if($cacheResult) {
            return $cacheResult;
        }

        $result = $this->service->getList($numbers, $context);

        $this->cacheService->save($cacheKey, $result, 60);

        return $result;
    }

}
