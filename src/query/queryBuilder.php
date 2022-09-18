<?php

namespace src\query;
use PDO;
use PDOException;

class queryBuilder{
    private $columns;

    private $from;

    private $distinct = false;

    private $join;

    private $where;

    private $groups;

    private $having;

    private $order;

    private $limit;

    private $offset;

    public function __construct($tableName)
    {
        $this->from = $tableName;
    }

    public static function table($tableName)
    {
        return new self($tableName);
    }

    public function select($columns)
    {
        $this->columns = is_array($columns) ? $columns : func_get_args();
        return $this;
    }

    public function distinct()
    {
        $this->distinct = true;
        return $this;
    }

    public function where($column,$operator,$value,$boolean = 'and')
    {
        $this->where[] = [$column,$operator,$value,$boolean];
        return $this;
    }

    public function orWhere($column,$operator,$value)
    {
        $this->where[] = [$column,$operator,$value,'or'];
        return $this;
    }

    public function get()
    {
        if (!isset($this->from) || empty($this->from)){
            return false;
        }

        $sql = $this->distinct ? 'SELECT DISTINCT' : 'SELECT';

        if (isset($this->columns) && is_array($this->columns)){
            $sql .= ' '.implode(' ,',$this->columns);
        }else{
            $sql .= ' *';
        }

        $sql .= ' FROM '. $this->from;

        if (isset($this->where) && is_array($this->where)){
            $sql .= ' WHERE ';
            foreach ($this->where as $wk => $where){
                $sql .= "$where[0] $where[1] $where[2]";
                if ($wk < count($this->where)-1){
                    $sql .= (strtolower($where[3]) === 'and')? ' AND':' OR';
                }
            }
        }

        return $sql;
    }
}