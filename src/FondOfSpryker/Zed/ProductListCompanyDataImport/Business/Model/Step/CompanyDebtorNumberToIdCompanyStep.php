<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\Step;

use FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\DataSet\ProductListCompanyDataSetInterface;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Exception\InvalidDataException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class CompanyDebtorNumberToIdCompanyStep implements DataImportStepInterface
{
    /**
     * @var int[]
     */
    protected $idCompanyListCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\InvalidDataException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $companyDebtorNumber = $dataSet[ProductListCompanyDataSetInterface::DEBTOR_NUMBER];
        if (!$companyDebtorNumber) {
            throw new InvalidDataException(sprintf('"%s" is required.', ProductListCompanyDataSetInterface::DEBTOR_NUMBER));
        }

        $dataSet[ProductListCompanyDataSetInterface::ID_COMPANY] = $this->getIdCompanyByDebtorNumber($companyDebtorNumber);
    }

    /**
     * @param string $companyDebtorNumber
     *
     * @return int
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     */
    protected function getIdCompanyByDebtorNumber(string $companyDebtorNumber): int
    {
        if (!isset($this->idCompanyListCache[$companyDebtorNumber])) {
            $companyQuery = SpyCompanyQuery::create()->select(SpyCompanyTableMap::COL_ID_COMPANY);

            /** @var int|null $idCompany */
            $idCompany = $companyQuery->findOneByDebtorNumber($companyDebtorNumber);

            if (!$idCompany) {
                throw new EntityNotFoundException(sprintf('Could not find Company by debtor number "%s"', $companyDebtorNumber));
            }
            $this->idCompanyListCache[$companyDebtorNumber] = $idCompany;
        }

        return $this->idCompanyListCache[$companyDebtorNumber];
    }
}
