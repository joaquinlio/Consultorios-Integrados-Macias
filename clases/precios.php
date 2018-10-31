<? 
	class Precios 
	{
		private $idPrecio;
		private $medico;
		private $obrasocial;
		private $monto;

		public function listarPrecios($obrasocial){
			$link = Conexion::conectar();
			$sql= "SELECT precios.*, medicos.medNombre,medicos.id, obrasocial.razonsocial,obrasocial.id AS obID FROM precios LEFT JOIN medicos ON precios.medico = medicos.id LEFT JOIN obrasocial ON precios.obrasocial = obrasocial.id WHERE obrasocial =".$obrasocial." ORDER BY medNombre";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		private function cargarDatosDesdeForm(){
			if(isset($_POST['medico'])){
				$this->setMedico($_POST['medico']);
			}	
			if(isset($_POST['obrasocial'])){
				$this->setObrasocial($_POST['obrasocial']);
			}
			if(isset($_POST['monto'])){
				$this->setMonto($_POST['monto']);
			}
			if(isset($_POST['idPrecio'])){
				$this->setIdPrecio($_POST['idPrecio']);
			}
		}
		
		public function agregarPrecios(){
			$this->cargarDatosDesdeForm();
			$medico=$this->getMedico();
			$obrasocial=$this->getObrasocial();
			$monto=$this->getMonto();
			$link=Conexion::conectar();
			$sql="INSERT INTO precios
								values 
								(NULL,:medico, :obrasocial , :monto)";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":obrasocial", $obrasocial,PDO::PARAM_STR);
			$stmt->bindParam(":medico", $medico,PDO::PARAM_STR);
			$stmt->bindParam(":monto", $monto,PDO::PARAM_STR);
			$stmt->execute(); 
		}
		public function editarPrecios(){
			$this->cargarDatosDesdeForm();
			$idPrecio=$this->getIdPrecio();
			$medico=$this->getMedico();
			$obrasocial=$this->getObrasocial();
			$monto=$this->getMonto();
			$link=Conexion::conectar();
			$sql="UPDATE precios SET medico=".$medico.", obrasocial=".$obrasocial.", monto=".$monto." WHERE idPrecio =".$idPrecio;
			$stmt = $link->prepare($sql);
			$stmt->execute();
		}
		public function borrarPrecios(){
			$this->cargarDatosDesdeForm();
			$idPrecio=$this->getIdPrecio();
			$link = Conexion::conectar();
			$sql = "DELETE FROM precios WHERE idPrecio =".$idPrecio;
			$stmt = $link->prepare($sql);
			$stmt->execute();

		}
	
    /**
     * @return mixed
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * @param mixed $medico
     *
     * @return self
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;

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
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * @param mixed $monto
     *
     * @return self
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPrecio()
    {
        return $this->idPrecio;
    }

    /**
     * @param mixed $idPrecio
     *
     * @return self
     */
    public function setIdPrecio($idPrecio)
    {
        $this->idPrecio = $idPrecio;

        return $this;
    }
}
?>