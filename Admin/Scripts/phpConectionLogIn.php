<?php
	$host="localhost";
	$bd="riveradb";
	$user="root";
	$pasword="";
	
	
	error_reporting(-1);
	mysqli_report(MYSQLI_REPORT_ALL);
	ini_set("display_errors", "true");
	try{
		$conn=mysqli_connect($host,$user,$pasword,$bd);
		//echo $conn;
		
	}catch(exception $e){
		$myfile = fopen("debug.txt", "w") ;
		$txt = "fucked\n";
		fwrite($myfile, $txt);
		fclose($myfile);
		
	}
	if( !isset($_POST['functionname']) ) {	
		$aResult['error'] = 'No function name!';
				
	 } 
	else{
		$myfile = fopen("debug.txt", "w") or die("Unable to open file!");
		$txt = "penis music\n";
		fwrite($myfile, $txt);
		fclose($myfile);	
		checkUser($_POST['arguments'][0],$_POST['arguments'][1]);
		
	}
	function checkDbAvailable(){
		$mysqli = new mysqli($host,$user, $pasword);
		if ($mysqli->connect_errno) {
			trigger_error('query failed: '.$mysqli->connect_error, E_USER_ERROR);
		}

		$result = $mysqli->query('SHOW databases')
			or trigger_error('connect failed: '.join(',', $mysqli->error_list), E_USER_ERROR);

		foreach( $result as $row ) {
			echo join(', ', $row), "<br />\r\n";
		
		
		}
	}

	function checkUser($name,$password){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `user` WHERE `name`=? AND `password`=? ";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("ss",$name,$password);	
						$stmt->execute();
						/* bind result variables */
						$stmt->store_result();
						if($stmt->num_rows > 0) {
							
							$stmt->bind_result($id,$n,$p,$type);
							$stmt->fetch();
							echo $type;
						
						} else {
							 echo "";
						}
						/* fetch values */
					
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
?>