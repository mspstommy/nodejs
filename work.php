<?php
ini_set("display_errors","1");
error_reporting(E_ALL & ~E_NOTICE);

class DatabaseAccessObject {
    private $mysql_address = "";
    private $mysql_username = "";
    private $mysql_password = "";
    private $mysql_database = "";
    private $link;
    private $last_sql = "";
    private $last_id = 0;
    private $last_num_rows = 0;
    private $error_message = "";

    public function __construct($mysql_address, $mysql_username, $mysql_password, $mysql_database) {
        $this->mysql_address  = $mysql_address;
        $this->mysql_username = $mysql_username;
        $this->mysql_password = $mysql_password;
        $this->mysql_database = $mysql_database;

        $this->link = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->mysql_address, $this->mysql_username, $this->mysql_password));

        if (mysqli_connect_errno())
        {
            $this->error_message = "Failed to connect to MySQL: " . mysqli_connect_error();
            echo $this->error_message;
            return false;
        }
        mysqli_query($GLOBALS["___mysqli_ston"], "SET NAMES utf8");
        mysqli_query($this->link, "SET NAMES utf8");
        mysqli_query($this->link, "SET CHARACTER_SET_database= utf8");
        mysqli_query($this->link, "SET CHARACTER_SET_CLIENT= utf8");
        mysqli_query($this->link, "SET CHARACTER_SET_RESULTS= utf8");

        if(!(bool)mysqli_query($this->link, "USE ".$this->mysql_database))$this->error_message = 'Database '.$this->mysql_database.' does not exist!';
    }

    public function __destruct() {
        mysqli_close($this->link);
    }

    public function execute($sql = null) {
        if ($sql===null) return false;
        $this->last_sql = str_ireplace("DROP","",$sql);
	$result_set = array();
        $result = mysqli_query($this->link, $this->last_sql);

        if (((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) {
            $this->error_message = "MySQL ERROR: " . ((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
        } else {
            $this->last_num_rows = @mysqli_num_rows($result);
            for ($xx = 0; $xx < @mysqli_num_rows($result); $xx++) {
                $result_set[$xx] = mysqli_fetch_assoc($result);
            }
            if(isset($result_set)) {
                return $result_set;
            }else{
                $this->error_message = "result: zero";
            }
        }
    }

    public function query($table = null, $condition = "1", $order_by = "1", $fields = "*", $limit = ""){
        $sql = "SELECT {$fields} FROM {$table} WHERE {$condition} ORDER BY {$order_by} {$limit}";
        return $this->execute($sql);
    }

    public function insert($table = null, $data_array = array()) {
        if($table===null)return false;
        if(count($data_array) == 0) return false;

        $tmp_col = array();
        $tmp_dat = array();

        foreach ($data_array as $key => $value) {
            $value = mysqli_real_escape_string($this->link, $value);
            $tmp_col[] = $key;
            $tmp_dat[] = "'$value'";
        }
        $columns = join(",", $tmp_col);
        $data = join(",", $tmp_dat);

        $this->last_sql = "INSERT INTO " . $table . "(" . $columns . ")VALUES(" . $data . ")";

        mysqli_query($this->link, $this->last_sql);

        if (((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) {
            echo "MySQL Update Error: " . ((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
        } else {
            $this->last_id = mysqli_insert_id($this->link);
            return $this->last_id;
        }
    }

    public function update($table = null, $data_array = null, $key_column = null, $id = null) {
        if($table == null){
            echo "table is null";
            return false;
        }
        if($id == null) return false;
        if($key_column == null) return false;
        if(count($data_array) == 0) return false;

        $id = mysqli_real_escape_string($this->link, $id);

        $setting_list = "";
        for ($xx = 0; $xx < count($data_array); $xx++) {
            list($key, $value) = each($data_array);
            $value = mysqli_real_escape_string($this->link, $value);
            $setting_list .= $key . "=" . "\"" . $value . "\"";
            if ($xx != count($data_array) - 1)
                $setting_list .= ",";
        }
        $this->last_sql = "UPDATE " . $table . " SET " . $setting_list . " WHERE " . $key_column . " = " . "\"" . $id . "\"";
        $result = mysqli_query($this->link, $this->last_sql);

        if (((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) {
            echo "MySQL Update Error: " . ((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
        } else {
            return $result;
        }
    }

    public function delete($table = null, $key_column = null, $id = null) {
        if ($table===null) return false;
        if($id===null) return false;
        if($key_column===null) return false;

        return $this->execute("DELETE FROM $table WHERE " . $key_column . " = " . "\"" . $id . "\"");
    }

    public function getLastSql() {
        return $this->last_sql;
    }

    private function setLastSql($last_sql) {
        $this->last_sql = $last_sql;
    }

    public function getLastId() {
        return $this->last_id;
    }

    private function setLastId($last_id) {
        $this->last_id = $last_id;
    }

    public function getLastNumRows() {
        return $this->last_num_rows;
    }

    private function setLastNumRows($last_num_rows) {
        $this->last_num_rows = $last_num_rows;
    }

    public function getErrorMessage()
    {
        return $this->error_message;
    }

    private function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
    }
}
$mysql_address = "localhost";
$mysql_username = "root";     
$mysql_password = "crayon25"; 
$mysql_database = "calender";   
$DAO = new DatabaseAccessObject($mysql_address, $mysql_username, $mysql_password, $mysql_database);
$value = $DAO->execute("SELECT * FROM value WHERE ID = '1'");

echo'<form action="work.php"method="post">
	<input type="text" name="pd"><br>
	<input type="text" name="pc"><br>
	<input type="submit" value="提交">
</form>';

$table = "value";
$data_array['ID'] = "";
$data_array['Day'] = $_POST["pd"];
$data_array['Content'] = $_POST["pc"];
$DAO->insert($table, $data_array);
$value_id = $DAO->getLastId;

?>
<?=$value[0]["ID"]?><br>
<?=$value[0]["Day"]?><br>
<?=$value[0]["Content"]?>

