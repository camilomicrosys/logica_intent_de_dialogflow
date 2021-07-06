<?php 
require_once "logica.php";
//llamamos el archivo que contiene la funcion recogemos la opcion del formulario y la palabra clave para compararla con las opciones que tenemos y asi el bot enviar una respuesta en pantalla via ajax
$menu=$_POST['menu'];
$palabra_usuario=$_POST['opcion'];


//ejecutamos la funcion la cual nos retornara la opcion de submenu a mostrar si no es ninguna opcion retornamos un no entendi para que en la realidad el bot no cambie el boton y siga preguntando una opcion valida hasta haber finalizado
$opcion_a_mostrar=procesar($menu,$palabra_usuario);
if($opcion_a_mostrar==11){
echo "el dia para presentar tus examenes es ".date('Y-m-d')." es solo un ejemplo";
}else if($opcion_a_mostrar== 12){
echo "las pruebas se realizan cada 2 años es solo un ejemplo";
}else if($opcion_a_mostrar==13){
  echo "a continuacion no poseemos ningun tipo de informacion, consulta mas tarde por favor";  
}else if($opcion_a_mostrar==14){
echo "de momento no me han alimentado con informacion sobre saber  vuelve pronto para obtener informaciones sobre este tema"; 
}else{
  echo   $opcion_a_mostrar;
}