<?php
	//params
	$host="localhost";
	$bd="riveradb";//id13819712_db for hosting
	$user="root";
	$pasword="";
	$fatherDir="";
	$currentArticle=-1;
	$currentMessages=0;
	$currentBlogPage=-1;
	$ilegalChars = array(
		"#","%","&","{","}","\\","<",">","*","?","/","+","`","|","=","$","!","¿","¡","'",'"',":","@"
	);
	$ilegalWords = array(
		"select","delete","where","all","and","any","between","exists"
	);
	
	/*	Valdeolivas =0
	
		Albendea=1
		Priego=2
		Cañamares=3
		Fuertescusa=4
		Poyatos=5
		Villaconejos=6
	*/
	mysqli_report(MYSQLI_REPORT_ALL);
	error_reporting(-1);
	ini_set("display_errors", "true");
	try{
		$conn=mysqli_connect($host,$user,$pasword,$bd);
		//echo $conn;
		
	}catch(exception $e){
		$myfile = fopen("debug.txt", "w") ;
		
	}
	if(isset($_POST['submit'])){
		if(isset($_POST['articleTitle'])){
			insertArticle();
		}
	 	
	 }
	else{
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
					 insertArticle();
					
				break;
				case 'updateArticle':
					//return result of getChatbox
					 updateArticle();
					
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
		switch($GLOBALS["currentBlogPage"]){
			case 0:
				$GLOBALS["fatherDir"]="Valdeolivas/";
			break;
			case 1:
				$GLOBALS["fatherDir"]="Albendea/";
			break;
			case 2:
				$GLOBALS["fatherDir"]="Priego/";
			break;
			case 3:
				$GLOBALS["fatherDir"]="Canamares/";
			break;
			case 4:
				$GLOBALS["fatherDir"]="Fuertescusa/";
			break;
			case 5:
				$GLOBALS["fatherDir"]="Poyatos/";
			break;
			case 6:
				$GLOBALS["fatherDir"]="VillaconejosDeTrabaque/";
			break;
		}
		echo $GLOBALS["currentArticle"]; 
	}
	function setCurrenArticle($num){
		$GLOBALS["currentBlogPage"]=$num;
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
				$direction="";
				
				uploadImage("",$_FILES["anouncementImage"]);
				$name = $_FILES ['anouncementImage']['name'];
				
				$sql="INSERT INTO `anouncement`(`id_blog`,`title`,`date`,`text`,`src`) VALUE (?,?,?,?);";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("issss",$GLOBALS["currentBlogPage"],$_POST['anouncementTitle'],$_POST['anouncementDate'],$_POST['anouncementText'],$name);	
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
				$name = $_FILES ['businessImage']['name'];
				
				$sql="INSERT INTO `business`(`name`,`telf`,`descrpition`,`src`,`type`,`addres`,`id_blog`) VALUE (?,?,?,?,?,?,?);";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("ssss",$_POST['businessName'],$_POST['businessText'],$name,$_POST['businessTipe'],$_POST['businessDir'],$GLOBALS["currentBlogPage"]);	
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
				$name = $_FILES ['POIImage']['name'];
				$sql="INSERT INTO `interest_place`(`id_blog`,`text`,`src`) VALUE (?,?,?);";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("iss",$GLOBALS["currentBlogPage"],$_POST['POIText'],$name);	
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
	function insertArticle(){
		try{
			$allOK=true;
			if(empty($_POST['articleTitle']) || empty($_POST['articleAutor']) || empty($_POST['articleDate']) ||
				empty($_POST['articleTag']) || empty($_POST['articleText'])){
				echo "rellena todos los campos obligatorios ";
			}else{
				if (!$GLOBALS["conn"]) {
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
					
				}else{
					$articleFileName=strtolower($_POST['articleTitle']);
					$articleFileName=trim($articleFileName," ");
					$articleFileName=trim($articleFileName,'"');
					$articleFileName=str_replace(" ","-",$articleFileName);
					$articleFileName=str_replace ($GLOBALS["ilegalChars"],"",$articleFileName); 
					
					
					$dir="E:\\xampp\\htdocs\\trabajo-rivera\\Boletin\\Secciones\\";
					$fulldir=$dir. ucfirst($_POST['articleTag'])."\\".$articleFileName;
					echo $fulldir;
					
					
					$name="";
					$title="";
					
					if(!empty($_POST['articleImg'])){
						$name = $_FILES ['articleImg']['name'];
					}else{
						$name=null;
					}
					if(isset($_POST['articleTitle'])){
						$title=$_POST['articleTitle'];
					}else{
						$title=null;
					}
					$name = $_FILES ['articleImg']['name'];
					if (!file_exists($fulldir)) {
						mkdir($fulldir, 0777);
						if(!$name==null){
							if(!uploadImage($fulldir,$_FILES ['articleImg'])){
								$allOK=false;
							}
						}
						if(!createArticle("articulo",$fulldir)){
							$allOK=false;
							echo "<br>fallo al crear la pagina del articulo</br>";
						}
					}else{
						$allOK=false;
						echo "<br>fallo al crear el directorio</br>";
					}
					
					
					//$size = $_FILES ['articleImg']['size'];
					//$type = $_FILES ['articleImg']['type'];
					//$tmp_name = $_FILES ['articleImg']['tmp_name'];
					//$error = $_FILES ['articleImg']['error'];				
					
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					//$placeholder="lol.png";
					
					$sql="INSERT INTO `article`(`date`,`title`,`text`,`image_src`,`image_desc`,`editor_name`,`tags`) VALUE (?,?,?,?,?,?,?);";	
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						
						$stmt->bind_param("sssssss",$_POST['articleDate'],$_POST['articleTitle'],$_POST['articleText'],$name,$title,$_POST['articleAutor'],$_POST['articleTag']);	
						if($allOK){
							$stmt->execute();
							echo "<br>Los datos del articulo han sido insertados</br>";
						}else {					
							echo "<br>error "."articulo no creado</br>";
						}
					}

						
				}
			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
		
	}
	function updateArticle($id){
		try{
			$path_parts = pathinfo($_FILES["articleImg"]);	
			if (!$GLOBALS["conn"]) {
				die("Connection failed: " . $GLOBALS["conn"]->connect_error);
				
			}else{
				$name = $_FILES ['articleUpdateImg']['name'];
				$sql="UPDATE `article`SET`title`=?,`text`=?,`image_src`=?,`editor_name`=?,`tags=?`) WHERE `id_article`=?;";	
				//$stmt = $GLOBALS["conn"]->prepare($sql);		
				
				if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
					$stmt->bind_param("sssssi",$_POST['articleUpdateTitle'],$_POST['articleUpdateText'],$name,$_POST['articleUpdateAutor'],$_POST['articleUpdateTag'],$GLOBALS["currentBlogPage"]);	
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
	function createArticle($name,$target_file){
		$html = file_get_contents('E:\\xampp\\htdocs\\trabajo-rivera\\Boletin\\Secciones\\articleExample\\articleTemplate.html',1);
		$pdfHtml = $target_file."\\".$name.'.html';
		$html=insertDataToFile($html);
		
		// or you have the option to do nothing and assume it is made
		if (file_put_contents($pdfHtml, $html)!==false) {
			echo "<br>Success :  has been made</br>";
			return true;
		} else {
			echo "<br>Failure:  does not exist</br>";
			return false;
		}
	}
	function insertDataToFile($file){
	//	$file = file_get_contents('articulo.html');
		$file = str_replace('%TITLE%', $_POST['articleTitle'],$file);
		
		if (!empty($_FILES['articleImg']['name'])) {
			$file = str_replace("%IMAGESRC%",$_FILES ['articleImg']['name'],$file);
			$file = str_replace('%IMAGEDESC%', $_POST['articleImageDesc'],$file);
		}else{
			$file = str_replace('<img src="%IMAGESRC%"></img>'," ",$file);
			$file = str_replace('%IMAGEDESC%'," ",$file);
		//	$file = str_replace('<p> %IMAGEDESC%</p>',"",$file);
		}
		$date=date_create($_POST['articleDate']);
		$file = str_replace('%DATE%',date_format($date,"d/m/Y"),$file);
		$file = str_replace('%TEXT%', $_POST['articleText'],$file);
		$file = str_replace('%TAG%', ucfirst($_POST['articleTag']),$file);
		$file = str_replace('%AUTOR%', $_POST['articleAutor'],$file);
		//$file = str_replace('%DATE%', $_POST['articleText']);
		
		return $file;
	}
	function uploadImage($dir,$img){
		$target_file = $dir .'\\'. basename($img["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($img["tmp_name"]);
		if($check !== false) {
			echo "<br>El archivo es una imagen- " . $check["mime"] . ". </br>";
			$uploadOk = 1;
		} else {
			echo "<br>El archivo no es una imagen</br> ";
			$uploadOk = 0;
		}
			// Check if file already exists
		if (file_exists($target_file)) {
		  echo "<br>ERROR, EL ARCHIVO YA EXISTE</br>";
		  $uploadOk = 0;
		  
		}

		// Check file size
		/*if ($_FILES["fileToUpload"]["size"] > 500000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}*/

		
		// Allow certain file formats
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "<br>Solo se permiten archivos: JPG, JPEG, PNG y GIF.</br>";
		  $uploadOk = 0;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "<br>ERROR AL SUBIR ARCHIVO.</br>";
		  return false;
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($img["tmp_name"], $target_file)) {
			 return true;
		  } else {
			  echo "<br>ERROR AL SUBIR ARCHIVO.</br>";
			    return false;
		  }
		}
	
	}
	
	
	