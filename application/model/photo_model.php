<?php

	Class photoModel {
		public function getAllPhotos()
	    {
	        $sql = "SELECT id, file, longitude, latitude, author FROM photo";
	        $query = $this->db->prepare($sql);
	        $query->execute();

	        return $query->fetchAll();
	    }

		function upload(){
			$target_file = UPLOAD_PATH . basename($_FILES["fileToUpload"]["name"]);

			$uploadError = NULL;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
    			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			    	//$_SESSION["feedback_negative"][] = "File is not an image";
			        $uploadError .=  "File is not an image.<br>";
			        $uploadOk = 0;
			    }
			}

			/*
				if (!$this->getLonLat()){
					//File doesn't have lon/lat included in the hearders.
					return false;
				}
			*/

			$data = exif_read_data($_FILES["fileToUpload"]["tmp_name"]);

			if (isset($data["GPSLatitude"])){
				$latitude = $this->gps($data["GPSLatitude"], $data['GPSLatitudeRef']);
				$longitude = $this->gps($data["GPSLongitude"], $data['GPSLongitudeRef']);
			}
			else{
				$uploadError .=  "File has no GPS location.<br>";
			    $uploadOk = 0;
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			    $uploadError .=  "Sorry, file already exists.<br>";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 50000000) {
			    $uploadError .=  "Sorry, your file is too large.<br>";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    $uploadError .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    $uploadError .=  "Sorry, your file was not uploaded.<br>";
			    return $uploadError;
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			    	$this->addPhoto(basename( $_FILES["fileToUpload"]["name"]), $longitude, $latitude, 0);
			        return "The file ". basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded.";
			    } else {
			        return "Sorry, there was an error uploading your file.<br>";
			    }
			}
		}

		private function addPhoto($file, $longitude, $latitude, $author)
	    {
	        $sql = "INSERT INTO photo (file, longitude, latitude, author) VALUES (:file, :longitude, :latitude, :author)";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':file' => $file, ':longitude' => $longitude, ':latitude' => $latitude, ':author' => $author);

	        $query->execute($parameters);
	    }


		private function gps($coordinate, $hemisphere) {
		  for ($i = 0; $i < 3; $i++) {
		    $part = explode('/', $coordinate[$i]);
		    if (count($part) == 1) {
		      $coordinate[$i] = $part[0];
		    } else if (count($part) == 2) {
		      $coordinate[$i] = floatval($part[0])/floatval($part[1]);
		    } else {
		      $coordinate[$i] = 0;
		    }
		  }
		  list($degrees, $minutes, $seconds) = $coordinate;
		  $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
		  return $sign * ($degrees + $minutes/60 + $seconds/3600);
		}
	}


	

?>