<?php
class dbhelper
{
    private $db_username;
    private $db_name;
    private $db_password;
    private $db_host;
    private $conn;
    private $fields = array();
    /**
     * dbhelper constructor.
     * @param string $db_username
     * @param string $db_name
     * @param string $db_password
     * @param string $db_host
     */
    public function __construct($db_username, $db_name, $db_password, $db_host)
    {
        $this->db_username = $db_username;
        $this->db_name = $db_name;
        $this->db_password = $db_password;
        $this->db_host = $db_host;
        $this->conn = new mysqli($this->db_host,$this->db_username,$this->db_password,$this->db_name);
    }

    function setFields(...$fields){
        $tmp = array();
        for($i = 0; $i != count($fields); ++$i){
            $tmp[] =  $fields[$i];

        }
        $this->fields = $tmp;
    }

    function pushDB($tablename,...$data){
        $binds = "";
        $value_params = "";
        $bind_array = array();
        for($i = 0; $i != count($data); ++$i){
            switch (gettype($data[$i])){
                case 'integer':
                    $binds .='i';
                    break;
                case 'string':
                    $binds .='s';
                    break;
                case 'double':
                    $binds .='d';
                    break;

            }
            if ($i < count($data) - 1){
                $value_params .= '?,';
            }else{
                $value_params .= '?';
            }
            $bind_array[] = $data[$i];
        }
        $field_array = implode(", ",$this->fields);
        $stmt = $this->conn->prepare("INSERT INTO ".$tablename."(".$field_array.")".
            "VALUES "."(".$value_params.")");
        $stmt->bind_param($binds,...$bind_array);
        $stmt->execute();
        return $binds;
    }
    function getData($tablename,...$column){
        $column_array = array();
        $row = array();
        for($i = 0; $i != count($column); ++$i){
            $column_array[] = $column[$i];
        }
        $result = $this->conn->query("SELECT ". implode(', ',$column_array) ." FROM ".$tablename);
        if($result->num_rows > 0){
            for($i = 0; $i != $result->num_rows; ++$i){
                $row[] = mysqli_fetch_assoc($result);
            }


        }
        return $row;
    }
    function editData($tablename,$id,...$column){
        $builder = array();
        for($i = 0; $i != count($column);++$i){
            $builder[] = $this->fields[$i].'= '."'".$column[$i]."'";
        }
        $sql = "UPDATE ".$tablename." SET ".implode(', ',$builder)." WHERE id=".$id;
       if( $this->conn->query($sql) === TRUE){
           echo "Record updated";
       }else{
           $this->conn->error;
       }
    }
    function deleteData($tablename,$id){
        $sql = "DELETE FROM ".$tablename." WHERE ".$tablename.".id = ".$id."";
        if($this->conn->query($sql) === TRUE){
            echo "Entry Deleted";
        }

    }
}
