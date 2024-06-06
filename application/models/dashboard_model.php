<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends MY_Model {
	protected $table_name = 'vehicles';
    protected $key = 'id';
    protected $set_created = true;
    protected $log_user = false;
    protected $set_modified = false;
    protected $soft_deletes = false;
    protected $date_format = 'datetime';
	
	protected $created_field    = 'create_on';
    
   
	public function get_employee_total()
	{
		return $this->db->query("SELECT count(*)as totals FROM bf_vision_employees WHERE employment_status=1")->row();
	}
	public function get_basic_salaries()
	{
		return $this->db->query("SELECT SUM(basic_pay)as totals FROM bf_vision_employees WHERE employment_status=1")->row();
	}
	public function get_allowances()
	{
		return $this->db->query("SELECT SUM(amount)as totals FROM bf_vision_employee_allowances WHERE status=1")->row();
	}
	public function get_company_info()
	{
		return $this->db->query("SELECT * FROM bf_vision_company_details")->row();
	}
	public function get_payroll_totals_chart()
	{
		return $this->db->query("SELECT bf_vision_payroll_period.*,basic_pay,income,deduction FROM bf_vision_payroll_period LEFT JOIN (SELECT payrollId_fk,SUM(basic_pay)as basic_pay FROM bf_vision_basic_payments GROUP BY payrollId_fk)as basic_salaries ON bf_vision_payroll_period.id=basic_salaries.payrollId_fk LEFT JOIN (SELECT paymentId_fk,SUM(amount)as deduction FROM bf_vision_payroll_deductions GROUP BY paymentId_fk) as deductions ON deductions.paymentId_fk=bf_vision_payroll_period.id LEFT JOIN (SELECT paymentId_fk,SUM(amount)as income FROM bf_vision_payroll_incomes GROUP BY paymentId_fk)as incomes ON incomes.paymentId_fk=bf_vision_payroll_period.id GROUP BY bf_vision_payroll_period.id ORDER BY bf_vision_payroll_period.id DESC LIMIT 12")->result();
	}
	public function get_department_payments()
	{
		return $this->db->query("SELECT departmentId_fk,department,SUM(basic_pay)as basic_pay,COUNT(*)as employees FROM bf_vision_employees LEFt JOIN bf_vision_departments ON bf_vision_departments.id=departmentId_fk WHERE employment_status=1 GROUP BY departmentId_fk")->result();
	}
	public function get_search_employees($id)
	{
		return $this->db->query("SELECT bf_vision_employees.*,department FROM bf_vision_employees 
                                  LEFT JOIN bf_vision_departments ON bf_vision_departments.id=departmentId_fk 
                                  WHERE (employee_no LIKE '%".$id."%' OR CONCAT_WS(' ', surname, other_names) LIKE '%".$id."%') order by employee_no, employee_names LIMIT 10")->result();
	}
	public function get_allowances_totals()
	{
		return $this->db->query("SELECT allowance_type,SUM(amount) as totals FROM bf_vision_employee_allowances LEFT JOIN bf_vision_allowances ON bf_vision_allowances.id=allowanceId_fk WHERE bf_vision_employee_allowances.status=1 GROUP BY allowanceId_fk")->result();
	}
	public function get_banks()
	{
		return $this->db->query("SELECT * FROM bf_vision_accounts_banks WHERE status=1")->result();
	}
	public function get_bank_transactions()
	{
		return $this->db->query("SELECT bf_vision_accounts_transactions.*,account_name FROM bf_vision_accounts_transactions LEFT JOIN bf_vision_accounts_banks ON bf_vision_accounts_banks.id=accountId_fk WHERE accountId_fk!=4 order by transaction_date desc LIMIT 50")->result();
	}
	public function get_petty_cash_account()
	{
		return $this->db->query("SELECT * FROM bf_vision_accounts_banks WHERE id=4")->row();
	}
	public function get_petty_cash_expenses($this_month,$this_year)
	{
		return $this->db->query("SELECT SUM(bf_vision_accounts_expenses_reconcilliations.amount)as amount,tab_name FROM bf_vision_accounts_expenses_reconcilliations LEFT JOIN bf_vision_accounts_pettycash_tabs ON bf_vision_accounts_pettycash_tabs.id=tabId_fk LEFT JOIN bf_vision_accounts_transactions ON bf_vision_accounts_transactions.id=transactionId_fk  WHERE accountId_fk=4 and  month(expense_date)='".$this_month."' and year(expense_date)='".$this_year."' GROUP BY year(expense_date),month(expense_date),tabId_fk")->row();
	}
	public function get_total_asset_value(){
		return $this->db->query("SELECT sum(if (type=2,-(amount),amount))as asset_value FROM bf_vision_finance_transactions WHERE status!=0")->row();
	}
	public function get_ledgers_count(){
		return $this->db->query("SELECT count(*) as count_num FROM  bf_vision_finance_ledger WHERE status=1")->row();
	}
	public function get_assets_value(){
		return $this->db->query("SELECT name,account_number,sum(if (type=2,-(amount),amount))as asset_value FROM bf_vision_finance_transactions 
											LEFT JOIN bf_vision_finance_assets ON bf_vision_finance_assets.id=asset_id_fk
											WHERE bf_vision_finance_transactions.status!=0 GROUP BY asset_id_fk")->result();
	}
	public function get_ledgers_value(){
		return $this->db->query("SELECT account_name,name,account_number,sum(if (type=2,-(amount),amount))as ledger_value FROM bf_vision_finance_transactions 
										LEFT JOIN bf_vision_finance_ledger ON bf_vision_finance_ledger.id=ledger_id_fk 
										LEFT JOIN bf_vision_finance_assets ON bf_vision_finance_assets.id=asset_id_fk 
										WHERE bf_vision_finance_transactions.status!=0 GROUP BY ledger_id_fk,asset_id_fk ORDER BY ledger_id_fk")->result();
	}
}