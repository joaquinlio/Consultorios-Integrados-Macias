<?php 
	class Medico
	{

		private $id;
		private $medNombre;
		private $especialidad;
		private $intervalo;
		private $evento;

		public function listarMedicos(){
			$link = Conexion::conectar();
			$sql= "SELECT medicos.*, especialidad.titulo FROM medicos LEFT JOIN especialidad ON medicos.especialidad = especialidad.id ORDER BY medNombre";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		public function listarMedicosPorDia($strFecha){
			$link = Conexion::conectar();
			$sql= "SELECT medicos_reservas.*, medicos.*, especialidad.titulo,especialidad.id AS espID FROM medicos_reservas LEFT JOIN medicos ON medicos_reservas.medico=medicos.id LEFT JOIN especialidad ON medicos.especialidad = especialidad.id  WHERE DATE_FORMAT('".$strFecha."','%w')=diasemana AND horadesde != 0";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		public function listarMedicosPorNombre($query){
			
			$link = Conexion::conectar();
			$sql= "SELECT * FROM medicos WHERE medNombre LIKE '%".$query."%'";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		public function listarMedicosParaCons($query,$diasemana){
			$link = Conexion::conectar();
			$sql= "SELECT medicos.*, medicos_reservas.horadesde,medicos_reservas.horahasta FROM medicos LEFT JOIN medicos_reservas ON medicos_reservas.medico=medicos.id WHERE medNombre LIKE '%".$query."%' AND diasemana =".$diasemana;
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		public function listarMedicosPorID($strFecha,$medico){
			$this->cargarDatosDesdeForm();
			$id=$this->getId();
			$link = Conexion::conectar();
			$sql= "SELECT medicos_reservas.*, medicos.*, especialidad.titulo FROM medicos_reservas LEFT JOIN medicos ON medicos_reservas.medico=medicos.id LEFT JOIN especialidad ON medicos.especialidad = especialidad.id  WHERE DATE_FORMAT('".$strFecha."','%w')=diasemana AND medico = ".$medico." AND horadesde != 0";
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
			if(isset($_POST['medNombre'])){
				$this->setmedNombre($_POST['medNombre']);
			}
			if(isset($_POST['especialidad'])){
				$this->setEspecialidad($_POST['especialidad']);
			}
			if(isset($_POST['intervalo'])){
				$this->setIntervalo($_POST['intervalo']);
			}
			if(isset($_POST['evento'])){
				$this->setEvento($_POST['evento']);
			}
		}
		
		public function agregarMedico(){
			$this->cargarDatosDesdeForm();
			$medNombre=$this->getMedNombre();
			$especialidad=$this->getEspecialidad();
			$intervalo=$this->getIntervalo();
			$evento=$this->getEvento();
			$link=Conexion::conectar();
			$sql="INSERT INTO medicos (medNombre,especialidad,intervalo,evento)
								values 
								(:medNombre, :especialidad , :intervalo,'".$evento."')";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":medNombre", $medNombre,PDO::PARAM_STR);
			$stmt->bindParam(":especialidad", $especialidad,PDO::PARAM_STR);
			$stmt->bindParam(":intervalo", $intervalo,PDO::PARAM_STR);
			
			if ($stmt->execute()) {
				$this->setId($link->lastInsertID());
				return true;
				# code...
			}
			return false;
		}
		public function editarMedico(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$medNombre=$this->getMedNombre();
			$especialidad=$this->getEspecialidad();
			$intervalo=$this->getIntervalo();
			$evento=$this->getEvento();
			$link=Conexion::conectar();
			$sql="UPDATE medicos SET medNombre=:medNombre, especialidad = :especialidad, intervalo = :intervalo, evento = CONCAT(evento,'".$evento."') WHERE id=:id";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->bindParam(":medNombre", $medNombre,PDO::PARAM_STR);
			$stmt->bindParam(":especialidad", $especialidad,PDO::PARAM_STR);
			$stmt->bindParam(":intervalo", $intervalo,PDO::PARAM_STR);
			$stmt->execute();
		}
		public function borrarMedico(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$link = Conexion::conectar();
			$sql = "DELETE FROM medicos WHERE id=:id";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->execute();
		}
		public function borrarEventos(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$link=Conexion::conectar();
			$sql="UPDATE medicos SET evento = NUll WHERE id=:id";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->execute();
		}
		
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMedNombre()
    {
        return $this->medNombre;
    }

    /**
     * @param mixed $medNombre
     *
     * @return self
     */
    public function setmedNombre($medNombre)
    {
        $this->medNombre = $medNombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * @param mixed $especialidad
     *
     * @return self
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntervalo()
    {
        return $this->intervalo;
    }

    /**
     * @param mixed $intervalo
     *
     * @return self
     */
    public function setIntervalo($intervalo)
    {
        $this->intervalo = $intervalo;

        return $this;
    }

		/**
		 * Get the value of evento
		 */ 
		public function getEvento()
		{
				return $this->evento;
		}

		/**
		 * Set the value of evento
		 *
		 * @return  self
		 */ 
		public function setEvento($evento)
		{
				$this->evento = $evento;

				return $this;
		}
}