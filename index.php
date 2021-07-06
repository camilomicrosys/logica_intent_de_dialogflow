<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
    <script src="ajax/jquery.js"></script>
</head>
<body id="cargarPagina">
<strong>Hola soy robot tu asistente virtual,</strong><br>
<strong>Por favor digita la opcion que nececitas</strong>
<ul>
    <li>1 examen</li>
    <li>2 pruebas</li>
    <li>3 informacion</li>
    <li>4 Saber</li>
</ul>    


<form id="opcion1" action="logica/bot.php" method="POST">
    <input type="text" id="opcion" name="opcion"><br>
    <input type="hidden" id="menu" name="menu" value="1">
    <button id="procesar" type="submit">Send</button>


</form>


    <div id="respuesta_bot"></div>

    <script src="ajax/ajax.js"></script>
</body>
</html>








