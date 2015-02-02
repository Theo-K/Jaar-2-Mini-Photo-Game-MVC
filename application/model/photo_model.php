<?php

	Class photoModel {
		public function getAllPhotos() {
	        $sql = "SELECT id, file, longitude, latitude, author FROM photo";
	        $query = $this->db->prepare($sql);
	        $query->execute();

	        return $query->fetchAll();
	    }

		public function upload(){
			$target_file = UPLOAD_PATH . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			// Check if image file is a actual image or fake image

			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
					$_SESSION['feedback_negative'] [] = FEEDBACK_NOT_AN_IMAGE;
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
				$_SESSION['feedback_negative'] [] = FEEDBACK_NO_GPS_LOCATION;
			    $uploadOk = 0;
			}

			// Check if file already exists
			if (file_exists($target_file)) {
				$_SESSION['feedback_negative'] [] = FEEDBACK_FILE_ALREADY_EXISTS;
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 50000000) {
				$_SESSION['feedback_negative'] [] = FEEDBACK_FILE_TOO_LARGE;
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$_SESSION['feedback_negative'] [] = FEEDBACK_FILE_NOT_VALID;
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$_SESSION['feedback_negative'] [] = FEEDBACK_FILE_NOT_UPLOADED;
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			    	$this->addPhoto(basename( $_FILES["fileToUpload"]["name"]), $longitude, $latitude, 0);
			    	$_SESSION['feedback_positive'] [] = FEEDBACK_FILE_HAS_BEEN_UPLOADED;
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded.";
			    } else {
			    	$_SESSION['feedback_negative'] [] = FEEDBACK_ERROR_UPLOADING_FILE;
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