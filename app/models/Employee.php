<?php
class Employee {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function save($first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary) {

        $query = "INSERT INTO employees (first_name, last_name, age, hire_date, comments, gender_id, department_id, salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssissiid", $first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary);

        if ($stmt->execute()) {
            return "Empleado creado exitosamente.";
        } else {
            return "Error al crear empleado: " . $stmt->error;
        }
    }

    public function get() {
        $query = "SELECT e.id, e.first_name, e.last_name, e.age, e.hire_date, e.comments, e.department_id, d.name departament, e.gender_id , g.name gender, e.salary
        FROM employees e 
        INNER JOIN departments d ON e.department_id   = d.id
        INNER JOIN genders g ON e.gender_id  = g.id";
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

    public function getById($id) {
        $query = "SELECT * FROM employees WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return "Empleado no encontrado.";
        }
    }

    public function update($id, $first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary) {

        $query = "UPDATE employees SET first_name = ?, last_name = ?, age = ?, hire_date = ?, comments = ?, gender_id = ?, department_id = ?, salary = ?  WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssissiiid", $first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary, $id);

        if ($stmt->execute()) {
            return "Empleado actualizado exitosamente.";
        } else {
            return "Error al actualizar emplado: " . $stmt->error;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM employees WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Empleado eliminado exitosamente.";
        } else {
            return "Error al eliminar empleado: " . $stmt->error;
        }
    }

    public function getDepartaments() {
        $query = "SELECT * FROM departments";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $departaments = [];
            while ($row = $result->fetch_assoc()) {
                $departaments[] = $row;
            }
            return $departaments;
        } else {
            return "No se encontraron departamentos.";
        }
    }
    
    public function getGenders() {
        $query = "SELECT * FROM genders";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $genders = [];
            while ($row = $result->fetch_assoc()) {
                $genders[] = $row;
            }
            return $genders;
        } else {
            return "No se encontraron generos.";
        }
    }
}
?>
