<?php

	Class gameModel {

		public function getPhoto($id){
			$sql = "SELECT * 
					FROM photo
					WHERE id = :id";
			$query = $this->db->prepare($sql);
			$parameters = array(':id' => $id);
	        $query->execute($parameters);

	        return $query->fetch();
		}

		public function getRandomPhoto(){
			$sql = "SELECT * 
					FROM photo
					ORDER BY RAND()
					LIMIT 1";
			$query = $this->db->prepare($sql);
	        $query->execute();

	        return $query->fetch();	
		}

		public function checkLocation($id){
			$sql = "SELECT latitude, longitude 
					FROM photo
					WHERE id = :id";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':id' => $id);
	        $query->execute($parameters);

	        return $query->fetch();
		}

		public function insertScore($id, $score, $user_id)
	    {
	    	$distance_meter = round($score,0);

	        $sql = "INSERT INTO scores (photo_id, score, user_id) VALUES (:photo_id, :score, :user_id)";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':photo_id' => $id, ':score' => $score, ':user_id' => $user_id);

	        // useful for debugging: you can see the SQL behind above construction by using:
	        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

	        $query->execute($parameters);
	    }

	    public function getScores($id){
	    	$sql = "SELECT *
					FROM scores
					INNER JOIN users
					ON scores.user_id = users.user_id
					WHERE scores.photo_id = :id
					ORDER BY score";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':id' => $id);
	        $query->execute($parameters);

        	return $query->fetchAll();
		}

		public function getYourScore($photo_id, $user_id){
			$sql = "SELECT *
					FROM scores
					WHERE photo_id = :photo_id and user_id = :user_id
					";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':photo_id' => $photo_id, ':user_id' => $user_id);
	        $query->execute($parameters);

        	return $query->fetch();
		}
	}

?>