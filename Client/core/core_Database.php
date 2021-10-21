<?php
// function database
class Database {

    private $conn;

    use QueryBuild;

    public function __construct() {
        global $db_config;
        $this->conn = Connection::getInstance($db_config);
    }

    public function getAll($tableName, $condition = array()) {

        $sql = "SELECT * FROM $tableName";

        if (!empty($condition)) {
            $sql .= " WHERE";

            foreach ($condition as $key => $value) {
                $sql .= " $key = '$value' AND";
            }
            $sql = rtrim($sql, "AND");
        }

        $query = $this->query($sql);
        
        if ($query) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getWhere($tableName, $operator, $condition = array()) {

        $sql = "SELECT * FROM $tableName";

        if (!empty($condition)) {
            $sql .= " WHERE";

            foreach ($condition as $key => $value) {
                $sql .= " $key $operator '$value' AND";
            }
            $sql = trim($sql, "AND");
        }

        $query = $this->query($sql);

        if ($query) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function delete($tableName,$condition = array()) {

        $sql = "DELETE FROM $tableName";
        if (!empty($condition)) {
            $sql .= " WHERE";
            foreach($condition as $key => $value) {
                $sql .= " $key = '$value' AND";
            }
            $sql = rtrim($sql, "AND");
        }
        return $this->query($sql);
    }

    public function getLike($tableName, $column, $value) {

        $sql = "SELECT * FROM $tableName";

        $sql .= " WHERE $column LIKE '%$value%'";

        $query = $this->query($sql);

        if ($query) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getLimit($tableName,$condition = array(), $limit) {

        $sql = "SELECT * FROM $tableName";

        if (!empty($condition)) {
            $sql .= " WHERE";

            foreach ($condition as $key => $value) {
                $sql .= " $key = '$value' AND";
            }
            $sql = trim($sql, "AND");
        }

        $sql .= " LIMIT $limit";

        $query = $this->query($sql);

        if ($query) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function insertData($tableName,$data = array()) {

        $keys = array_keys($data);

        $fields = implode("," , $keys);
        
        $value_str = '';

        foreach ($data as $key => $value) {
            $value_str .= " '$value',";
        }

        $value_str = trim($value_str, ",");

        $sql = "INSERT INTO $tableName($fields) VALUES  ($value_str)";

        return $this->query($sql);
    }

    public function update($tableName, $data = array(), $condition = array()) {

        $str = '';
        foreach ($data as $key => $value) {
            $str .= " $key = '$value',";
        }
        $str = rtrim($str, ',');
        $sql = "UPDATE $tableName SET $str";
        if (!empty($condition)) {
            $sql .= " WHERE";
            foreach ($condition as $key => $value) {
                $sql .= " $key = '$value' AND";
            }
        }
        $sql = rtrim($sql, 'AND');
        return $this->query($sql);
    }

    public function filter($tableName,$column,$condition = array()) {

        $sql = "SELECT * FROM $tableName WHERE $column ";

        // if (!empty($column)) {
        //     foreach ($column as $key => $value) {
        //         $sql .= " $key = '$value' AND"; 
        //     }
        // }
        // rtrim($sql,"AND");
        if (!empty($condition)) {
            foreach($condition as $key => $value) {
                $sql .= " BETWEEN $value[0] AND $value[1]";
            }
        }
        return mysqli_query($this->conn,$sql);
    }

    function query($sql){
        try{
            global $db_config;
            $connect = Connection::getInstance($db_config);
            $statement = $connect->prepare($sql);
            $statement->execute();
            return $statement;
        }catch (Exception $exception){
            $mess = $exception->getMessage();
            $data['message'] = $mess;
            App::$app->loadErrorData('database', $data);
            die();
        }
    }
}