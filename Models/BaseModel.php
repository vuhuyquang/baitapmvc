<?php

class BaseModel extends Database
{
    protected $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    public function getAll($table, $select = ['*'], $pages = null)
    {
        $row = 10;
        $from = ($pages-1) * $row;

        $column = implode(',', $select);
        $pages == null ? $sql = "SELECT ${column} FROM ${table}" : $sql = "SELECT ${column} FROM ${table} LIMIT ${from}, ${row}";
        // $sql = "SELECT ${column} FROM ${table} LIMIT ${from}, ${row}";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function countItem($table)
    {
        $sql = "SELECT COUNT(id) FROM ${table}";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function innerJoin($table1, $table2, $column1, $column2, $pages)
    {   
        $row = 3;
        $from = ($pages-1) * $row;
        $sql = "SELECT * FROM ${table2} INNER JOIN ${table1} ON ${table2}.${column2} = ${table1}.${column1}  LIMIT $from, $row";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function find($table, $id)
    {
        $sql = "SELECT * FROM ${table} WHERE id = ${id} LIMIT 1";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function findByColumn($table, $column, $id)
    {
        $sql = "SELECT * FROM ${table} WHERE ${column} = '${id}'";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function create($table, $data = [])
    {
        $columns = implode(',', array_keys($data));
        $values = array_map(function($value) {
            return "'" . $value . "'";
        }, array_values($data));
        $newValues = implode(',', $values);

        $sql = "INSERT INTO ${table}(${columns}) VALUES(${newValues})";
        $this->_query($sql);
    }

    public function store()
    {
        
    }

    public function updateData($table, $id, $data = [])
    {
        $dataSets = [];
        foreach ($data as $key => $value) {
            array_push($dataSets, "${key} = '" . $value . "'");
        }
        $newDataSets = implode(',', $dataSets);
        $sql = "UPDATE ${table} SET ${newDataSets} WHERE id = ${id}";
        $this->_query($sql);
    }

    public function destroy($table, $id)
    {
        $sql = "DELETE FROM ${table} WHERE id = ${id}";
        $this->_query($sql);
    }

    public function _query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }
}

?>