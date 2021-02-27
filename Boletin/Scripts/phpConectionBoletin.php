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
	class Advert implements JsonSerializable {
		private  $id,$image,$text;
		function __construct($id,$image,$text){
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
		function getImage(){
			return $this->image;
		}
	
		function getAdText(){
			return $this->text;
		}
		public function jsonSerialize(){
			
			return 
			json_encode( [
				"id"=>$this->getId(),
				"image"=>$this->getImage(),
				"text"=>$this->getAdText()
			   
			],JSON_UNESCAPED_UNICODE);
		}
	}
	class Article implements JsonSerializable {
		private  $id,$date,$title,$text,$image,$imageDesc,$autor,$tag;
		
		function __construct($id,$articleDate,$title,$text,$image,$imageDesc,$autor,$tag) {
			$this->setId($id);
			$this->setDate($articleDate);
			$this->setTitle($title);
			$this->setText($text);
			$this->setImage($image);
			$this->setImageDesc($image);
			$this->setAutor($autor);
			$this->setTag($tag);
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setDate($articleDate) {
			$this->articleDate = $articleDate;
		}
		public function setTitle($title) {
			$this->title = $title;
		}
		public function setText($text) {
			$this->text = $text;
		}
		public function setImage($image) {
			$this->image = $image;
		}
		public function setImageDesc($imageDesc) {
			$this->imageDesc = $imageDesc;
		}
		public function setAutor($autor) {
			$this->autor = $autor;
		}
		public function setTag($tag) {
			$this->tag = $tag;
		}
		
		function getId(){
			return $this->id;
		}
		function getArticleDate(){
			return $this->articleDate;
		}
		function getTitle(){
			return $this->title;
		}
		function getArticleText(){
			return $this->text;
		}
		function getImage(){
			return $this->image;
		}
		function getImageDesc(){
			return $this->imageDesc;
		}
		function getAutor(){
			return $this->autor;
		}
		function getTag(){
			return $this->tag;
		}
		
		
		
		public function jsonSerialize(){
			
			return 
			json_encode( [
				"id"=>$this->getId(),
				"date"=>$this->getArticleDate(),
				"title"=>$this->getTitle(),
				"text"=>$this->getArticleText(),
				"image"=>$this->getImage(),
				"imageDesc"=>$this->getImageDesc(),
				"autor"=>$this->getAutor(),
				"tag"=>$this->getTag()
			   
			],JSON_UNESCAPED_UNICODE);
		}
	}
	if(!isset($_POST['functionname']) ) {
		
		$aResult['error'] = 'No function name!'; 
	 } 
	else{
		switch($_POST['functionname']) {
			case 'getArticle':
				
				 getArticle($_POST['arguments']);
				
			break;
			case 'getAllArticles':
				
				 getAllArticles();				
			break;
			case 'getAllArticlesByTag':
				
				 getAllArticlesByTag($_POST['arguments']);				
			break;
			case 'getAllAds':
				
				 getAllAds();				
			break;
			
			
		}
	}
	function getArticle($id){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `article` WHERE `id_article`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $id,$date,$title,$text,$image,$imageDesc,$autor,$tag);

						/* fetch values */
						$stmt->fetch();
						$e=new Article($id,$date,$title,$text,$image,$imageDesc,$autor,$tag);
						$data=json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						return json_encode($data,JSON_UNESCAPED_UNICODE);
					/* fetch values */
						
					
					} else {
					//	echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getAllArticles(){
			try{
				if (!$GLOBALS["conn"]) {
						
						die("Connection failed: " . $GLOBALS["conn"]->connect_error);
						echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
					}
					else{
						$sql="SELECT * FROM `article` ORDER BY `article`.`date` DESC";	
						
						if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	

							/* execute statement */
							$stmt->execute();
							/* bind result variables */
							$stmt->bind_result($id,$date,$title,$text,$image,$imageDesc,$autor,$tag);
							$data='{ "items":[';
							while($row=$stmt->fetch()){
								$e=new Article($id,$date,$title,$text,$image,$imageDesc,$autor,$tag);
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
						
							//echo $data;
						} else {
							echo "ERROR LA BASE DE DATOS NO ESTA FUNCIONANDO CORRECTAMENTE";
						}

					}
			}catch(exception $e){
				echo "ERROR:".$e;
			}
	}
	function getAllArticlesByTag($tags){
			try{
				if (!$GLOBALS["conn"]) {
						
						die("Connection failed: " . $GLOBALS["conn"]->connect_error);
						echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
					}
					else{
						$sql="SELECT * FROM `article` WHERE `article`.`tags`=? ORDER BY `article`.`date` DESC";	
						
						if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
							$stmt->bind_param("s",$tags);	
							/* execute statement */
							$stmt->execute();
							/* bind result variables */
							$stmt->bind_result($id,$date,$title,$text,$image,$imageDesc,$autor,$tag);
							$data='{ "items":[';
							while($row=$stmt->fetch()){
								$e=new Article($id,$date,$title,$text,$image,$imageDesc,$autor,$tag);
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
						
							//echo $data;
						} else {
							echo "ERROR LA BASE DE DATOS NO ESTA FUNCIONANDO CORRECTAMENTE";
						}

					}
			}catch(exception $e){
				echo "ERROR:".$e;
			}
	}
	function getAllAds(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `advert`";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						
						
						/* fetch values */
						$stmt->bind_result($id,$image,$text);
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Advert($id,$image,$text);
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
						echo "ERROR LA BASE DE DATOS NO ESTA FUNCIONANDO CORRECTAMENTE";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	
	function titleToDir($title){
		$articleFileName=strtolower($title);
		$articleFileName=trim($articleFileName," ");
		$articleFileName=trim($articleFileName,'"');
		$articleFileName=trim($articleFileName,'\n');
		$articleFileName=trim($articleFileName,'\r');
		$articleFileName=str_replace(" ","-",$articleFileName);
		$articleFileName=str_replace ($GLOBALS["ilegalChars"],"",$articleFileName);
		return $articleFileName;
	}
?>