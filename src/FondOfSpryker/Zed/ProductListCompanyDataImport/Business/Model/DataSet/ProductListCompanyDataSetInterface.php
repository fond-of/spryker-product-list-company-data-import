<?php

namespace FondOfSpryker\Zed\ProductListCompanyDataImport\Business\Model\DataSet;

interface ProductListCompanyDataSetInterface
{
    public const PRODUCT_LIST = 'product_list';
    public const DEBTOR_NUMBER = 'debtor_number';

    public const ID_PRODUCT_LIST = 'fk_product_list';
    public const ID_COMPANY = 'fk_company';
}
