<?php 
require_once "../conexion.php"; 
/*creo la funcion que hara toda la logica y llamo la conexion para ejecutar el query
en esta parte se verifica que la palabra coincida con alguna subopcion  y nos entregara la subopcion paradarle al respuesta aca se crea y en bot.php se llama la funcion y se ejecuta
*/
function procesar($menu,$palabra_usuario){
$objeto= new Conectar();

$conexion=$objeto->conexion();


$query="SELECT * FROM respuestas where menu='$menu'";
$query=mysqli_query($conexion,$query);
$resultado=mysqli_fetch_all($query,MYSQLI_ASSOC);

$total_registros_por_menu=count($resultado);
//dato que ingresa el usuario , se limpia y hacemos que todas sean minusculas
$palabra_usuario= str_replace([" ",",","."],"",$palabra_usuario);
$palabra_usuario=strtolower($palabra_usuario);
//cuando el usuario ingresa una tilde o ñ el sistema pone un trienagulito y con esta funcion convierte caracteres especiales en ?  entonces bajamos en la comparacion del for y le decimos que las tildes y ñ me las cambie por ? para que coincidan las de tildes 
$palabra_usuario=utf8_decode($palabra_usuario);



//si en el for coincide la palabra con la bd va haber una respuesta almacenada aca y con esa continuaremos el camino
$opcion_encontrada=array();
$fin=false;
$fila_de_coincidecia=0;
//pongo un while ya que no sabemos en que vuelta encontrara el resultado y al fin de etiqueta while verifico que la fila de coincidencia sea menor al total de registros para que no se quede en infinito y si no hay nada se cambia a true sale pero en $opcion encontrada que es un array no abra nada y saldra
while($fin==false){



// palabra en bd y separada por array
    $coincidencia_bot=$resultado[$fila_de_coincidecia]['respuestas'];
    $coincidencia_bot=explode(",",$coincidencia_bot);
//contamos el total de palabras que se nos entrega por fila y las convertimos en array separadas por comas ya que en la bd las insertamos por ,
    $total_posibles_respuestas=count($coincidencia_bot);
//hacemos otro for para ver si alguna de las coincidencias coincide con la palabra ingresada por el cliente
    for($i=0;$i<$total_posibles_respuestas;$i++){
        //a la plabra en la pocicion i le cambio la tilde y ñ por ? para que me coincida con el utf8 que le coloque a la palabra del usuario aca simplemente estamos diciendo esto if($coincidencia_bot[$i])==$palabra_usuario){} solo que ya pusimos el str_replace como el utf8 me cambio los caracteres por ? yo se la aplico para que me la reconozco
     if(str_replace(["á","é","í","ó","ú","ñ"], "?", $coincidencia_bot[$i])==$palabra_usuario){
        //entonces aca cuando coincide una palabra entregaremos al bot la opcion del menu para que el bot muestre la respuesta coherente segun opcion seleccionada entonces en el 
       array_push($opcion_encontrada,$fila_de_coincidecia);
       $fin=true;
   }
}

   //creamos una fila de coincidencia para que el bot luego de hacer el ciclo de abajo y coincida  nos almacene la fila de coincidencia ya que en este for principal recorremos la fila y en el otro forcito recorremos cada palabra de la fila y aumentamos 1 a 1 para que vaya subiendo el contador
$fila_de_coincidecia=$fila_de_coincidecia+1;
//aca decimos que si fila de coinidencia  es igual a e total de registos  ya que resta una pocicion para los datos que inician en cero, entonces si es igual  a los registros salga por que ya no encontro nada
$verificar_salida=count($resultado);
if($fila_de_coincidecia==$verificar_salida){

   $fin=true;

}



}

if(count($opcion_encontrada)>0){
    //aca entregamos la opcion que selecciono el cliente cogiendo los datos entregados en la consulta a bd y accediendo a la posicion de la fila en la que estaba la coincidencia resultado contiene todos los registros y opcioncion encontrada tiene la fila de coincidencia y ahi accedemos a la opcion de menu acorde a la palabra, y opcion menu es el campo que queremos obtener para saber a donde lo enviamos con la respuesta
    $opcion=$resultado[$opcion_encontrada[0]]['opcion_menu'];
 return $opcion;
}else{
    //si no encontro nada dira no entendi, insertaremos la palabra que fallo y el menu para agregar futuras coincidencias
    $query="INSERT INTO palabras_entrenamiento (palabra,opcion_menu) values ('$palabra_usuario',$menu) ";
    $ejecucion_query=mysqli_query($conexion,$query);
    return "No entendi estoy en entrenamiento por favor explicame mas claramente";
}

}

