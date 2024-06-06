<?php

/**
 * Created by PhpStorm.
 * User: nathan.kamau
 * Date: 03-06-2017
 * Time: 4:45 PM
 */
class Status
{

}


class LedgerStatus{
    public $active=1;
    public $disabled=2;
}

class AssetStatus{
    public $active=1;
    public $disabled=2;
}class BudgetStatus{
    public $active=1;
    public $disabled=2;
}
class BudgetItemStatus{
    public $active=1;
    public $disabled=2;
}

class ExpenseStatus{
    public $active=1;
    public $disabled=0;
}
///Types
class BankAccountsTypes{
    public $bankaccount=1;
    public $cashaccount=2;
}
class CreditNoteStatus{
    public $active=1;
    public $submitted=2;
    public $deactivated=3;
}