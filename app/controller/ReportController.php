<?php
include('../../core/config/Connection.php');
include('../models/Report.php');

class ReportController
{
    private $report;
    private $conn;

    function __construct() {
        $this->conn = (new Connection())->connect();
        $this->report = new Report($this->conn);
    }

    public function getEmployeeTi() {
        return $this->report->getEmployeeTi();
    }

    public function getEmployeeMaxSalary() {
        return $this->report->getEmployeeMaxSalary();
    }

    public function getDepartamentMaxExpense() {
        return $this->report->getDepartamentMaxExpense();
    }

    public function getCantEmployeeSalaryMinor() {
        return $this->report->getCantEmployeeSalaryMinor();
    }
   
}