<?php
include('../../core/config/Connection.php');
include('../models/Employee.php');

class EmployeeController
{
    private $employee;
    private $conn;

    function __construct() {
        $this->conn = (new Connection())->connect();
        $this->employee = new Employee($this->conn);
    }

    public function save($first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary) {
        return $this->employee->save($first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary) ;
    }

    public function get() {
        return $this->employee->get();
    }
    public function getDepartaments() {
        return $this->employee->getDepartaments();
    }
    public function getGenders() {
        return $this->employee->getGenders();
    }

    public function getById($id) {
        return $this->employee->getById($id);
    }

    public function update($id, $first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary) {
        return $this->employee->update($id, $first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary);
    }
    public function delete($id) {
        return $this->employee->delete($id);
    }
}