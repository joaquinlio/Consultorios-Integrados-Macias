<?
	class Especialidad
	{

		private $id;
		private $titulo;
		

		public function listarEspecialidad(){
			$link = Conexion::conectar();
			$sql= "SELECT id,titulo FROM especialidad ORDER BY titulo";
			$stmt= $link->prepare($sql);
			$stmt->execute();
			$listado=$stmt->fetchAll();
			return $listado;
		}
		private function cargarDatosDesdeForm(){
			if(isset($_POST['id'])){
				$this->setId($_POST['id']);
			}	
			if(isset($_POST['titulo'])){
				$this->settitulo($_POST['titulo']);
			}
			if(isset($_GET['id'])){
				$this->setId($_GET['id']);
			}
		}
		
		public function agregarEspecialidad(){
			$this->cargarDatosDesdeForm();
			$titulo=$this->getTitulo();
			$link=Conexion::conectar();
			$sql="INSERT INTO especialidad
								values 
								(NULL, :titulo)";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":titulo", $titulo,PDO::PARAM_STR);
			
			if ($stmt->execute()) {
				$this->setId($link->lastInsertID());
				return true;
				# code...
			}
			return false;
		}
		public function editarEspecialidad(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$titulo=$this->getTitulo();
			$link=Conexion::conectar();
			$sql="UPDATE especialidad SET titulo=:titulo WHERE id=:id";
			$stmt = $link->prepare($sql);
			$stmt->bindParam(":id", $id,PDO::PARAM_STR);
			$stmt->bindParam(":titulo", $titulo,PDO::PARAM_STR);
			$stmt->execute();
		}
		public function borrarEspecialidad(){
			$this->cargarDatosDesdeForm();
			$id = $this->getId();
			$link = Conexion::conectar();
			$sql = "DELETE FROM especialidad WHERE id=:id";
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
    public function gettitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     *
     * @return self
     */
    public function settitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }
}
?>