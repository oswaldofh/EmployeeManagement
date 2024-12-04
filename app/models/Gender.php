<?php
class Gender {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function save($name) {
        $query = "INSERT INTO genders (name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            return "Genero creado exitosamente.";
        } else {
            return "Error al crear genero: " . $stmt->error;
        }
    }

    public function get() {
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

    public function getById($id) {
        $query = "SELECT * FROM genders WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return "Gnero no encontrado.";
        }
    }

    public function update($id, $name) {

        $query = "UPDATE genders SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            return "Genero actualizado exitosamente.";
        } else {
            return "Error al actualizar genero: " . $stmt->error;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM genders WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Genero eliminado exitosamente.";
        } else {
            return "Error al eliminar genero: " . $stmt->error;
        }
    }
}
?>
