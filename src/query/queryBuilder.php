<?php

namespace src\query;
use PDO;
use src\connect\config;

class queryBuilder {
    private $columns;

    private $from;

    private $distinct = false;

    private $join;

    private $where;

    private $order;

    private $limit;

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


    public function join($table,$first,$operator,$second,$type='inner')
    {
        $this->join[] =[$table,$first,$operator,$second,$type];
        return $this;
    }

    public function leftJoin($table,$first,$operator,$second)
    {
        return $this->join[] = [$table,$first,$operator,$second,'left'];
    }

    public function rightJoin($table,$first,$operator,$second)
    {
        return $this->join[] = [$table,$first,$operator,$second,'right'];
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

    public function orderby($column,$direct = 'asc')
    {
        $this->order[] =[$column,$direct];
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
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

        if (isset($this->where) && is_array($this->where)) {
            $sql .= ' WHERE ';
            foreach ($this->where as $wk => $where) {
                $sql .= "$where[0] $where[1] $where[2]";
                if ($wk < count($this->where) - 1) {
                    $sql .= (strtolower($where[3]) === 'and') ? ' AND' : ' OR';
                }
            }
        }

        if (isset($this->join) && is_array($this->join)){
            foreach ($this->join as $join){
                switch (strtolower($join[4])){
                    case 'inner':
                        $sql .= ' INNER JOIN';
                    break;
                    case 'left':
                        $sql .= ' LEFT JOIN';
                        break;
                    case 'right':
                        $sql .= ' RIGHT JOIN';
                        break;
                    default:
                        $sql .= ' INNER JOIN';
                        break;
                }
                $sql .= " $join[0] ON $join[1] $join[2] $join[3]";
            }
        }

        if (isset($this->order) && is_array($this->order)){
            $sql .= ' ORDER BY';
            foreach ($this->order as $ok =>$or){
                $sql .= " $or[0] $or[1]";
                if ($ok < (count($this->order)-1)){
                    $sql .= " ,";
                }
            }
        }

        if (isset($this->limit)){
            $sql .= " LIMIT $this->limit";
        }

        return config::exQuery($sql);
//            return $sql;
    }
}