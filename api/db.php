<?php
session_start();

Class DB
{
    private $dsn = "mysql:host=localhost;dbname=school_system;charset=utf8";
    private $table;
    private $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    public function all(...$arg)
    {
        $sql = "select * from `$this->table` ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arrayToSql($arg[0]);
                $sql .= " where " . implode(" && ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($id)
    {
        $sql = "select * from `$this->table` ";
        if (is_array($id)) {
            $tmp = $this->arrayToSql($id);
            $sql .= " where " . implode(" && ", $tmp);
        } else {
            $sql .= " where `id`='$id' ";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($array)
    {
        if (isset($array['id'])) {
            $this->update($array);
        } else {
            $this->insert($array);
        }
    }

    function count(...$arg){
        $sql="select count(*) from `$this->table` ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->arrayToSql($arg[0]);
                $sql .= " where " . implode(" && ",$tmp);
            }else{
                $sql .=$arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .=$arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    function update($array)
    {
        $sql = "UPDATE $this->table ";
        $tmp = $this->arrayToSql($array);
        $sql .= " SET " . join(", ", $tmp);
        $sql .= " WHERE id='{$array['id']}'";
        return $this->pdo->exec($sql);
    }

    function insert($array)
    {
        $sql = "INSERT INTO `{$this->table}` ";
        $keys = array_keys($array);
        $sql .= "(`" . join("`,`", $keys) . "`)";
        $sql .= "VALUES ('" . join("','", $array) . "')";
        return $this->pdo->exec($sql);
    }

    function del($id)
    {
        $sql = "DELETE from `$this->table` ";
        if (is_array($id)) {
            $tmp = $this->arrayToSql($id);
            $sql .= " where " . implode(" && ", $tmp);
        } else {
            $sql .= " where `id`='$id' ";
        }
        return $this->pdo->exec($sql);
    }

    private function arrayToSql($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }
}

function q($sql)
{
    $dsn = "mysql:host=localhost;dbname=school_system;charset=utf8";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchALL(PDO::FETCH_ASSOC);
}

function to($url)
{
    header("location:" . $url);
}

// 僅保留教務系統相關資料表物件
$User = new DB('users');
$Course = new DB('courses');
$Attendance = new DB('attendance');
$Leave = new DB('leaves');
$Assignment = new DB('assignments');
$Submission = new DB('submissions');
$Material = new DB('materials');
$Grade = new DB('grades');

?>