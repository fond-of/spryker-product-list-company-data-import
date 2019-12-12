<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport\Business;

use FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\ProductListCompanyWriterStep;
use FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\Step\CompanyDebtorNumberToIdCompanyStep;
use FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\Step\ProductListTitleToIdProductListStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;

/**
 * @method \FondOfSpryker\Zed\ProductListCompanyDataImport\ProductListCompanyDataImportConfig getConfig()
 */
class ProductListCompanyDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportAwareInterface|\Spryker\Zed\DataImport\Business\Model\DataImporterBeforeImportAwareInterface|\Spryker\Zed\DataImport\Business\Model\DataImporterInterface|\Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerAwareInterface
     */
    public function createProductListCompanyDataImport()
    {
        $dataImporter = $this->getCsvDataImporterFromConfig(
            $this->getConfig()->getProductListCompanyDataImporterConfiguration()
        );

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createProductListTitleToIdProductListStep());
        $dataSetStepBroker->addStep($this->createCompanyDebtorNumberToIdCompanyStep());
        $dataSetStepBroker->addStep(new ProductListCompanyWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductListTitleToIdProductListStep(): DataImportStepInterface
    {
        return new ProductListTitleToIdProductListStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createCompanyDebtorNumberToIdCompanyStep(): DataImportStepInterface
    {
        return new CompanyDebtorNumberToIdCompanyStep();
    }
}
