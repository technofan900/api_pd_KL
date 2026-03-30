<?php

class RetPerson
{
    private PDO $conn;

    public function __construct(Database $db)
    {
        $this->conn = $db->getConnection();
    }

    public function get()
    {
        $sql = 'SELECT id, name, e_mail, picture FROM person';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getbyID($id)
    {
        $sql = 'SELECT id, name, e_mail, picture FROM person WHERE id =:id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;

    }
}