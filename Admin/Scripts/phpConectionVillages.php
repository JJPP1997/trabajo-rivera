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
		private  $id,$title,$image,$type;
		function __construct($id,$title,$image,$type) {
			$this->setId($id);
			$this->setTitle($title);
			$this->setImage($image);
			$this->setBType($type);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		public function setImage($image) {
			$this->image = $image;
		}
		public function setBType($type) {
			$this->type = $type;
		}
		function getId(){
			return $this->id;
		}
		function getImage(){
			return $this->image;
		}
		function getTitle(){
			return $this->title;
		}
		function getBType(){
			return $this->type;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"title"=>$this->getTitle(),
				"image"=>$this->getImage(),
				"type"=>$this->getBType()
			
			   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
	class AgendaEntry implements JsonSerializable {
		private  $id,$title,$image;
		function __construct($id,$title,$image) {
			$this->setId($id);
			$this->setTitle($title);
			$this->setImage($image);
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
		public function setImage($image) {
			$this->image = $image;
		}
		function getImage(){
			return $this->image;
		}
		function getTitle(){
			return $this->title;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"title"=>$this->getTitle(),
				"image"=>$this->getImage()				
			   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
	class CarrouselImage implements JsonSerializable {
		private  $id,$image;
		function __construct($id,$image) {
			$this->setId($id);
			$this->setImage($image);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setImage($image) {
			$this->image = $image;
		}
		function getId(){
			return $this->id;
		}

		function getImage(){
			return $this->image;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"image"=>$this->getImage()
			
			   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
	class Blog implements JsonSerializable {
		private  $id,$name,$desc,$history,$map,$poiText;
		function __construct($id,$name,$desc,$history,$map,$poiText) {
			$this->setId($id);
			$this->setName($name);
			$this->setDesc($desc);
			$this->setHistory($history);
			$this->setMap($map);
			$this->setPoiText($poiText);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setName($name) {
			$this->name = $name;
		}
		public function setDesc($desc) {
			$this->desc = $desc;
		}
		public function setHistory($history) {
			$this->history = $history;
		}
		public function setMap($map) {
			$this->map = $map;
		}
		public function setPoiText($poiText) {
			$this->poiText = $poiText;
		}
		function getId(){
			return $this->id;
		}
		function getName(){
			return $this->name;
		}
		function getDesc(){
			return $this->desc;
		}
		function getHistory(){
			return $this->history;
		}
		function getMap(){
			return $this->map;
		}
		function getPoiText(){
			return $this->poiText;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"name"=>$this->getName(),
				"desc"=>$this->getDesc(),
				"history"=>$this->getHistory(),
				"map"=>$this->getMap(),
				"poiText"=>$this->getPoiText()
				   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
	class Galery implements JsonSerializable {
		private $id,$blogId,$title,$date;
		function __construct($id,$blogId,$title,$Gdate) {
			$this->setId($id);
			$this->setBlogId($blogId);
			$this->setTitle($title);
			$this->setGDate($Gdate);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setBlogId($blogId) {
			$this->blogId = $blogId;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		public function setGDate($date) {
			$this->Gdate = $date;
		}
		function getId(){
			return $this->id;
		}
		function getBlogId(){
			return $this->blogId;
		}
		function getTitle(){
			return $this->title;
		}
		function getGDate(){
			return $this->Gdate;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"title"=>$this->getTitle()
			
				   
			],JSON_UNESCAPED_UNICODE);
		}
	}
	class ImageGalery implements JsonSerializable {
		private $id,$galeryId,$text,$image;
		function __construct($id,$galeryId,$text,$image) {
			$this->setId($id);
			$this->setGaleryId($galeryId);
			$this->setText($text);
			$this->setImage($image);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setGaleryId($galeryId) {
			$this->galeryId = $galeryId;
		}
		public function setText($text) {
			$this->text = $text;
		}
		public function setImage($image) {
			$this->image = $image;
		}
		function getId(){
			return $this->id;
		}
		function getGaleryId(){
			return $this->galeryId;
		}
		function getImageText(){
			return $this->text;
		}
		function getImage(){
			return $this->image;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"image"=>$this->getImage()
				   
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
	  echo "seleccione un pueblo para editar y no limpie el cache";
	} else {
	  
		setCurrentVillage ($_COOKIE["CurrentVillage"]);
		
		if(isset($_POST['addImageCarrousel'])){

			addImageCarrousel();
		
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
		if(isset($_POST['insertNewGalery'])){
			
			addGalery();
		
		}
		if(isset($_POST['insertImageToGalery'])){
			
			addImageToGalery();
		
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
				case 'getAllCarrouselImages':
					
					 getAllCarrouselImages();				
				break;
				case 'getAllGaleries':
					
					 getAllGaleries();				
				break;
				case 'getAllImagesFromGalery':
					
					 getAllImagesFromGalery();				
				break;
				case 'getBlog':
					
					 getBlog();				
				break;
				case 'getMTV':
				
					 getMTV();				
				break;
				case 'getPOIText':
					
					 getPOIText();			
				break;
				
				case 'deleteBussines':
									
					 deleteBussines($_POST['arguments'][0],$_POST['arguments'][1],$_POST['arguments'][2]);				
				break;
				case 'deleteAgendaEntry':
					
					 deleteAgendaEntry($_POST['arguments'][0],$_POST['arguments'][1]);
				break;
				case 'deleteGalery':
									
					 deleteGalery($_POST['arguments'][0],$_POST['arguments'][1]);				
				break;
				case 'deleteGaleryImage':
									
					 deleteGaleryImage($_POST['arguments'][0],$_POST['arguments'][1]);				
				break;
			
			}
		}	
	}

	function setCurrentVillage($num){
		$GLOBALS["currentBlogPage"]=$num;
		switch($GLOBALS["currentBlogPage"]){
			case 0:
				$GLOBALS["currentVillageDir"]="Valdeolivas\\";
			break;
			case 1:
				$GLOBALS["currentVillageDir"]="Albendea\\";
			break;
			case 2:
				$GLOBALS["currentVillageDir"]="Priego\\";
			break;
			case 3:
				$GLOBALS["currentVillageDir"]="Canamares\\";
			break;
			case 4:
				$GLOBALS["currentVillageDir"]="Fuertescusa\\";
			break;
			case 5:
				$GLOBALS["currentVillageDir"]="Poyatos\\";
			break;
			case 6:
				$GLOBALS["currentVillageDir"]="VillaconejosDeTrabaque\\";
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
				echo "<br>removing : ".$dir. DIRECTORY_SEPARATOR .$object;
				fclose($dir. DIRECTORY_SEPARATOR .$object);
			   unlink($dir. DIRECTORY_SEPARATOR .$object); 
		   } 
		 }
		 rmdir($dir); 
	   } 
	}
	function getAllGaleries(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `blog_galery` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$GLOBALS["currentBlogPage"]);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_blog,$itle,$date);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Galery($id,$id_blog,$itle,$date);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						$json= json_encode($data,JSON_UNESCAPED_UNICODE);
						if (json_last_error() === JSON_ERROR_NONE) {
							echo $json;
						}else{
							echo json_encode (new stdClass);
						}
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getAllImagesFromGalery(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `galery_image` WHERE `id_galery`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$_COOKIE["CurrentGaleryId"]);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_galery,$text,$src);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new ImageGalery($id,$id_galery,$text,$src);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						$json= json_encode($data,JSON_UNESCAPED_UNICODE);
						if (json_last_error() === JSON_ERROR_NONE) {
							echo $json;
						}else{
							echo json_encode (new stdClass);
						}
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getAllCarrouselImages(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `blog_title_image` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$GLOBALS["currentBlogPage"]);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_blog,$text,$src);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new CarrouselImage($id,$src);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						$json= json_encode($data,JSON_UNESCAPED_UNICODE);
						if (json_last_error() === JSON_ERROR_NONE) {
							echo $json;
						}else{
							echo json_encode (new stdClass);
						}
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getAllBussines(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `business` WHERE `business`.`id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$GLOBALS["currentBlogPage"]);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$name,$telf,$desc,$src,$type,$address,$id_blog);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
						
							$e=new Bussines($id,$name,$src,$type);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						$json= json_encode($data,JSON_UNESCAPED_UNICODE);
						if (json_last_error() === JSON_ERROR_NONE) {
							echo $json;
						}else{
							echo json_encode (new stdClass);
						}
						
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
					$sql="SELECT * FROM `anouncement` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$GLOBALS["currentBlogPage"]);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_blog,$title,$date,$text,$src);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new AgendaEntry($id,$title,$src);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						$json= json_encode($data,JSON_UNESCAPED_UNICODE);
						if (json_last_error() === JSON_ERROR_NONE) {
							echo $json;
						}else{
							echo json_encode (new stdClass);
						}
						
					} else {
						echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getBlog(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `blog` WHERE `blog`.`id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$GLOBALS["currentBlogPage"]);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $id,$name,$desc,$history,$map,$poiText);
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Blog($id,$name,$desc,$history,$map,$poiText);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						echo json_encode($data,JSON_UNESCAPED_UNICODE);
						/* fetch values */
					
						
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
			$allOK=true;
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
	function addImageCarrousel(){
		try{
			$allOK=true;
			if(empty($_POST['carrouselImageText']) || !empty($_POST['carrouselImage'])){
				
				echo "rellena todos los campos";
			}else{	
				$direction="Imagenes";
				$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
				
				if(!uploadImage($fulldir,$_FILES ['carrouselImage'])){
					$allOK=false;
				}
											
				if (!$GLOBALS["conn"]){
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
					
				}else{
					$name = $_FILES ['carrouselImage']['name'];
					
					$sql="INSERT INTO `blog_title_image`( `id_blog`, `text`, `src`) VALUES (?,?,?);";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						if($allOK){
							$stmt->bind_param("iss",$GLOBALS["currentBlogPage"],$_POST['carrouselImageText'],$name);	
							/* execute statement */
							$stmt->execute();
							echo "nueva Imagen creada con exito";
						}else{
							echo "no se ha podido subir el archivo de la imagen";
						}
						
							
					} else {
						
						echo "error"."connection failure";
					}

							

				}
			}
		}catch(exception $e){
			echo "error"." ".$e;
		}
		
	}
	function addGalery(){
		try{
			$allOK=true;
			if(empty($_POST['newGaleryTitle']) || empty($_POST['addGaleryDate']) ){
				
				echo "rellena todos los campos";
			}else{	
				
				$filename=titleToDir($_POST['newGaleryTitle']);
				$direction="Galerias\\";
				$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction.$filename;
				if (!file_exists($fulldir)) {
					mkdir($fulldir, 0777);
					$imagesDir=$fulldir."\\Imagenes";
					mkdir($imagesDir, 0777);
					
					if(!empty($_POST['newGaleryDirname'])){
						if(!file_exists($_POST['newGaleryDirname'])){
							echo "error, el archivo a copiar no existe";
							$allOK=false;
						}else{
							recursive_copy($_POST['newGaleryDirname'],$imagesDir);
						}
					}
					createGaleryPage($filename,$fulldir);
					
					
				}else{
					$allOK=false;
					echo "<br>fallo al crear el directorio</br>";
				}
			
											
				if (!$GLOBALS["conn"] && $allOK){
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
					
				}else{
					
					
					$sql="INSERT INTO `blog_galery`( `id_blog`, `title`, `date`) VALUES (?,?,?);";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						if($allOK){
							$stmt->bind_param("iss",$GLOBALS["currentBlogPage"],$_POST['newGaleryTitle'],$_POST['addGaleryDate']);	
							/* execute statement */
							$stmt->execute();
							echo "nueva galeria creada";
						}else{
							echo "error,no se ha podido subirlos archivos";
						}
						
							
					} else {
						
						echo "error fallo de conexión";
					}

							

				}
			}
			
		}catch(exception $e){
			echo "error"." ".$e;
		}
	}
	
	function addImageToGalery(){
		try{
			$allOK=true;
			if(!isset($_COOKIE["CurrentGalery"])){
				echo "seleccione una galeria no limpie el cache ni las cookies";
			}else{
				if(empty($_POST['addImageToGaleryText']) || !empty($_POST['addImageToGalery'])){
					
					echo "rellena todos los campos";
				}else{	
					$direction="Galerias\\".titleToDir($_COOKIE["CurrentGalery"])."\\Imagenes";
					$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
					
					if(!uploadImage($fulldir,$_FILES ['addImageToGalery'])){
						$allOK=false;
					}
												
					if (!$GLOBALS["conn"] && $allOK){
						die("Connection failed: " . $GLOBALS["conn"]->connect_error);
						
						
					}else{
						$name = $_FILES ['addImageToGalery']['name'];
						
						$sql="INSERT INTO `galery_image`( `id_galery`, `text`, `image_src`) VALUES (?,?,?);";	
						//$stmt = $GLOBALS["conn"]->prepare($sql);		
						
						if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
							$stmt->bind_param("iss",$_COOKIE["CurrentGaleryId"],$_POST['addImageToGaleryText'],$name);	
							/* execute statement */
							$stmt->execute();
							echo "nueva Imagen creada";
								
						} else {
							
							echo "error"."connection failure";
						}

								

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
						$direction="DondeDormir\\Imagenes";
					break;
					case "restaurant":
						$direction="DondeComer\\Imagenes";
					break;
					case "other":
						$direction="NegociosLocales\\Imagenes";
					break;
					
				}
			
				$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
					echo $fulldir;
				if(!uploadImage($fulldir,$_FILES ['businessImage'])){
					$allOK=false;
				}
											
				if (!$GLOBALS["conn"] && $allOK){
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
				}else{
					$name = $_FILES ['businessImage']['name'];
					
					$sql="INSERT INTO `business`(`name`,`telf`,`descripition`,`src`,`type`,`address`,`id_blog`) VALUE (?,?,?,?,?,?,?);";	
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
	//addGaleryFromDir($dir,$newDir);
	function recursive_copy($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					recursive_copy($src .'/'. $file, $dst .'/'. $file);
				}
				else {
					copy($src .'/'. $file,$dst .'/'. $file);
				}
			}
		}
		closedir($dir);
	}
	
	function deleteGalery($id,$name){
			$allOk=true;
			$direction="Galerias\\".titleToDir($name);
			$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
		
		try{
			echo $fulldir;
			if (file_exists($fulldir) ){
				//echo "full:".$fulldir;		
				rrmdir($fulldir);
			}else{
				$allOk=false;
			}
			if (!$GLOBALS["conn"]){
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="DELETE FROM `blog_galery` WHERE `id_blog_galery` = ?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						echo "Los datos de la galeria se han borrado de la bdd";
						if($allOk){	
							echo "Los archivos han sido borrados";
						}else{
							echo "error, los archivos no han podido ser borrados";
						}
						
					
					} else {
						echo "ERROR la galeria no existe ";
					}

				}
		}catch(exception $e){
			//echo "ERROR:".$e;
		}
	}
	function deleteGaleryImage($id,$imageName){
	
		try{
			if(!isset($_COOKIE["CurrentGalery"])){
				echo "seleccione una galeria no limpie el cache ni las cookies";
			}else{
				$allOk=true;
				$direction="Galerias\\".titleToDir($_COOKIE["CurrentGalery"])."\\Imagenes\\".$imageName;
				$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
				if (file_exists($fulldir) ){
						
					chmod($fulldir, 0777);
					$allOk=unlink($fulldir);
					
					/*if (file_exists($fulldir)) {
						echo $fulldir;
						unlink($fulldir);
					}*/
				}else{
				
					$allOk=false;
				}
				if (!$GLOBALS["conn"]) {
						
						die("Connection failed: " . $GLOBALS["conn"]->connect_error);
						echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
					}
					else{
						$sql="DELETE FROM `galery_image` WHERE `id_galery_image`= ?";	
						
						if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
							$stmt->bind_param("i",$id);	
							/* execute statement */
							$stmt->execute();
								echo "Los datos de la imagen se han borrado de la bdd";
							if($allOk){	
								echo "error, los archivos han sido borrados";
							}else{
								echo "error, los archivos no han podido ser borrados";
							}
							
						
						} else {
							echo "ERROR la galeria no existe ";
						}

					}
			}
		}catch(exception $e){
			//echo "ERROR:".$e;
		}
	}
	function deleteBussines($id,$image,$type){
			$allOk=true;
			$direction="";
			switch($type){
				case "hotel":
					$direction="DondeDormir\\Imagenes\\";
				break;
				case "restaurant":
					$direction="DondeComer\\Imagenes\\";
				break;
				case "other":
					$direction="NegociosLocales\\Imagenes\\";
				break;
					
			}
			$direction=$direction.$image;
			$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
			//echo $fulldir;
			//echo"<br>";
		
		try{

			if (file_exists($fulldir) ){
				chmod($fulldir, 0777);
				$allOk=unlink($fulldir);
				/*if (file_exists($fulldir)) {
					echo $fulldir;
					unlink($fulldir);
				}*/
			}else{
				$allOk=false;
				echo "error,la imagen en ".$fulldir."no existe";
			}
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
						echo "Los datos del negocio han sido borrados";
						if($allOk){
							
							echo "la imagen  ha sido borrada";
							
						}else{
							echo "error,la imagen no ha podido ser borrada";
						}
						
					
					} else {
						echo "ERROR el negocio no existe ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function deleteAgendaEntry($id,$image){
			$allOk=true;
			$direction="Imagenes\\".$image;
			$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
		
		try{
			if (file_exists($fulldir) ){
				//echo "full:".$fulldir;		
				chmod($fulldir, 0777);
				$allOk=unlink($fulldir);
				
				/*if (file_exists($fulldir)) {
					echo $fulldir;
					unlink($fulldir);
				}*/
			}else{
				$allOk=false;
			}
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="DELETE FROM `anouncement` WHERE `id_anouncement` = ?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						echo "Los datos de la agenda han sido borrados";
						if($allOk){	
							echo "la imagen ha sido borrada";
						}else{
							echo "error,la imagen no ha podido ser borrada";
						}
						
					
					} else {
						echo "ERROR la agenda no existe ";
					}

				}
		}catch(exception $e){
			//echo "ERROR:".$e;
		}
	}
	function deleteCarrouselImage($id,$image){
			$direction="Imagenes\\".$image;
			$allOk=true;
			$fulldir=$GLOBALS["villageFatherDir"].$GLOBALS["currentVillageDir"].$direction;
		
		try{
			if (file_exists($fulldir) ){
				
				chmod($fulldir, 0777);
			//	chmod($fulldir, 0777);
				$allOk=unlink($fulldir);
			}else{
				$allOk=false;
			}
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="DELETE FROM `blog_title_image` WHERE `id_blog_title_image`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						echo "Los datos de la imagen ha sido borrada";
						if($allOk){
							echo "La imagen ha sido borrada";
						}else{
							echo "error,La imagen no ha podido ser borrada";
						}
					
					} else {
						echo "la imagen no existe ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function uploadImage($dir,$img){
		$target_file = $dir .'\\'. basename($img["name"]);
		chmod($dir,0777);
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
		  echo "<br>YA EXISTE UNA IMAGEN CON ESTE NOMBRE, POR MOTIVOS DE SEGURIDAD NO SE HA SUSTITUIDO. SI NO SON LA MISMA IMAGEN CAMBIA EL NOMBRE DE LA IMAGEN A SUBIR</br>";
		  $uploadOk = 1;
		  
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
			 chmod($target_file,0777);
			 return true;
		  } else {
			  echo "<br>ERROR AL SUBIR ARCHIVO.</br>";
			    return false;
		  }
		}
	
	}
	function insertGaleryDataToFile($file){
	/*
	//	$file = file_get_contents('articulo.html');
		if(isset($_POST['submitInsertArticle'])){
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
		}
		if(isset($_POST['submitUpdateArticle'])){
			$file = str_replace('%TITLE%', $_POST['articleUpdateTitle'],$file);
			if (!empty($_FILES['articleUpdateImg']['name'])) {
				$file = str_replace("%IMAGESRC%",$_FILES ['articleUpdateImg']['name'],$file);
				$file = str_replace('%IMAGEDESC%', $_POST['articleUpdateImageDesc'],$file);
			}else{
				$file = str_replace('<img src="%IMAGESRC%"></img>'," ",$file);
				$file = str_replace('%IMAGEDESC%'," ",$file);
			//	$file = str_replace('<p> %IMAGEDESC%</p>',"",$file);
			}
			$date=date_create($_POST['articleUpdateDate']);
			$file = str_replace('%DATE%',date_format($date,"d/m/Y"),$file);
			$file = str_replace('%TEXT%', $_POST['articleUpdateText'],$file);
			$file = str_replace('%TAG%', ucfirst($_POST['articleUpdateTag']),$file);
			$file = str_replace('%AUTOR%', $_POST['articleUpdateAutor'],$file);
		
		}	*/
		
		
		return $file;
	}
	function createGaleryPage($name,$target_file){
		$html = file_get_contents('E:\\xampp\\htdocs\\trabajo-rivera\\Boletin\\Secciones\\galerytemplate\\galeryTemplate.html',1);
		$pdfHtml = $target_file."\\".$name.'.html';
		$html=insertGaleryDataToFile($html);
		
		// or you have the option to do nothing and assume it is made
		if (file_put_contents($pdfHtml, $html)!==false) {
			echo "<br>Pagina creada e insertada con exito</br>";
			return true;
		} else {
			echo "<br>Fallo al crear la pagina</br>";
			return false;
		}
	}
	function titleToDir($title){
		$articleFileName=strtolower($title);
		$articleFileName=trim($articleFileName," ");
		$articleFileName=trim($articleFileName,'"');
		$articleFileName=str_replace(" ","-",$articleFileName);
		$articleFileName=str_replace ($GLOBALS["ilegalChars"],"",$articleFileName);
		return $articleFileName;
	}
?>