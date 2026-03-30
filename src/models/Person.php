<?php

class Person
{
    private PDO $conn;

    public function __construct(Database $db)
    {
        $this->conn = $db->getConnection();
    }

    public function postToDB($data, int $number_of=0)
    {
        $sql = 'INSERT INTO person (name, surname, e_mail, country, picture) VALUES (:name, :surname, :e_mail, :country, :picture)';
        $stmt = $this->conn->prepare($sql);
        for($i=0;$i<$number_of;$i++) {
            $stmt->execute([
                'name' => $data['results'][$i]['name']['first'],
                'surname' => $data['results'][$i]['name']['last'],
                'e_mail' => $data['results'][$i]['email'],
                'country' => $data['results'][$i]['location']['country'],
                'picture' => $data['results'][$i]['picture']['thumbnail']
            ]);            
        }
        return (int)$this->conn->lastInsertId();
    }
}