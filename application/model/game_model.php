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

		function getLonLat ($id){
			
		}

		function checkLocation(){
			
		}
	}

?>