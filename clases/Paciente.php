<?
	class Paciente
	{

		private $id;
		private $pacNombre;
		private $dni;
		private $telefono;
		private $obrasocial;
		private $email;

		public function listarPacientes(){
			$link = Conexion::conectar();
			$sql= "SELECT pacientes.*,obrasocial.id AS idOB, obrasocial.razonsocial
                    FROM pacientes
                    LEFT JOIN obrasocial ON pacientes.obrasocial = obrasocial.id";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		public function listarPacientesPorDNI(){
			$this->cargarDatosDesdeForm();
			$dni = $this->getDni();
			$link = Conexion::conectar();
			$sql= "SELECT pacientes.*, obrasocial.razonsocial FROM pacientes LEFT JOIN obrasocial ON pacientes.obrasocial = obrasocial.id WHERE dni= ".$dni ;
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
			/*$datos = array();
			foreach ($listado as $key => $value) {
				$datos[] = array('value' =>$value["pacNombre"],'dni' =>$value["dni"]);
			}
			return $datos;*/
			
		}
		private function cargarDatosDesdeForm(){
			if(isset($_POST['id'])){
				$this->setId($_POST['id']);
			}	
			if(isset($_POST['pacNombre'])){
				$this->setPacNombre($_POST['pacNombre']);
			}
			if(isset($_POST['telefono'])){
				$this->setTelefono($_POST['telefono']);
			}
			if(isset($_POST['dni'])){
				$this->setDni($_POST['dni']);
			}
			if(isset($_POST['obrasocial'])){
				$this->setObrasocial($_POST['obrasocial']);
			}
			if(isset($_POST['email'])){
				$this->setEmail($_POST['email']);
			}
		}
		
		public function agregarPaciente(){
			$this->cargarDatosDesdeForm();
			$pacNombre=$this->getPacNombre();
            $telefono=$this->getTelefono();
			$dni=$this->getDni();
            $obrasocial=$this->getObrasocial();
            $email=$this->getEmail();
			$link=Conexion::conectar();
			$sql="INSERT INTO pacientes
								values 
								(NULL, '".$pacNombre."',".$obrasocial.", ".$dni.",".$telefono." , '".$email."')";
			$stmt = $link->prepare($sql);		
			if ($stmt->execute()) {
				$this->setId($link->lastInsertID());
				return true;
				# code...
			}
			return false;
		}
		public function editarPaciente(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$pacNombre=$this->getPacNombre();
            $telefono=$this->getTelefono();
            $dni=$this->getDni();
            $obrasocial=$this->getObrasocial();
            $email=$this->getEmail();
            $link=Conexion::conectar();
			$sql="UPDATE pacientes SET pacNombre='".$pacNombre."', telefono=".$telefono.", dni=".$dni.",obrasocial=".$obrasocial.",email='".$email."' WHERE id =".$id;
			$stmt = $link->prepare($sql);
			$stmt->execute();
		}
		public function borrarPaciente(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$link = Conexion::conectar();
			$sql = "DELETE FROM pacientes WHERE id=:id";
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
    public function getPacNombre()
    {
        return $this->pacNombre;
    }

    /**
     * @param mixed $pacNombre
     *
     * @return self
     */
    public function setPacNombre($pacNombre)
    {
        $this->pacNombre = $pacNombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     *
     * @return self
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $dni
     *
     * @return self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getObrasocial()
    {
        return $this->obrasocial;
    }

    /**
     * @param mixed $obrasocial
     *
     * @return self
     */
    public function setObrasocial($obrasocial)
    {
        $this->obrasocial = $obrasocial;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}

?>