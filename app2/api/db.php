<?php
date_default_timezone_set('Asia/Taipei');
session_start();
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url)
{
    header("location:$url");
}
class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    protected $pdo;
    protected $table;
    function __construct($table)
    {
        $this->pdo = new PDO($this->dsn, 'root', '');
        $this->table = $table;
    }
    private function a2s($array)
    {
        foreach ($array as $col => $val) {
            $tmp[] = "`$col`='$val'";
        }
        return $tmp;
    }
    private function sql_all($sql, $where, $other)
    {
        if (is_array($where)) {
            if (!empty($where)) {
                $tmp = $this->a2s($where);
                $sql .= " where " . join(" && ", $tmp);
            }
        } else {
            $sql .= " $where";
        }
        $sql .= " $other";
        return $sql;
    }
    function all($where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function count($where = '', $other = '')
    {
        $sql = " select count(*) from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    private function math($math, $col, $where, $other)
    {
        $sql = "select $math(`$col`) from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col, $where = '', $other = '')
    {
        return $this->math('sum', $col, $where, $other);
    }
    function max($col, $where = '', $other = '')
    {
        return $this->math('max', $col, $where, $other);
    }
    function min($col, $where = '', $other = '')
    {
        return $this->math('min', $col, $where, $other);
    }
    function avg($col, $where = '', $other = '')
    {
        return $this->math('avg', $col, $where, $other);
    }
    function find($id)
    {
        $sql = "select * from `$this->table` ";
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } elseif (is_numeric($id)) {
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    function save($array)
    {
        if (isset($array['id'])) {
            $sql = "update `$this->table` set ";
            if (!empty($array)) {
                $tmp = $this->a2s($array);
                $sql .= join(" , ", $tmp);
                $sql .= " where `id`={$array['id']}";
            }
        } else {
            $sql = "insert into $this->table ";
            $col = "(`" . join("`,`", array_keys($array)) . "`)";
            $val = "('" . join("','", $array) . "')";
            $sql .= "$col values $val";
        }
        return $this->pdo->exec($sql);
    }
    function del($id)
    {
        $sql = "delete * from ";
        if (is_array($id)) {
            $sql .= " where " . join(" && ", $this->a2s($id));
        } else {
            $sql .= " where `id`=$id";
        }
        return $this->pdo->exec($sql);
    }
    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
$Student = new DB('students');
$Classes = new DB('classes');
$ClassStudent = new DB('class_student');
$GraduateSchool = new DB('graduate_school');
