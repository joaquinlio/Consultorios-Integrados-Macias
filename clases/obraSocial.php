<?
	class ObraSocial 
	{
		private $id;
		private $razonsocial;

		public function listarObraSocial(){
			$link = Conexion::conectar();
			$sql= "SELECT * FROM obrasocial";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		private function cargarDatosDesdeForm(){
			if(isset($_POST['id'])){
				$this->setId($_POST['id']);
			}	
			if(isset($_POST['razonsocial'])){
				$this->setRazonsocial($_POST['razonsocial']);
			}
			if(isset($_GET['id'])){
				$this->setId($_GET['id']);
			}
		}
		
		public function agregarObraSocial(){
			$this->cargarDatosDesdeForm();
			$razonSocial=$this->getRazonSocial();
			$link=Conexion::conectar();
			$sql="INSERT INTO obrasocial
								values 
								(NULL, :razonsocial)";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":razonsocial", $razonSocial,PDO::PARAM_STR);
			
			if ($stmt->execute()) {
				$this->setId($link->lastInsertID());
				return true;
				# code...
			}
			return false;
		}
		public function editarObraSocial(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$razonSocial=$this->getRazonSocial();
			$link=Conexion::conectar();
			$sql="UPDATE obrasocial SET razonsocial=:razonsocial WHERE id=:id";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->bindParam(":razonsocial", $razonSocial,PDO::PARAM_STR);
			$stmt->execute();
		}
		public function borrarObraSocial(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$link = Conexion::conectar();
			$sql = "DELETE FROM obrasocial WHERE id=:id";
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
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * @param mixed $razonsocial
     *
     * @return self
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;

        return $this;
    }
}
?>