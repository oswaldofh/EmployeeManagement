<?php
include('../../core/config/Connection.php');
include('../models/Expense.php');

class ExpenseController
{
    private $expense;
    private $conn;

    function __construct() {
        $this->conn = (new Connection())->connect();
        $this->expense = new Expense($this->conn);
    }

    public function save($year, $month, $income, $expense, $department_id) {
        return $this->expense->save($year, $month, $income, $expense, $department_id);
    }

    public function get() {
        return $this->expense->get();
    }
    public function getDepartaments() {
        return $this->expense->getDepartaments();
    }

    public function getById($id) {
        return $this->expense->getById($id);
    }

    public function update($id, $year, $month, $income, $expense, $department_id) {
        return $this->expense->update($id, $year, $month, $income, $expense, $department_id);
    }
    public function delete($id) {
        return $this->expense->delete($id);
    }
}