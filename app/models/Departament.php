<?php
class Departament {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function save($name) {
        $query = "INSERT INTO departments (name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            return "Departamento creado exitosamente.";
        } else {
            return "Error al crear departamento: " . $stmt->error;
        }
    }

    public function get() {
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

    public function getById($id) {
        $query = "SELECT * FROM departments WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return "Departamento no encontrado.";
        }
    }

    public function update($id, $name) {

        $query = "UPDATE departments SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            return "Departamento actualizado exitosamente.";
        } else {
            return "Error al actualizar departamento: " . $stmt->error;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM departments WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Departamento eliminado exitosamente.";
        } else {
            return "Error al eliminar departamento: " . $stmt->error;
        }
    }
}
?>
