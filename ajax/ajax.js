$(document).ready(function(){
//creamos una base url de nuestro proyecto
let base_url="http://localhost/intenciones_bot/";
//cuando le damos click al boton que envia el mensaje al bot recogemos el valor del menu y la opcion que a seleccionado y la mandamos via ajax
$("#procesar").on('click',function(e){
  e.preventDefault();
  let menu=$("#menu").val();
  let opcion=$("#opcion").val();
 
    $.ajax({
                url: base_url+"logica/bot.php",
                type: "POST",
                // sending data
                data: {menu: menu,opcion:opcion},

                // response text
                success: function(data){
                //colocamos la respuesta en el html y recargamos la pagina asincronamente
                $("#respuesta_bot").html(data);
                
                   
                    
                }

            });

})
});