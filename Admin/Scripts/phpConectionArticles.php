<?php
	//params
	$host="localhost";
	$bd="riveradb";//id13819712_db for hosting
	$user="root";
	$pasword="";
	$fatherDir="";
	$articlesFatherDir="E:\\xampp\\htdocs\\trabajo-rivera\\Boletin\\Secciones\\";
	$currentArticle=-1;
	
	$ilegalChars = array(
		"#","%","&","{","}","\\","<",">","*","?","/","+","`","|","=","$","!","¿","¡","'",'"',":","@"
	);
	$ilegalWords = array(
		"select","delete","where","all","and","any","between","exists"
	);
	
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
	if(!isset($_COOKIE["CurrentArticle"])) {
	 // echo "seleccione un pueblo para editar";
	} else {
	  
		$GLOBALS["currentArticle"]= $_COOKIE["CurrentArticle"];
	}
	
	
	if(isset($_POST['submitInsertArticle'])){
	
		insertArticle();
	}
	if(isset($_POST['submitUpdateArticle'])){
		
		updateArticle();
	
	}	
	
		
	
	if( !isset($_POST['functionname']) ) { 
		$aResult['error'] = 'No function name!'; 
	 } 
	else{
		switch($_POST['functionname']) {
			case 'getArticle':
				
				 getArticle($_POST['arguments']);
				
			break;
			case 'insertArticle':
			
				 insertArticle();
				
			break;
			case 'updateArticle':
			
				 updateArticle();
				
			break;
			case 'getAllArticles':
				
				 getAllArticles();				
			break;
			
			case 'setCurrentArticle':
				
				 setCurrentArticle($_POST['arguments']);			
			break;
			case 'deleteArticle':
								
				 deleteArticle($_POST['arguments'][0],$_POST['arguments'][1],$_POST['arguments'][2]);				
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
	
	/*ARTICLES*/
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
	function getArticleForUpdate(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `article` WHERE `id_article`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$GLOBALS["currentArticle"]);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $id,$date,$title,$text,$image,$imageDesc,$autor,$tag);

						/* fetch values */
						$stmt->fetch();
						echo "<br>title".$title;
						echo "<br>tag".$tag;
						echo "<br>id".$GLOBALS["currentArticle"];
						echo "<br>text".$tag;
						$data = array("tag"=>$tag, "title"=>$title);
					
						return $data;
					/* fetch values */
						
					
					} else {
					//	echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getArticleDir($id){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT `title`,`tag` FROM `article` WHERE `id_article`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result($title,$tag);

						/* fetch values */
						$stmt->fetch();
						$dir=$GLOBALS["articlesFatherDir"];
						$fulldir=$title."%%".$dir. ucfirst($tag)."\\".titleToDir($title);
						return $fulldir;
					/* fetch values */
						
					
					} else {
						//echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
					}

				}
		}catch(exception $e){
			echo "ERROR:".$e;
		}
	}
	function getArticleTitle(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT `title` FROM `article` WHERE `id_article`=?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $title);

						/* fetch values */
						$stmt->fetch();
						return $title;
					/* fetch values */
						
					
					} else {
						//echo "ERROR DATABASE NOT RESPONDING, CONTACT AN ADMIN ";
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
					$articleFileName=titleToDir($_POST['articleTitle']);
					$dir=$GLOBALS["articlesFatherDir"];
					$fulldir=$dir. ucfirst($_POST['articleTag'])."\\".$articleFileName;
					echo $fulldir;
					
					
					$name="";
					$imgDesc="";
					
					if(!empty($_POST['articleImg'])){
						$name = $_FILES ['articleImg']['name'];
					}else{
						$name=null;
					}
					if(isset($_POST['articleImageDesc'])){
						$imgDesc=$_POST['articleImageDesc'];
					}else{
						$imgDesc=null;
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
						
						$stmt->bind_param("sssssss",$_POST['articleDate'],$_POST['articleTitle'],$_POST['articleText'],$name,$imgDesc,$_POST['articleAutor'],$_POST['articleTag']);	
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
	function updateArticle(){
		$allOK=true;
		if(empty($_POST['articleUpdateTitle']) || empty($_POST['articleUpdateAutor']) || empty($_POST['articleUpdateDate']) ||
			empty($_POST['articleUpdateTag']) || empty($_POST['articleUpdateText'])){
			echo "rellena todos los campos obligatorios ";
		}else{
			try{
				
				if (!$GLOBALS["conn"]) {
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					
				}else{
					$oldArticle=getArticleForUpdate($GLOBALS["currentArticle"]);
					deleteArticle($GLOBALS["currentArticle"],$oldArticle["tag"],$oldArticle["title"]);
					echo "<br>title: ".$oldArticle["title"];
					echo "<br>tag: ".$oldArticle["tag"];
					$articleFileName=strtolower($_POST['articleUpdateTitle']);
					$articleFileName=trim($articleFileName," ");
					$articleFileName=trim($articleFileName,'"');
					$articleFileName=str_replace(" ","-",$articleFileName);
					$articleFileName=str_replace ($GLOBALS["ilegalChars"],"",$articleFileName); 
					
					
					$dir="E:\\xampp\\htdocs\\trabajo-rivera\\Boletin\\Secciones\\";
					$fulldir=$dir. ucfirst($_POST['articleUpdateTag'])."\\".$articleFileName;
					echo $fulldir;
					
					
					$name="";
					$imgDesc="";
					
					if(!empty($_POST['articleUpdateImg'])){
						$name = $_FILES ['articleUpdateImg']['name'];
					}else{
						$name=null;
					}
					if(isset($_POST['articleUpdateImageDesc'])){
						$imgDesc=$_POST['articleUpdateImageDesc'];
					}else{
						$imgDesc=null;
					}
					$name = $_FILES ['articleUpdateImg']['name'];
					if (!file_exists($fulldir)) {
						mkdir($fulldir, 0777);
						if(!$name==null){
							if(!uploadImage($fulldir,$_FILES ['articleUpdateImg'])){
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
					
					$sql="INSERT INTO `article`(`date`,`title`,`text`,`image_src`,`image_desc`,`editor_name`,`tags`) VALUE (?,?,?,?,?,?,?);";	
					//$stmt = $GLOBALS["conn"]->prepare($sql);		
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("sssssss",$_POST['articleUpdateDate'],$_POST['articleUpdateTitle'],$_POST['articleUpdateText'],$name,$imgDesc,$_POST['articleUpdateAutor'],$_POST['articleUpdateTag']);	
						/* execute statement */
						$stmt->execute();
						echo "articulo editado";
						
						
					} else {
						
						echo "error"."connection failure";
					}
				
							

				}
			}catch(exception $e){
				echo "error"." ".$e;
			}
		}
	}
	function getAllArticles(){
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="SELECT * FROM `article`";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
						$stmt->bind_result( $id,$date,$title,$text,$image,$imageDesc,$autor,$tag);

						/* fetch values */
						$data='{ "items":[';
						while($row=$stmt->fetch()){
							$e=new Article($id,$date,$title,$text,$image,$imageDesc,$autor,$tag);
							
							$data=$data.json_decode(json_encode($e->jsonSerialize(),JSON_UNESCAPED_UNICODE)).",";
						}
						$data = rtrim($data, ",");
						$data=$data."]}";	
						echo json_encode($data,JSON_UNESCAPED_UNICODE);
						//echo $data;
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
		
		}	
		
		
		return $file;
	}
	function deleteArticle($id,$tag,$title){
		$dir=titleToDir($title);
		echo "<br> dir:".$dir;
		$fulldir= $GLOBALS["articlesFatherDir"]. ucfirst($tag)."\\".$dir;
		if (file_exists($fulldir) ){
			echo "<br> full:".$fulldir;
			rrmdir($fulldir);
		}
		try{
			if (!$GLOBALS["conn"]) {
					
					die("Connection failed: " . $GLOBALS["conn"]->connect_error);
					echo "Connection failed: " . $GLOBALS["conn"]->connect_error;
				}
				else{
					$sql="DELETE FROM `article` WHERE `article`.`id_article` = ?";	
					
					if ($stmt =  $GLOBALS["conn"]->prepare($sql)) {
						$stmt->bind_param("i",$id);	
						/* execute statement */
						$stmt->execute();
						/* bind result variables */
							
						echo "<br>Los datos del articulo han sido borrados</br>";
					
					} else {
						echo "ERROR el articulo no existe ";
					}

				}
		}catch(exception $e){
			//echo "ERROR:".$e;
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
	/*multy use*/
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