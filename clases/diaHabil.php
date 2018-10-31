<?
	class diaHabil
	{
		private $medico;
		private $diasemana;
        private $diaedit;
		private $horadesde;
        private $horahasta;
        private $consultorio;

		public function listarDiasHabilesPorMedico($medico){
			$link = Conexion::conectar();
			$sql= "SELECT medicos_reservas.* FROM medicos_reservas LEFT JOIN medicos ON medicos_reservas.medico=medicos.id WHERE medico =".$medico;
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		public function cargarDatosDesdeForm(){
			if(isset($_POST['medico'])){
				$this->setMedico($_POST['medico']);
			}	
			if(isset($_POST['diasemana'])){
				$this->setDiasemana($_POST['diasemana']);
			}
            if(isset($_POST['diaedit'])){
                $this->setDiaedit($_POST['diaedit']);
            }
			if(isset($_POST['horadesde'])){
				$this->setHoradesde($_POST['horadesde']);
			}
			if(isset($_POST['horahasta'])){
				$this->setHorahasta($_POST['horahasta']);
            }
            if(isset($_POST['consultorio'])){
				$this->setConsultorio($_POST['consultorio']);
			}
		}
        public function agregarDiaHabil(){
            $this->cargarDatosDesdeForm();
            $medico=$this->getMedico();
            $diasemana=$this->getDiasemana();
            $horadesde = $this->getHoradesde();
            $horahasta = $this->getHorahasta();
            $link=Conexion::conectar();
            $sql="INSERT INTO medicos_reservas
                                values 
                                (:medico, :diasemana, :horadesde, :horahasta )";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(":medico", $medico,PDO::PARAM_STR);
            $stmt->bindParam(":diasemana", $diasemana,PDO::PARAM_STR);
            $stmt->bindParam(":horadesde", $horadesde,PDO::PARAM_STR);
            $stmt->bindParam(":horahasta", $horahasta,PDO::PARAM_STR);
            $stmt->execute();           
        }
        public function editarDiaHabil(){
            $this->cargarDatosDesdeForm();
            $medico=$this->getMedico();
            $diasemana=$this->getDiasemana();
            $diaedit=$this->getDiaedit();
            $horadesde = $this->getHoradesde();
            $horahasta = $this->getHorahasta();
            $link=Conexion::conectar();
            $sql="UPDATE medicos_reservas SET horadesde=".$horadesde.", horahasta=".$horahasta." WHERE medico=".$medico." AND diasemana=".$diasemana;
            $stmt = $link->prepare($sql);
            $stmt->execute();
        }
        public function bajaDiaHabil(){
            $this->cargarDatosDesdeForm();
            $medico=$this->getMedico();
            $diaedit=$this->getDiaedit();
            $link=Conexion::conectar();
            $sql="DELETE FROM medicos_reservas WHERE medico=:medico AND diasemana=:diaedit";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(":medico", $medico,PDO::PARAM_STR);
            $stmt->bindParam(":diaedit", $diaedit,PDO::PARAM_STR);
            $stmt->execute();
        }
        public function editarConsultorio(){
            $this->cargarDatosDesdeForm();
            $medico=$this->getMedico();
            $consultorio=$this->getConsultorio();
            $diasemana=$this->getDiasemana();
            $link=Conexion::conectar();
            $sql="UPDATE medicos_reservas SET consultorio = ".$consultorio." WHERE medico=".$medico." AND diasemana=".$diasemana;
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
    public function getDiasemana()
    {
        return $this->diasemana;
    }

    /**
     * @param mixed $diasemana
     *
     * @return self
     */
    public function setDiasemana($diasemana)
    {
        $this->diasemana = $diasemana;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoradesde()
    {
        return $this->horadesde;
    }

    /**
     * @param mixed $horadesde
     *
     * @return self
     */
    public function setHoradesde($horadesde)
    {
        $this->horadesde = $horadesde;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHorahasta()
    {
        return $this->horahasta;
    }

    /**
     * @param mixed $horahasta
     *
     * @return self
     */
    public function setHorahasta($horahasta)
    {
        $this->horahasta = $horahasta;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiaedit()
    {
        return $this->diaedit;
    }

    /**
     * @param mixed $diaedit
     *
     * @return self
     */
    public function setDiaedit($diaedit)
    {
        $this->diaedit = $diaedit;

        return $this;
    }

        /**
         * Get the value of consultorio
         */ 
        public function getConsultorio()
        {
                return $this->consultorio;
        }

        /**
         * Set the value of consultorio
         *
         * @return  self
         */ 
        public function setConsultorio($consultorio)
        {
                $this->consultorio = $consultorio;

                return $this;
        }
}