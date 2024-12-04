<?php
include('../../core/config/Connection.php');
include('../models/Gender.php');

class GenderController
{
    private $gender;
    private $conn;

    function __construct() {
        $this->conn = (new Connection())->connect();
        $this->gender = new Gender($this->conn);
    }

    public function save($name) {
        return $this->gender->save($name);
    }

    public function get() {
        return $this->gender->get();
    }

    public function getById($id) {
        return $this->gender->getById($id);
    }

    public function update($id, $name) {
        return $this->gender->update($id, $name);
    }
    public function delete($id) {
        return $this->gender->delete($id);
    }
}