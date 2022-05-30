<?php 
/* 
* Copyright (c) 2022 Flavio Ansovini (perniciousflyer@gmail.com)  
* This code is a part of the ochin project (https://github.com/ochin-space)
* For license details see the LICENSE.md file included in the project. 
*/
class SQLiteConstructor{
    private $pdo;

    public function connect($dbName) {
        if ($this->pdo == null) {
            try {
                $this->pdo = new \PDO("sqlite:" . $dbName);
             } catch (\PDOException $e) {
                 echo $e;
                // handle the exception here
             }
        }
        return $this->pdo;
    }

    //TABLE  template
    public function createTable_template() {
        $command = 'CREATE TABLE IF NOT EXISTS template (
            id   INTEGER PRIMARY KEY,
            en INTEGER NOT NULL,
            name TEXT NOT NULL,
            cmd_line TEXT NOT NULL,
            description TEXT NOT NULL)';
        $stmt = $this->pdo->prepare($command);
        $stmt->execute();
    }

    public function insertRow_template($en, $name, $cmd_line, $description) {
        $command = ("INSERT INTO template (en,name, cmd_line,description) VALUES( '$en', '$name', '$cmd_line', '$description');");
        $this->pdo->exec($command);
        return $this->pdo->lastInsertId();
    }

    public function deleteRow_template($id) {
        $command = ("DELETE FROM template WHERE id = '$id'");
        $this->pdo->exec($command);
        return $this->pdo->lastInsertId();
    }

    public function updateRow_template($id, $en, $name, $cmd_line, $description) {
        $command = ("UPDATE template 
                    SET en = '$en', name = '$name', cmd_line = '$cmd_line', description = '$description'
                    WHERE id = '$id'");
        $this->pdo->exec($command);
        return $this->pdo->lastInsertId();
    }

    public function getRows_template() {
        $stmt = $this->pdo->query('SELECT id, en, name, cmd_line, description FROM template');
        $features = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $features[] = [
                'id' => $row['id'],
                'en' => $row['en'],
                'name' => $row['name'],
                'cmd_line' => $row['cmd_line'],
                'description' => $row['description']
            ];
        }
        return $features;
    }
}
?>