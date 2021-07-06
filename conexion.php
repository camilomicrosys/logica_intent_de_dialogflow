<?php  
//creamos la conexion a la base de datos y retornamos la conexion
class Conectar{


	private $host="localhost";
	private $usuario="root";
	private $pass="";
	private $db="chatbot_icfes";

    public function conexion(){
        $conexion=mysqli_connect($this->host,$this->usuario,$this->pass,$this->db);
        if($conexion){
           return $conexion;
       }else{
        return "no conectado";
    }
}
}




