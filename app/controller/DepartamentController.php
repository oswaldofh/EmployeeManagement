<?php
include('../../core/config/Connection.php');
include('../models/Departament.php');

class DepartamentController
{
    private $departament;
    private $conn;

    function __construct() {
        $this->conn = (new Connection())->connect();
        $this->departament = new Departament($this->conn);
    }

    public function save($name) {
        return $this->departament->save($name);
    }

    public function get() {
        return $this->departament->get();
    }

    public function getById($id) {
        return $this->departament->getById($id);
    }

    public function update($id, $name) {
        return $this->departament->update($id, $name);
    }
    public function delete($id) {
        return $this->departament->delete($id);
    }
}