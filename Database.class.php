<?php
    class Database{
        private $connection;

        function __construct(){
            $db = new Connection();
            $this->connection = $db->DBConnection();
        }

        public function selectWhereLimit($table, $where = null, $limit){
            $query = $this->connection->prepare('SELECT * FROM ' . $table . ' ' . $where . ' ' . $limit);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function selectCount($table,$id, $where = null){
            $query = $this->connection->prepare('SELECT COUNT(' . $id . ') AS Total FROM ' . $table . ' ' . $where);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function selectAll($table, $where = null){
            $query = $this->connection->prepare('SELECT * FROM ' . $table . ' ' . $where);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function selectById($table,$id,$idvalue){
            $query = $this->connection->prepare('SELECT * FROM ' . $table . ' WHERE ' . $id . '=' . $idvalue);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insert($table,$column,$value){
            $sql = "INSERT INTO " . $table . " (" . $column . ") VALUES (" . $value . ")";
            $this->connection->exec($sql);
        }

        public function del($table,$id){
            $sql = "DELETE FROM " . $table . " WHERE " . $table . "_id = " . $id;
            $this->connection->exec($sql);
        }

        public function update($table,$data,$id){
            $useValue = "";
            foreach($data as $key => $value){
                $useValue .= $key . "='" . $value . "', ";
            }
            $useValue = substr($useValue, 0, -2);
            $sql = "UPDATE " . $table . " SET " . $useValue . " WHERE " . $table . "_id = " . $id;
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
        }

        public function pie($procedure){
            $stmt= $this->connection->prepare('CALL ' . $procedure);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function obligate($procedure,$firstParameter,$secondParameter){
            $sql = 'CALL ' . $procedure . '(' . $firstParameter . ',' . $secondParameter . ')';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
        }
    }
?>


