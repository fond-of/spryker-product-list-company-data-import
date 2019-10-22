<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class ProductListCompanyDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_PRODUCT_LIST_COMPANY = 'product-list-company';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductListCompanyDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        return $this->buildImporterConfiguration(
            $this->getDataImportRootPath() . 'product_list_company.csv',
            static::IMPORT_TYPE_PRODUCT_LIST_COMPANY
        );
    }
}
