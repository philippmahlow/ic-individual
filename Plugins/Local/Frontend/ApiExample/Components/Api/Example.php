<?php

namespace ApiExample\Components\Api;

use Doctrine\ORM\EntityRepository;
use Shopware\Components\Api\Resource\Resource;
use Shopware\Components\Api\Exception as ApiException;

class Example extends Resource
{
    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->getManager()->getRepository(\Shopware\CustomModels\ApiExample\Example::class);
    }

    /**
     * @param int $id
     *
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     *
     * @return array|\Shopware\CustomModels\ApiExample\Example
     */
    public function getOne($id)
    {
        $this->checkPrivilege('read');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        $builder = $this->getRepository()
            ->createQueryBuilder('example')
            ->select('example')
            ->where('example.id = ?1')
            ->setParameter(1, $id);

        /** @var \Shopware\CustomModels\ApiExample\Example $example */
        $example = $builder->getQuery()->getOneOrNullResult($this->getResultMode());

        if (!$example) {
            throw new ApiException\NotFoundException("Example by id $id not found");
        }

        return $example;
    }

    /**
     * @param int $offset
     * @param int $limit
     * @param array $criteria
     * @param array $orderBy
     *
     * @return array
     */
    public function getList($offset = 0, $limit = 25, array $criteria = [], array $orderBy = [])
    {
        $this->checkPrivilege('read');

        $builder = $this->getRepository()->createQueryBuilder('example');

        $builder->addFilter($criteria)
            ->addOrderBy($orderBy)
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        $query = $builder->getQuery();
        $query->setHydrationMode($this->resultMode);

        $paginator = $this->getManager()->createPaginator($query);

        $totalResult = $paginator->count();

        $shops = $paginator->getIterator()->getArrayCopy();

        return ['data' => $shops, 'total' => $totalResult];
    }

    /**
     * @param array $params
     *
     * @throws \Shopware\Components\Api\Exception\ValidationException
     * @throws \Exception
     *
     * @return \Shopware\CustomModels\ApiExample\Example
     */
    public function create(array $params)
    {
        $this->checkPrivilege('create');

        $params = $this->prepareExampleData($params);

        $example = new \Shopware\CustomModels\ApiExample\Example();
        $example->fromArray($params);

        $violations = $this->getManager()->validate($example);
        if ($violations->count() > 0) {
            throw new ApiException\ValidationException($violations);
        }

        $this->getManager()->persist($example);
        $this->flush();

        return $example;
    }

    /**
     * @param int $id
     * @param array $params
     *
     * @throws \Shopware\Components\Api\Exception\ValidationException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\CustomValidationException
     *
     * @return \Shopware\CustomModels\ApiExample\Example
     */
    public function update($id, array $params)
    {
        $this->checkPrivilege('update');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        /** @var $example \Shopware\CustomModels\ApiExample\Example */
        $example = $this->getRepository()->find($id);

        if (!$example) {
            throw new ApiException\NotFoundException("Example by id $id not found");
        }

        $params = $this->prepareExampleData($params, $example);
        $example->fromArray($params);

        $violations = $this->getManager()->validate($example);
        if ($violations->count() > 0) {
            throw new ApiException\ValidationException($violations);
        }

        $this->flush();

        return $example;
    }

    /**
     * @param int $id
     *
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     *
     * @return \Shopware\CustomModels\ApiExample\Example
     */
    public function delete($id)
    {
        $this->checkPrivilege('delete');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        /** @var $example \Shopware\CustomModels\ApiExample\Example */
        $example = $this->getRepository()->find($id);

        if (!$example) {
            throw new ApiException\NotFoundException("Example by id $id not found");
        }

        $this->getManager()->remove($example);
        $this->flush();

        return $example;
    }

    private function prepareExampleData($params, $example = null)
    {
        $requiredParams = ['name'];
        foreach ($requiredParams as $param) {
            if (!$example) {
                if (!isset($params[$param]) || empty($params[$param])) {
                    throw new ApiException\ParameterMissingException($param);
                }
            } else {
                if (isset($params[$param]) && empty($params[$param])) {
                    throw new \Exception('param $param may not be empty');
                }
            }
        }

        return $params;
    }
}