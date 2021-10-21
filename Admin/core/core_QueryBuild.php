<?php
trait QueryBuild {
    private $tableName = '', $where = '', $operator = '', $field = '', $limit = '',$offset = '', $type = '', $join = '', $orderBy = '';

    public function table($tableName) {
        $this->tableName = $tableName;
        return $this;
    }

    public function select($field='*') {
        $this->select = $field;
        return $this;
    }

    public function where($field, $compare, $value) {
        if (empty($this->where)) {
            $this->operator = 'WHERE';
        } else {
            $this->operator = 'AND';
        }
        $this->where .= " $this->operator $field $compare '$value'";
        return $this;
    }

    public function orWhere($field, $compare, $value) {
        if (empty($this->where)) {
            $this->operator = 'WHERE';
        } else {
            $this->operator = 'OR';
        }
        $this->where .= " $this->operator $field $compare '$value'";
        return $this;
    }

    public function whereLike($field, $value) {
        if (empty($this->where)) {
            $this->operator = ' WHERE ';
        } else {
            $this->operator = ' OR ';
        }
        $this->where .= " $this->operator $field LIKE '%$value%'";
        return $this;
    }

    public function limit($number, $offset=0) {
        if (empty($offset)) {
            $offset = 0;
        } 
        else {
            $offset = $offset;
        }
        $this->limit = "LIMIT $offset, $number";
        return $this;
    }

    public function orderBy($field,$type) {
        $fieldArr = array_filter(explode(',',$field));
        if(!empty($fieldArr) && count($fieldArr) >= 2) {
            if (empty($type)) {
                $this->type = "ASC";
            } else {
                 $this->type = $type;
            }
            $this->orderBy = " ORDER BY " .implode(',',$fieldArr) ." " .$this->type;
        } else {
            if (empty($type)) {
                $this->type = "ASC";
            } else {
                 $this->type = $type;
            }
            $this->orderBy = " ORDER BY " .$field ." " .$this->type;
        }
        return $this;
    }

    public function join($tableName, $condition) {
        if(!empty($this->join)) {
            $this->join .= ' INNER JOIN ' .$tableName .' ON ' .$condition .' ';
        } else {
            $this->join = ' INNER JOIN ' .$tableName .' ON ' .$condition .' ';
        }
        return $this;
    }

    public function getLastId($id,$tableName) {
        $sql = "SELECT MAX($id) FROM $tableName";
        $query = $this->query($sql);
        if(!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function get() {

        $sql = "SELECT $this->select FROM $this->tableName $this->join $this->where $this->limit $this->orderBy";

        $sql = trim($sql);

        $query = $this->query($sql);

        $this->resetQuery();

        if(!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function resetQuery() {
        $this->tableName = ''; $this->where = ''; $this->operator = ''; $this->field = ''; $this->limit = ''; $this->orderBy = ''; $this->join = '';
    }
}