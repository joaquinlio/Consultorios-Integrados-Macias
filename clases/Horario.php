<?php 
	class Horario
	{

		private $id;
		private $horario;

		public function listarHorarios(){
			$link = Conexion::conectar();
			$sql= "SELECT id,hora FROM horarios";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		public function listarHorariosPorMed(){
			$this->cargarDatosDesdeForm();
			$id=$this->getId();
			$link = Conexion::conectar();
			$sql= "SELECT id,hora FROM horarios WHERE id=:id";
			$stmt= $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		private function cargarDatosDesdeForm(){
			if(isset($_POST['id'])){
				$this->setId($_POST['id']);
			}	
			if(isset($_POST['horario'])){
				$this->sethorario($_POST['horario']);
			}
			if(isset($_GET['id'])){
				$this->setId($_GET['id']);
			}
		}
		
		public function agregarHorarios(){
			$this->cargarDatosDesdeForm();
			$horario=$this->getHorario();
			$link=Conexion::conectar();
			$sql="INSERT INTO horarios
								values 
								(NULL, :horario)";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":horario", $horario,PDO::PARAM_STR);
			
			if ($stmt->execute()) {
				$this->setId($link->lastInsertID());
				return true;
				# code...
			}
			return false;
		}
		public function editarHorarios(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$horario=$this->getHorario();
			$link=Conexion::conectar();
			$sql="UPDATE Horarios SET horario=:horario WHERE id=:id";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->bindParam(":horario", $horario,PDO::PARAM_STR);
			$stmt->execute();
		}
		public function borrarHorarios(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$link = Conexion::conectar();
			$sql = "DELETE FROM horarios WHERE id=:id";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->execute();
		}
	}