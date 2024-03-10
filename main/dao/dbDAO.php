<?php
class dbDAO{
	
	private $host  = 'localhost:3306';
    private $user  = 'root';
    private $password   = "";
    private $database  = "web2"; 
    private $conn;

    public function getConnection(){		
		$this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($this->conn->connect_error){
			exit("Error failed to connect to MySQL: " . $this->conn->connect_error);
		} else {
			return $this->conn;
		}
    }


    public function read($sql, $type=null, ...$params){
        try {
            $conn = $this->getConnection();
            $stm = $conn->prepare($sql);
            if($type != null && !empty($type))
                $stm->bind_param($type, ...$params);
            $stm->execute();
            $result = $stm->get_result();
            return $result;
        } catch (Exception $e) {
            return null;
        } finally {
            $conn->close();
        }
        
    }

    public function insert($sql, $type=null, ...$params){
        try{
            $conn = $this->getConnection();
            $conn->autocommit(false);
            $stm = $conn->prepare($sql);
            $stm->bind_param($type, ...$params);
            $stm->execute();
            $new_id = $conn->insert_id;
            $conn->commit();
            $affectedRow = $stm->affected_rows;
            return $affectedRow>0 ? $new_id : null;
        } catch(Exception $e){
            $conn->rollback();
            return null;
        } finally{
            $conn->close();
        }
    }

    public function update($sql, $type=null, ...$params) {
        try {
            $conn = $this->getConnection();
            $conn->autocommit(false);
            $stm = $conn->prepare($sql);
            $stm->bind_param($type, ...$params);
            $stm->execute();
            $conn->commit();
            $affectedRow = $stm->affected_rows;
            return $affectedRow>0 ? true:false;
        } catch (Exception $e) {
            $conn->rollback();
            return false;
        } finally {
            $conn->close();
        }
    }

    public function update2($sql, $type=null, ...$params) {
        try {
            $conn = $this->getConnection();
            $conn->autocommit(false);
            $stm = $conn->prepare($sql);
            $stm->bind_param($type, ...$params);
            $stm->execute();
            $conn->commit();
            $affectedRow = $stm->affected_rows;
            return $affectedRow;
        } catch (Exception $e) {
            $conn->rollback();
            return false;
        } finally {
            $conn->close();
        }
    }

}  
?>