<?php
class config
{

     // local or public
    public $repository  = "public";
    public $device      = "mac";
    private $host       = "localhost";
    public  $conn;

   
//hitamputihberwarna
    private $db_name_local      = "mementbersama";
    private $username_local     = "root";
    private $password_local     = "hitamputihberwarna";

    private $db_name_public     = "u7780352_invitation";
    private $username_public    = "u7780352_momenbersama";
    private $password_public    = "momenbersama123";

  

    public function repository($task)
    {

    $repository = $this->repository;
    $device     = $this->device;

    if($task == "repo")
    {
        return $repository;
    }


    if($task == "device")
    {
        return $device;

    }
    

    }

    public function getConnection()
    {
        $this->conn = null;

        $repository = $this->repository;

        switch ($repository) {
            case 'local':
                $dbName   = $this->db_name_local;
                $username = $this->username_local;
                $password = $this->password_local;
                break;

            case 'public' :
                $dbName   = $this->db_name_public;
                $username = $this->username_public;
                $password = $this->password_public;
                break;
            
           
        }

        try {

            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $dbName, $username, $password ,   array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;

        
    }

    public function manage_data($table , $conditions , $columns = [] , $param = [])
    {

        $msg = [];

        switch ($conditions) {
            case 'insert':

                $columnString = implode(',', array_keys($columns));
                $valueString  = implode(',', array_fill(0, count($columns), '?'));

                $prepare = "INSERT INTO $table ({$columnString}) VALUES ({$valueString})";

                
                $stmt = $this->conn->prepare($prepare);
                if($stmt->execute(array_values($columns))){
                  
                    $lastID = $this->conn->lastInsertId();
                    $msg = array("true","$lastID");
                    

                }else{

                    array_push($msg,"001");
                }

                return $msg;
                
                break;

            case 'update' :

                $get_columns = array();
                $get_params  = array();
                
                foreach ($columns as $key => $value) {
                    $get_columns[] = "".$key." = :".$key."";
                }

                foreach ($param as $key => $value) {
                    $get_params[] = "".$key."= :".$key."";
                }

                $columnString = implode(', ', $get_columns);
                $paramString  = implode(' and ', $get_params);
                
                $prepare = "UPDATE ".$table." SET ".$columnString." WHERE ".$paramString."";

                if($stmt = $this->conn->prepare($prepare))
                {

                    foreach ($columns as $key => $value) {
                        $stmt->bindValue(":" .$key , $value);
                    }

                    foreach ($param as $key => $value) {

                        $stmt->bindValue(":" .$key , $value);

                    }


                    if($stmt->execute())
                    {

                        $msg = array("true");

                    }

                }


                return $msg;

                break;

            case 'delete' :

                $get_params = array();

                foreach ($param as $key => $value) {
                    $get_params[] = "".$key."= :".$key.""; 
                }

                $paramString  = implode(' and ', $get_params);

                if($paramString == "")
                {

                    $prepare = "DELETE FROM ".$table."";

                }else{


                    $prepare = "DELETE FROM ".$table." WHERE ".$paramString."";

                }


                if($stmt = $this->conn->prepare($prepare))
                {


                    if($paramString != "")
                    {

                        foreach ($param as $key => $value) {

                            $stmt->bindValue(":" .$key , $value);
    
                        }

                    }

                    if($stmt->execute())
                    {

                        $msg = array("true");

                    }

                }

                return $msg;

                break;
            
            default:
                return;
                break;
        }


    }

    public function get_data($select,$table,$conditions = array()){


            $sql = 'SELECT ';
            $sql .= array_key_exists("select",$conditions)?$conditions['select']:$select;
            $sql .= ' FROM '.$table;
            if(array_key_exists("where",$conditions)){
                $sql .= ' WHERE ';
                $i = 0;
                foreach($conditions['where'] as $key => $value){
                    // if where condition > 1
                    $pre = ($i > 0)?' AND ':'';
                    $sql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }

            if(array_key_exists("group_by",$conditions)){
                $sql .= ' GROUP BY '.$conditions['group_by'];
            }

            if(array_key_exists("order_by",$conditions)){
                $sql .= ' ORDER BY '.$conditions['order_by'];
            }


            if(array_key_exists("manual",$conditions)){
                $sql .= '  '.$conditions['manual'];
            }


            if(array_key_exists("like",$conditions)){
                $sql .= ' WHERE '.$conditions['like'];

            }

            if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];
            }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
                $sql .= ' LIMIT '.$conditions['limit'];
            }

            ##echo "$sql";
            $query = $this->conn->prepare("$sql");
            $query->execute();

            if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
                switch($conditions['return_type']){
                    case 'count':
                        $data = $query->rowCount();
                        break;
                    case 'single':
                        $data = $query->fetch(PDO::FETCH_ASSOC);
                        break;
                    default:
                        $data = '';
                }
            }else{
                if($query->rowCount() > 0){
                    $data = $query->fetchAll();
                }
            }

            return !empty($data)?$data:false;
            $this->conn = null;
        }

}

 ?>
