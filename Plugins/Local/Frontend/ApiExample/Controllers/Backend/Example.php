<?php

class Shopware_Controllers_Backend_Example
    extends Shopware_Controllers_Backend_Application
{
    protected $model = \Shopware\CustomModels\ApiExample\Example::class;

    protected $alias = 'example';

    protected function getListQuery()
    {
        $qb = parent::getListQuery();

        $qb->addSelect('supplier');
        $qb->leftJoin('example.supplier', 'supplier');

        $qb->addSelect('media');
        $qb->leftJoin('example.media', 'media');
        return $qb;
    }

    protected function getDetailQuery($id)
    {
        $qb = parent::getDetailQuery($id);

        $qb->addSelect('supplier');
        $qb->leftJoin('example.supplier', 'supplier');

        $qb->addSelect('media');
        $qb->leftJoin('example.media', 'media');
        return $qb;
    }


}