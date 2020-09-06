<?php 
	

class Lipe{
	private $conn;
	private $table='tasks';
	
	function __construct($db) {
		$this->conn = $db;
	}

    function treat($data){
      $data=mysqli_real_escape_string($this->conn, trim($data));
      $data=htmlspecialchars($data);
      return $data;
    }

	function loop_todo(){
                  
		$sql = "SELECT * FROM $this->table";
		$query = $this->conn->query($sql);
		$res['table']='';
		while($row = $query->fetch_assoc()){
		  $completed = ($row['completed']==1) ? 'completed' : '' ;
		  $checked = ($row['completed']==1) ? 'checked' : '' ;

		  $res['table'] .='
            <li class="each-task '.$completed.'" id="'.$row['id'].'">
                <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" '.$checked.'> '.$row['name'].'<i class="input-helper"></i></label> </div><i class="edit fa fa-edit mr-3"></i> <i class="remove fa fa-times"></i>
            </li>
		  ';
		}
		echo json_encode($res);
                  
	}

	function addnew(){

		if($this->treat(isset($_POST['action']))){
			$item = $this->treat($_POST['item']);
			$sql = "INSERT INTO $this->table (name) VALUES ('$item')";
			$this->conn->query($sql);
		}	
	}


	function edit(){

		if($this->treat(isset($_POST['action']))){
			$id=$this->treat($_POST['id']);
			$item = $this->treat($_POST['item']);
			$sql = "UPDATE $this->table SET `name` = '$item' WHERE id = '$id'";
			$this->conn->query($sql);
		}	
	}

	function delete(){

		if($this->treat(isset($_POST['action']))){
			$id=$this->treat($_POST['id']);
			$item = $this->treat($_POST['item']);
			$sql = "DELETE FROM $this->table WHERE id = '$id'";
			$this->conn->query($sql);
		}	
	}

	function toggleCompleted(){

		if($this->treat(isset($_POST['action']))){
			$id=$this->treat($_POST['id']);
			$sql = "SELECT `completed` FROM $this->table WHERE id = '$id'";
			$qu=$this->conn->query($sql);
			$row=$qu->fetch_assoc();
			$retVal = ($row['completed']==1) ? '0' : '1' ;
			$sql = "UPDATE $this->table SET `completed` = '$retVal' WHERE id = '$id'";
			$this->conn->query($sql);
		}	
	}

	function get(){
		$id = $this->treat($_POST['id']);
		$sql = "SELECT `name` FROM $this->table WHERE `id`='$id'";
		$query = $this->conn->query($sql);
		$row = $query->fetch_assoc();

		$res['data']=$row['name'];
		echo json_encode($res);
	}

}


session_start();
include_once 'db.php';

$database=new Database();
$db=$database->connect();
$execute=new Lipe($db);

if(isset($_POST['action'])) {
	$action=$_POST['action']; 
}else{ 
	$action=0; 
}

if($action==1){
	if(empty($_POST['id'])){
		$execute->addnew();
	}else{
		$execute->edit();
	}
	
}

if($action==3){
	$execute->delete();
}
if($action==4){
	$execute->get();
}
if($action==5){
	$execute->toggleCompleted();
}
if($action==100){
	$execute->loop_todo();
}


?>
