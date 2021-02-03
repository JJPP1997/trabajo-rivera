<?php
	//params
	$host="localhost";
	$bd="riveradb";//id13819712_db for hosting
	$user="root";
	$pasword="";
	$currentMessages=0;
	$currentBlogPage=-1;
	/*	Valdeolivas =0
		Albendea=1
		Priego=2
		Cañamares=3
		Fuertescusa=4
		Poyatos=5
		Villaconejos=6
	*/
	//mysqli_report(MYSQLI_REPORT_ALL);
	error_reporting(-1);
	//ini_set(‘display_errors’, ‘true’);
	try{
		$conn=mysqli_connect($host,$user,$pasword,$bd);
		//echo $conn;
		
	}catch(exception $e){
		$myfile = fopen("debug.txt", "w") ;
		
	}
	if(isset($_POST['submit'])){

		//uploadImage();
		$path_parts = pathinfo($_FILES["fileToUpload"]);
		insertArticle($_POST['title'],$_POST['text'],$path_parts['dirname'],$_POST['autor'],$_POST['section']);
	 
	 }
	}else{
		if( !isset($_POST['functionname']) ) { 
			$aResult['error'] = 'No function name!'; 
		 } 
		else{
			switch($_POST['functionname']) {
				case 'getArticle':
					//return result of getChatbox
					 getArticle($_POST['arguments']);
					
				break;
				case 'insertArticle':
					//return result of getChatbox
					 insertArticle($_POST['arguments']);
					
				break;
				case 'setCurrentVillage':
					//return result of getChatbox
					 setCurrentVillage($_POST['arguments']);
					
				break;
				case 'getAllArticles':
					//return result of getChatbox
					 getAllArticles();
					
				break;
			}
		}
	}
	function setCurrentVillage($num){
		$GLOBALS["currentBlogPage"]=$num;
		echo $GLOBALS["currentBlogPage"]; 
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
	function editMeetTheVillageText(){
			try{
				
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
			
				$sql="UPDATE `blog` SET `village_desc`=? WHERE `id_blog`= ?;";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("si",$_POST['meetTheVillageText'],$GLOBALS["currentBlogPage"]);	
					/* execute statement */
					$stmt->execute();
					echo "working";
						
				} else {
					
					echo "error"."connection failure";
				}

						

			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
	}
	function addAgendaEntry(){
		try{
				
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
				$path_parts = pathinfo($_FILES["anouncementImage"]);
				$sql="INSERT INTO `anouncement`(`id_blog`,`title`,`date`,`text`,`src`) VALUE (?,?,?,?);";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("isss",$GLOBALS["currentBlogPage"],$_POST['anouncementTitle'],$_POST['anouncementDate'],$_POST['anouncementText'],$path_parts['dirname']);	
					/* execute statement */
					$stmt->execute();
					echo "working";
						
				} else {
					
					echo "error"."connection failure";
				}

						

			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	function addBusinessEntry(){
		try{
				
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
				$path_parts = pathinfo($_FILES["businessImage"]);
				$sql="INSERT INTO `business`(`name`,`telf`,`descrpition`,`src`,`type`,`addres`,`id_blog`) VALUE (?,?,?,?,?,?,?);";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("ssss",$_POST['businessName'],$_POST['businessText'],$path_parts['dirname'],$_POST['businessTipe'],$_POST['businessDir'],$GLOBALS["currentBlogPage"]);	
					/* execute statement */
					$stmt->execute();
					echo "working";
						
				} else {
					
					echo "error"."connection failure";
				}

						

			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	function editHistoryText(){
			try{
				
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
			
				$sql="UPDATE `blog` SET `history`=? WHERE `id_blog`= ?;";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("si",$_POST['historyText'],$GLOBALS["currentBlogPage"]);	
					/* execute statement */
					$stmt->execute();
					echo "working";
						
				} else {
					
					echo "error"."connection failure";
				}

						

			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
	}
	function editPOIText(){
			try{
				
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
			
				$sql="UPDATE `blog` SET `POI_text`=? WHERE `id_blog`= ?;";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("si",$_POST['POIText'],$GLOBALS["currentBlogPage"]);	
					/* execute statement */
					$stmt->execute();
					echo "working";
						
				} else {
					
					echo "error"."connection failure";
				}

						

			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
	}
	function addPOI(){
		try{
				
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
				$path_parts = pathinfo($_FILES["POIImage"]);
				$sql="INSERT INTO `interest_place`(`id_blog`,`text`,`src`) VALUE (?,?,?);";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("iss",$GLOBALS["currentBlogPage"],$_POST['POIText'],$path_parts['dirname']);	
					/* execute statement */
					$stmt->execute();
					echo "working";
						
				} else {
					
					echo "error"."connection failure";
				}

						

			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	/*ARTICLES*/
	function getArticle($id){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `user` WHERE `id_article`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $id,$date,$title,$text,$image,$autor,$tag);

						/* fetch values */
						$stmt->fetch();
					/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Match($id,$date,$title,$text,$image,$autor,$tag);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						echo json_encode($data,JSON_UNESCAPED_UNICODE);
					
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getAdmin($name,$pasword){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT id_admin FROM `admin` WHERE `name`=? AND `password`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("ss",$name,$pasword);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $res);

						/* fetch values */
						$stmt->fetch();
						
						if(empty($res)){
							echo "0";
							
						}else{
							echo "1";
						}	
					
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function insertArticle($title,$text,$image,$autor,$tag){
		
		try{
				
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
			
				$sql="INSERT INTO `article`(`title`,`text`,`image_src`,`editor_name`,`tags`) VALUE (?,?,?,?,?);";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("sssss",$title,$text,$image,$autor,$tag);	
					/* execute statement */
					$stmt->execute();
					echo "working";
						
				} else {
					
					echo "error"."connection failure";
				}

						

			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	function getAllArticles(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `matches`";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $id,$date,$title,$text,$image,$autor,$tag);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Match($id,$date,$title,$text,$image,$autor,$tag);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						echo json_encode($data,JSON_UNESCAPED_UNICODE);
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function uploadImage($dir){
	$target_dir = $dir.concat("/");
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	/*	// Check if file already exists
	if (file_exists($target_file)) {
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}*/

	// Check file size
	/*if ($_FILES["fileToUpload"]["size"] > 500000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}*/

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Solo se permiten archivos: JPG, JPEG, PNG y GIF.";
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "ERROR AL SUBIR ARCHIVO.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		
	  } else {
		  echo "ERROR AL SUBIR ARCHIVO.";
	  }
	}
	
	}
	
	
	