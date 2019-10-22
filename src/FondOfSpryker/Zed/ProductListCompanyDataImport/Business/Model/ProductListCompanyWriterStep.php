<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model;

use FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\DataSet\ProductListCompanyDataSetInterface;
use Orm\Zed\ProductList\Persistence\SpyProductListCompanyQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductListCompanyWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $this->saveProductListCompany($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    protected function saveProductListCompany(DataSetInterface $dataSet): void
    {
        $productListCompanyEntity = SpyProductListCompanyQuery::create()
            ->filterByFkCompany($dataSet[ProductListCompanyDataSetInterface::ID_COMPANY])
            ->filterByFkProductList($dataSet[ProductListCompanyDataSetInterface::ID_PRODUCT_LIST])
            ->findOneOrCreate();
        
        if ($productListCompanyEntity->isNew() === true) {
            $productListCompanyEntity
                ->setFkProductList($dataSet[ProductListCompanyDataSetInterface::ID_PRODUCT_LIST])
                ->setFkCompany($dataSet[ProductListCompanyDataSetInterface::ID_COMPANY])
                ->save();
        }
    }

}