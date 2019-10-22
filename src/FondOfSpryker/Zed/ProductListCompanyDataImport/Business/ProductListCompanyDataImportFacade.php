<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ProductListCompanyDataImport\Business\ProductListCompanyDataImportBusinessFactory getFactory()
 */
class ProductListCompanyDataImportFacade extends AbstractFacade implements ProductListCompanyDataImportFacadeInterface
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
    public function importProductListCompany(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFactory()
            ->createProductListCompanyDataImport()
            ->import($dataImporterConfigurationTransfer);
    }
}
