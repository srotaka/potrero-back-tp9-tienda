<?php
  $conexion = mysqli_connect("127.0.0.1", "root", "root");
  mysqli_select_db($conexion, "potrero_tienda");

  // 2. Almacenamos los datos del envío POST
  // a. generar variables para cada dato a almacenar en la bbdd
  // Si se desea almacenar una imagen en la base de datos usar lo siguiente: addslashes(file_get_contents($_FILES['ID NOMBRE DE LA IMAGEN EN EL FORMULARIO']['tmp_name']))
  $tipo_prenda = $_POST ['tipo_prenda'];
  $marca = $_POST['marca'];
  $talle = $_POST['talle'];
  $precio = $_POST['precio'];  
  $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

  // 3. Preparar la orden SQL
  // INSERT INTO nombre_tabla (campos_tabla) VALUES (valores_a_ingresar)
  // => Ingresa dentro de la siguiente tabla los siguientes valores
  // a. generar la consulta a realizar
  $consulta = "INSERT INTO ropa (tipo_prenda,marca,talle,precio,imagen)
          VALUES ('$tipo_prenda','$marca','$talle','$precio','$imagen')";

  // 4. Ejecutar la orden y ingresamos datos
  // a. ejecutar la consulta
  mysqli_query($conexion,$consulta);

   // a. rederigir a index
   header('location: index.html');
