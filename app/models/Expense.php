<?php
class Expense {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function save($year, $month, $income, $expense, $department_id) {

        $query = "INSERT INTO expenses (year, month, income, expense, department_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiddi", $year, $month, $income, $expense, $department_id);

        if ($stmt->execute()) {
            return "Gasto creado exitosamente.";
        } else {
            return "Error al crear gasto: " . $stmt->error;
        }
    }

    public function get() {
        $query = "SELECT e.id, e.year, e.month, e.income, e.expense, e.department_id, d.name departament
        FROM expenses e 
        INNER JOIN departments d ON e.department_id  = d.id";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $expenses = [];
            while ($row = $result->fetch_assoc()) {
                $expenses[] = $row;
            }
            return $expenses;
        } else {
            return "No se encontraron gastos.";
        }
    }

    public function getById($id) {
        $query = "SELECT * FROM expenses WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return "Gasto no encontrado.";
        }
    }

    public function update($id, $year, $month, $income, $expense, $department_id) {

        $query = "UPDATE expenses SET year = ?, month = ?, income = ?, expense = ?, department_id = ?  WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiddii", $year, $month, $income, $expense, $department_id, $id);

        if ($stmt->execute()) {
            return "Gasto actualizado exitosamente.";
        } else {
            return "Error al actualizar gasto: " . $stmt->error;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM expenses WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Gasto eliminado exitosamente.";
        } else {
            return "Error al eliminar gasto: " . $stmt->error;
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
}
?>
