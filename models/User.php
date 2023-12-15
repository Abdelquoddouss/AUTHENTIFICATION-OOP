<?php
    include_once '../config/connection.php';
      
    class User{
        public $con;
        public $nom;
        public $prenom;
        public $age;
        public $password;

        public function __construct($nom,$prenom, $age,$password)
        {
            $this->con = DatabaseConnection::connect();
            $this->nom=$nom ;
            $this->prenom=$prenom;
            $this->age=$age ;
            $this->password=$password ;
        }
    
        public function create(){

            $password_hash=password_hash($this->password,PASSWORD_DEFAULT);
            $query="INSERT into `Utilisateur` (nom,prenom,age,role,pasword) 
                Values(?,?,?,0,?)";
                $stmt=mysqli_prepare($this->con,$query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt,"ssss",$this->nom,$this->prenom,$this->age,$password_hash);
                $result = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } 
        
        }

        public function getUserByUsername(){ 
        $sql="SELECT * FROM utilisateur where nom =?";
        $stmt=mysqli_prepare($this->con,$sql);
        
        if($stmt){
            mysqli_stmt_bind_param($stmt,"s",$this->nom);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                return $row;
            } else {
                echo "Error: " . mysqli_error($this->con);
            }
        }

        }
}
?>