<?php
    class Usuario{
        private $usuID;
        private $usuLogin;
        private $usuClave;

        private function cargarDatosDesdeForm(){
            if(isset($_POST['usuID'])){
                $this->setUsuID($_POST['usuID']);
            }
            if(isset($_POST['usuLogin'])){
                $this->setUsuLogin($_POST['usuLogin']);
            }
            if(isset($_POST['usuClave'])){
                $this->setUsuClave($_POST['usuClave']);
            }
        }

        public function login()
        {
            $this->cargarDatosDesdeForm();
            $usuLogin = $this->getUsuLogin();
            $usuClave = $this->getUsuClave();

            $link = Conexion::conectar();
            $sql = "SELECT 1 FROM usuarios 
                        WHERE usuLogin = :usuLogin
                          AND usuClave = :usuClave";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(":usuLogin", $usuLogin, PDO::PARAM_STR);
            $stmt->bindParam(":usuClave", $usuClave, PDO::PARAM_STR);
            $stmt->execute();
            $cantidad = $stmt->rowCount();

            session_start();
            if($cantidad){
                $_SESSION['login'] = $usuLogin;
                header('location: listadoTurnos.php?fecha='.date("Y-m-d"));
            }
            else{               
                header('location: formLogin.php?error=2');
            }

        }

        public function logout()
        {
            session_unset();
            session_destroy();
            header('refresh:1; url=formLogin.php');
        }

        public function getUsuID()
        {
            return $this->usuID;
        }
        public function setUsuID($usuID)
        {
            $this->usuID = $usuID;
        }
        
        public function getUsuLogin()
        {
            return $this->usuLogin;
        }
        
        public function setUsuLogin($usuLogin)
        {
            $this->usuLogin = $usuLogin;
        }
        
        public function getUsuClave()
        {
            return $this->usuClave;
        }
        public function setUsuClave($usuClave)
        {
            $this->usuClave = $usuClave;
        }

        
    }
