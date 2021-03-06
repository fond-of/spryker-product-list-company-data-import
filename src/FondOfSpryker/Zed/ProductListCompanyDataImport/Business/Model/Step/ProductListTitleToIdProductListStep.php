<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\Step;

use FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\DataSet\ProductListCompanyDataSetInterface;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Exception\InvalidDataException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductListTitleToIdProductListStep implements DataImportStepInterface
{
    /**
     * @var int[]
     */
    protected $idProductListCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\InvalidDataException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $productListTitle = $dataSet[ProductListCompanyDataSetInterface::PRODUCT_LIST];
        if (!$productListTitle) {
            throw new InvalidDataException(sprintf('"%s" is required.', ProductListCompanyDataSetInterface::PRODUCT_LIST));
        }

        $dataSet[ProductListCompanyDataSetInterface::ID_PRODUCT_LIST] = $this->getIdProductListByTitle($productListTitle);
    }

    /**
     * @param string $productListTitle
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function getIdProductListByTitle(string $productListTitle): int
    {
        if (!isset($this->idProductListCache[$productListTitle])) {
            /** @var \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery */
            $productListQuery = SpyProductListQuery::create()->select(SpyProductListTableMap::COL_ID_PRODUCT_LIST);

            /** @var int|null $idProductList */
            $idProductList = $productListQuery->findOneByTitle($productListTitle);

            if (!$idProductList) {
                throw new EntityNotFoundException(sprintf('Could not find Product List by title "%s"', $productListTitle));
            }
            $this->idProductListCache[$productListTitle] = $idProductList;
        }

        return $this->idProductListCache[$productListTitle];
    }
}
