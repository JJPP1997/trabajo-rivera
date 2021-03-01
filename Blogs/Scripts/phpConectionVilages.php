<?php
	//params
	$host="localhost";
	$bd="riveradb";//id13819712_db for hosting
	$user="root";
	$pasword="";
	$fatherDir="";
	$articlesFatherDir="E:\\xampp\\htdocs\\trabajo-rivera\\Boletin\\Secciones\\";
	$ilegalChars = array(
		"#","%","&","{","}","\\","<",">","*","?","/","+","`","|","=","$","!","¿","¡","'",'"',":","@"
	);
	$ilegalWords = array(
		"select","delete","where","all","and","any","between","exists"
	);
	try{
		$conn=mysqli_connect($host,$user,$pasword,$bd);
		//echo $conn;
		
	}catch(exception $e){
		$myfile = fopen("debug.txt", "w") ;
		
	}
	
	class Bussines implements JsonSerializable {
		private  $id,$title,$telf,$desc,$addres,$image,$type;
		function __construct($id,$title,$telf,$desc,$addres,$image,$type) {
			$this->setId($id);
			$this->setTitle($title);
			$this->setTelf($telf);
			$this->setDesc($desc);
			$this->setAddres($addres);
			$this->setImage($image);
			$this->setBType($type);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		public function setTelf($telf) {
			$this->telf = $telf;
		}
		public function setDesc($desc) {
			$this->desc = $desc;
		}
		public function setAddres($addres) {
			$this->addres = $addres;
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
		function getTelf(){
			return $this->telf;
		}
		function getDesc(){
			return $this->desc;
		}
		function getAddres(){
			return $this->addres;
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
				"telf"=>$this->getTelf(),
				"desc"=>$this->getDesc(),
				"addres"=>$this->getAddres(),
				"type"=>$this->getBType()
			
			   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
	class AgendaEntry implements JsonSerializable {
		private  $id,$Adate,$title,$image,$text;
		function __construct($id,$Adate,$title,$image,$text) {
			$this->setId($id);
			$this->setTitle($title);
			$this->setImage($image);
			$this->setText($text);
			$this->setADate($Adate);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		public function setText($text) {
			$this->text = $text;
		}
		public function setADate($Adate) {
			$this->Adate = $Adate;
		}
		function getId(){
			return $this->id;
		}
		function getADate(){
			return $this->Adate;
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
		function getAText(){
			return $this->text;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"title"=>$this->getTitle(),
				"text"=>$this->getAText(),
				"date"=>$this->getADate(),
				"image"=>$this->getImage()				
			   
			],JSON_UNESCAPED_UNICODE);
		}
		
	}
	class CarrouselImage implements JsonSerializable {
		private  $id,$text,$image;
		function __construct($id,$text,$image) {
			$this->setId($id);
			$this->setImage($image);
			$this->setText($text);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setImage($image) {
			$this->image = $image;
		}
		public function setText($text) {
			$this->text = $text;
		}
		function getId(){
			return $this->id;
		}
		function getCIText(){
			return $this->text;
		}
		function getImage(){
			return $this->image;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"image"=>$this->getImage(),
				"text"=>$this->getCIText(),
			   
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
		private $id,$blogId,$title,$date,$thumbnail;
		function __construct($id,$blogId,$title,$Gdate,$thumbnail) {
			$this->setId($id);
			$this->setBlogId($blogId);
			$this->setTitle($title);
			$this->setGDate($Gdate);
			$this->setTumbnail($thumbnail);
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
		public function setTumbnail($thumbnail) {
			$this->thumbnail = $thumbnail;
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
		function getThumbnail(){
			return $this->thumbnail;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"title"=>$this->getTitle(),
				"thumbnail"=>$this->getThumbnail(),
				"date"=>$this->getGDate()
			],JSON_UNESCAPED_UNICODE);
		}
	}
	class POI implements JsonSerializable {
	private $id,$blogId,$text,$image;
		function __construct($id,$blogId,$text,$image) {
			$this->setId($id);
			$this->setBlogId($blogId);
			$this->setText($text);
			$this->setImage($image);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setBlogId($blogId) {
			$this->blogId = $blogId;
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
		function getBlogId(){
			return $this->blogId;
		}
		function getTxt(){
			return $this->text;
		}
		function getImage(){
			return $this->image;
		}
		public function jsonSerialize(){
			return 
			json_encode( [
				"id"=>$this->getId(),
				"image"=>$this->getImage(),
				"text"=>$this->getTxt()
				   
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
				"image"=>$this->getImage(),
				"text"=>$this->getImageText()
				   
			],JSON_UNESCAPED_UNICODE);
		}
	}
	
	if(!isset($_POST['functionname']) ) {
		
		$aResult['error'] = 'No function name!'; 
	 } 
	else{
		switch($_POST['functionname']) {
			
			case 'getAllImagesFromGalery':
				
				  getAllImagesFromGalery($_POST['arguments']);				
			break;
			case 'getAllCarrouselImages':
				
				 getAllCarrouselImages($_POST['arguments']);				
			break;
			case 'getAllBussines':
				
				  getAllBussines($_POST['arguments']);				
			break;
			case 'getAllPOI':
				
				  getAllPOI($_POST['arguments']);				
			break;
			case 'getAllAgendas':
				
				  getAllAgendas($_POST['arguments']);				
			break;
			case 'getBlog':
				
				  getBlog($_POST['arguments']);			
			break;
			case 'getAllBussinesByType':
				
				  getAllBussinesByType($_POST['arguments'][0],$_POST['arguments'][1]);			
			break;
			case 'getAllGaleries':
				
				 getAllGaleries($_POST['arguments']);				
			break;
			
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
	
	function getAllGaleries($idBlog){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$galeryId;
					$sql="SELECT * FROM `blog_galery` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$idBlog);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_blog,$itle,$date,$thumbnail);
					
						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
				
							$e=new Galery($id,$id_blog,$itle,$date,$thumbnail);
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
	
	function getAllPOI($idBlog){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `interest_place` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$idBlog);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_blog,$text,$image);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new POI($id,$id_blog,$text,$image);
							
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
	function getAllImagesFromGalery($idGalery){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `galery_image` WHERE `id_galery`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$idGalery);	
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
	function getAllCarrouselImages($idBlog){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `blog_title_image` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$idBlog);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_blog,$text,$src);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new CarrouselImage($id,$text,$src);
							
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
	function getAllBussines($idBlog){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `business` WHERE `business`.`id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$idBlog);	
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
	
	function getAllBussinesByType($idBlog,$type){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `business` WHERE `business`.`id_blog`=? AND `business`.`type`=?" ;	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("is",$idBlog,$type);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$name,$telf,$desc,$src,$type,$address,$id_blog);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
						
							$e=new Bussines($id,$name,$telf,$desc,$address,$src,$type);
							
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
	function getAllAgendas($idBlog){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `anouncement` WHERE `id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$idBlog);	
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($id,$id_blog,$title,$date,$text,$src);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new AgendaEntry($id,$date,$title,$src,$text);
							
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
	function getBlog($idBlog){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `blog` WHERE `blog`.`id_blog`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->bind_param("i",$idBlog);	
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
?>