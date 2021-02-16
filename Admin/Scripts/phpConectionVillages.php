<?php
	$host="localhost";
	$bd="riveradb";//id13819712_db for hosting
	$user="root";
	$pasword="";
	$fatherDir="";
	
	$villageFatherDir="E:\\xampp\\htdocs\\trabajo-rivera\\Blogs\\";
	
	$currentVillageDir="";
	
	$currentBlogPage=-1;
	$ilegalChars = array(
		"#","%","&","{","}","\\","<",">","*","?","/","+","`","|","=","$","!","¿","¡","'",'"',":","@"
	);
	$ilegalWords = array(
		"select","delete","where","all","and","any","between","exists"
	);
	class Bussines implements JsonSerializable {
		private  $id,$title;
		function __construct($id,$title) {
			$this->setId($id);
			$this->setTitle($title);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		function getId(){
			return $this->id;
		}

		function getTitle(){
			return $this->title;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"title"=>$this->getTitle()
			
			   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
	class AgendaEntry implements JsonSerializable {
		private  $id,$title;
		function __construct($id,$title) {
			$this->setId($id);
			$this->setTitle($title);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		function getId(){
			return $this->id;
		}

		function getTitle(){
			return $this->title;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"title"=>$this->getTitle()
			
			   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
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
	ini_set("display_errors", "true");
	try{
		$conn=mysqli_connect($host,$user,$pasword,$bd);
		//echo $conn;
		
	}catch(exception $e){
		$myfile = fopen("debug.txt", "w") ;
		
	}
	if(!isset($_COOKIE["CurrentVillage"])) {
	 // echo "seleccione un pueblo para editar";
	} else {
	  
		setCurrentVillage ($_COOKIE["CurrentVillage"]);
	}	
	if(isset($_POST['updateImageCarrousel'])){
		
		updateImageCarrousel();
	
	}
	if(isset($_POST['updateMeetTheVillage'])){
		
		editMeetTheVillageText();
		
	}
	if(isset($_POST['updateAgendaEntry'])){
		
		addAgendaEntry();
	
	}
	if(isset($_POST['insertBussines'])){
		
		addBusinessEntry();
	
	}
	if(isset($_POST['updateHistory'])){
		
		editHistoryText();
	
	}	
	if(isset($_POST['updatePOIText'])){
		
		editPOIText();
	
	}
	if(isset($_POST['insertPOI'])){
		
		addPOI();
	
	}
	if( !isset($_POST['functionname']) ) { 
		$aResult['error'] = 'No function name!'; 
	 } 
	else{
		switch($_POST['functionname']) {
		
			case 'setCurrentVillage':
				
				 setCurrentVillage($_POST['arguments']);
			break;

			case 'getAllArticles':
				
				 getAllArticles();				
			break;
			case 'getAllBussines':
				
				 getAllBussines();				
			break;
			case 'getAllAgendas':
				
				 getAllAgendas();				
			break;
			case 'getHistory':
				
				 getHistory($_POST['arguments']);				
			break;
			case 'getMTV':
			
				 getMTV();				
			break;
			case 'getPOIText':
				
				 getPOIText();			
			break;
			
			case 'deleteBussines':
								
				 deleteBussines($_POST['arguments'][0],$_POST['arguments'][1]);				
			break;
			case 'deleteAgendaEntry':
				
				 deleteArticle($_POST['arguments'][0],$_POST['arguments'][1]);
			break;
		}
	}	
	function setCurrentVillage($num){
		$GLOBALS["currentBlogPage"]=$num;
		switch($GLOBALS["currentBlogPage"]){
			case 0:
				$GLOBALS["currentVillageDir"]="Valdeolivas/";
			break;
			case 1:
				$GLOBALS["currentVillageDir"]="Albendea/";
			break;
			case 2:
				$GLOBALS["currentVillageDir"]="Priego/";
			break;
			case 3:
				$GLOBALS["currentVillageDir"]="Canamares/";
			break;
			case 4:
				$GLOBALS["currentVillageDir"]="Fuertescusa/";
			break;
			case 5:
				$GLOBALS["currentVillageDir"]="Poyatos/";
			break;
			case 6:
				$GLOBALS["currentVillageDir"]="VillaconejosDeTrabaque/";
			break;
		}
		
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
	function rrmdir($dir) { 
		//echo $dir;
	   if (is_dir($dir)) { 
		 $objects = scandir($dir);
		 foreach ($objects as $object) { 
		   if ($object != "." && $object != "..") { 
			 if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
			   rrmdir($dir. DIRECTORY_SEPARATOR .$object);
			 else
				//echo "<br>removing : ".$dir. DIRECTORY_SEPARATOR .$object;
			   unlink($dir. DIRECTORY_SEPARATOR .$object); 
		   } 
		 }
		 rmdir($dir); 
	   } 
	}
	function getAllBussines(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT `id_business`,`name` FROM `business` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",currentBlogPage);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$name);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Bussines($id,$name);
							
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
	function getAllAgendas(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT `id_anouncement `,`title` FROM `business` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",currentBlogPage);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$name);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Bussines($id,$name);
							
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
	function getHistory($id){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT `history` FROM `blog` WHERE `id_blog`=?";	
					//echo $GLOBALS["currentBlogPage"];
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$id);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($text);

						/* fetch values */
						echo $text;
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getMTV(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT `village_desc` FROM `blog` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$GLOBALS["currentBlogPage"]);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($text);

						/* fetch values */
						echo $text;
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getPOIText(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT `POI_text` FROM `blog` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",currentBlogPage);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($text);

						/* fetch values */
						echo $text;
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function editMeetTheVillageText(){
		try{
			
			if(empty($_POST['meetTheVillageText'])){
				echo "rellena el campo \"Contenido\" ";
			}else{
				
				if (!$GLOBALS["conn"]) {
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
				}else{
			
					$sql="UPDATE `blog` SET `village_desc`=? WHERE `id_blog`= ?;";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("si",$_POST['meetTheVillageText'],$GLOBALS["currentBlogPage"]);	
						/* execute statement */
						$stmt->execute();
						echo "<br>".$_POST['meetTheVillageText'];
						echo "<br>".$GLOBALS['currentBlogPage'];
						echo "Texto cambiado";
							
					}else {
						
						echo "error"."fallo de conexión";
					}
				}
			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
	}
	function addAgendaEntry(){
		try{
			if(empty($_POST['anouncementTitle']) || !empty($_POST['anouncementImage']) 
			|| empty($_POST['anouncementDate']) || empty($_POST['anouncementText']) ){
				
				echo "rellena todos los campos";
			}else{	
				$direction="Imagenes";
				$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
				
				if(!uploadImage($fulldir,$_FILES ['anouncementImage'])){
					$allOK=false;
				}
											
				if (!$GLOBALS["conn"] && $allOK){
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
					
				}else{
					$name = $_FILES ['anouncementImage']['name'];
					
					$sql="INSERT INTO `anouncement`(`id_blog`,`title`,`date`,`text`,`src`) VALUE (?,?,?,?,?);";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("issss",$GLOBALS["currentBlogPage"],$_POST['anouncementTitle'],$_POST['anouncementDate'],$_POST['anouncementText'],$name);	
						/* execute statement */
						$stmt->execute();
						echo "nueva entarda en la agenda creada";
							
					} else {
						
						echo "error"."connection failure";
					}

							

				}
			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	function addBusinessEntry(){
		try{
			if(empty($_POST['businessName']) ||empty($_POST['businessDir']) || empty($_POST['businessPhone']) 
			|| !empty($_POST['businessImage']) || empty($_POST['businessText']) || empty($_POST['businessTipe'])){
				echo "rellena todos los campos";
			}else{	
				$allOK=true;
				$direction="";
				$direction="";
				switch($_POST['businessTipe']){
					case "hotel":
						$direction="\\DondeDormir\\Imagenes";
					break;
					case "restaurant":
						$direction="\\DondeComer\\Imagenes";
					break;
					case "other":
						$direction="\\NegociosLocales\\Imagenes";
					break;
					
				}
				echo $direction;
				$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
					echo $fulldir;
				if(!uploadImage($fulldir,$_FILES ['businessImage'])){
					$allOK=false;
				}
											
				if (!$GLOBALS["conn"] && $allOK){
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
				}else{
					$name = $_FILES ['businessImage']['name'];
					
					$sql="INSERT INTO `business`(`name`,`telf`,`descrpition`,`src`,`type`,`addres`,`id_blog`) VALUE (?,?,?,?,?,?,?);";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("sssssss",$_POST['businessName'],$_POST['businessPhone'],$_POST['businessText'],$name,$_POST['businessTipe'],$_POST['businessDir'],$GLOBALS["currentBlogPage"]);	
						/* execute statement */
						$stmt->execute();
						echo "nuevo negocio insertado con exito";
							
					} else {
						
						echo "error"."connection failure";
					}

							

				}
			}
			
			
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	function editHistoryText(){
		try{
			if(empty($_POST['historyText'])){
				echo "rellena el campo \"Contenido\" ";
			}else{
				if (!$GLOBALS["conn"]) {
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
				}else{
				
					$sql="UPDATE `blog` SET `history`=? WHERE `id_blog`= ?;";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("si",$_POST['historyText'],$GLOBALS["currentBlogPage"]);	
						/* execute statement */
						$stmt->execute();
						echo "texto cambiado";
							
					} else {
						
						echo "error"."connection failure";
					}

							

				}
			}
			
		}catch(exception $e){
			echo "error"." ".$e;
		}
	}
	function editPOIText(){
		try{
			if(empty($_POST['POIText'])){
				echo "rellena el campo \"Contenido\" ";
			}else{
				if (!$GLOBALS["conn"]) {
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
				}else{
				
					$sql="UPDATE `blog` SET `POI_text`=? WHERE `id_blog`= ?;";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("si",$_POST['POIText'],$GLOBALS["currentBlogPage"]);	
						/* execute statement */
						$stmt->execute();
						echo "texto cambiado";
							
					} else {
						
						echo "error"."connection failure";
					}

							

				}
			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
	}
	function addPOI(){
		try{
			if(empty($_POST['POIText'])||!empty($_POST['POIImage'])){
				echo "rellena todos los campos";
			}else{
				$allOK=true;
				$direction="//Imagenes";
				$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
				if(!uploadImage($fulldir,$_FILES ['POIImage'])){
					$allOK=false;
				}
											
				if (!$GLOBALS["conn"] && $allOK){
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
				}else{
					
					$name = $_FILES ['POIImage']['name'];
					$sql="INSERT INTO `interest_place` (`id_blog`,`text`,`image`) VALUE (?,?,?);";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("iss",$GLOBALS["currentBlogPage"],$_POST['POIText'],$name);	
						/* execute statement */
						$stmt->execute();
						echo "lugar de interes añadido";
							
					} else {
					
						echo "error "."connection failure: ".$GLOBALS["conn"]->connect_error;
					}

							

				}
			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	function deleteBussines($id,$image){
			$direction="Imagenes\\".$image;
			$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
		if (file_exists($fulldir) ){
			echo "<br> full:".$fulldir;
			unlink($fulldir);
			
			/*if (file_exists($fulldir)) {
				echo $fulldir;
				unlink($fulldir);
			}*/
		}
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="DELETE FROM `business` WHERE `business`.`id_business` = ?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
							
						echo "<br>Los datos del negocio han sido borrados</br>";
					
					} else {
						echo "ERROR el negocio no existe ";
					}

				}
		}catch(exception $e){
			//echo "ERROR:".$e;
		}
	}
	function deleteAgendaEntry($id,$image){
			$direction="Imagenes\\".$image;
			$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
		if (file_exists($fulldir) ){
			echo "<br> full:".$fulldir;
			unlink($fulldir);
			
			/*if (file_exists($fulldir)) {
				echo $fulldir;
				unlink($fulldir);
			}*/
		}
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="DELETE FROM `anouncement` WHERE `anouncement`.`id_anouncement` = ?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
							
						echo "<br>Los datos de la agenda han sido borrados</br>";
					
					} else {
						echo "la agenda no existe ";
					}

				}
		}catch(exception $e){
			//echo "ERROR:".$e;
		}
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
?>