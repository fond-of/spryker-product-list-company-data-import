<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport\Communication\Plugin;

use FondOfSpryker\Zed\ProductListCompanyDataImport\ProductListCompanyDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductListDataImport\ProductListDataImportConfig;

/**
 * @method \FondOfSpryker\Zed\ProductListCompanyDataImport\Business\ProductListCompanyDataImportFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ProductListCompanyDataImport\ProductListCompanyDataImportConfig getConfig()
 */
class ProductListCompanyDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFacade()->importProductListCompany($dataImporterConfigurationTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getImportType(): string
    {
        return ProductListCompanyDataImportConfig::IMPORT_TYPE_PRODUCT_LIST_COMPANY;
    }
}
