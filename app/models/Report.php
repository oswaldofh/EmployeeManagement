<?php
class Report {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    

    public function getEmployeeTi() {
        $query = "SELECT e.id, e.first_name, e.last_name, e.age, g.name genero, d.name departamento, e.salary  
        FROM employees e
        INNER JOIN departments d ON e.department_id = d.id
        INNER JOIN genders g ON e.gender_id = g.id
        WHERE d.name = 'ti'";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $employees = [];
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
            return $employees;
        } else {
            return "No se encontraron empleados.";
        }
    }


    public function getEmployeeMaxSalary() {
        $query = "SELECT e.id, e.first_name, e.last_name, e.age, g.name genero, d.name departamento, e.salary 
        FROM employees e
        INNER JOIN departments d ON e.department_id = d.id
        INNER JOIN genders g ON e.gender_id = g.id
        WHERE e.salary = (SELECT MAX(salary) FROM employees)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return "Gnero no encontrado.";
        }
    }
    public function getDepartamentMaxExpense() {
        $query = "SELECT d.id, d.name, SUM(e.expense) AS gasto
        FROM expenses e
        INNER JOIN departments d ON e.department_id = d.id
        GROUP BY d.id, d.name
        ORDER BY gasto DESC
        LIMIT 3;";

        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $employees = [];
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
            return $employees;
        } else {
            return "No se encontraron empleados.";
        }
        
    }
    public function getCantEmployeeSalaryMinor() {
        $query = "SELECT COUNT(*) AS cantidad
        FROM employees e
        WHERE e.salary < 1500000;";

       $stmt = $this->conn->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();

        if ($result->num_rows > 0) {
         return $result->fetch_assoc();
        } else {
           return "Empleado no encontrado.";
        }
    }

}
?>
