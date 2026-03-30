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
        $sql = 'SELECT id, name, e_mail FROM person';
        $stmt = $this->conn->prepare($sql);
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}