<?php
$conexion = mysqli_connect("127.0.0.1", "root", "root");
mysqli_select_db($conexion, "potrero_tienda");

$id = $_GET['id'];
$consulta = "SELECT * FROM ropa WHERE id=$id";
$respuesta = mysqli_query($conexion, $consulta);
$datos = mysqli_fetch_array($respuesta);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Ropa</title>
</head>

<body>
    <?php
    // Asignamos a diferentes variables los respectivos valores del array $datos.
    $tipo_prenda = $datos["tipo_prenda"];
    $marca = $datos["marca"];
    $talle = $datos["talle"];
    $precio = $datos["precio"];
    $imagen = $datos['imagen']; ?>

    <h2>Modificar</h2>
    <p>Ingrese los nuevos datos de la prenda.</p>

    <form action="" method="post" enctype="multipart/form-data">
        <label>Tipo de prenda</label>
        <input type="text" name="tipo_prenda" placeholder="Tipo de Prenda" value="<?php echo "$tipo_prenda"; ?>"><br>
        <label>Marca</label>
        <input type="text" name="marca" placeholder="Marca" value="<?php echo "$marca"; ?>"><br>
        <label>Talle</label>
        <input type="text" name="talle" placeholder="Talle" value="<?php echo "$talle"; ?>"><br>
        <label>Precio</label>
        <input type="text" name="precio" placeholder="Precio" value="<?php echo "$precio"; ?>"><br>
        <label>Imagen</label>
        <input type="file" name="imagen" placeholder="imagen"><br>
        <input type="submit" name="guardar_cambios" value="Guardar Cambios"> &nbsp;
        <button type="submit" name="Cancelar" formaction="index.html">Cancelar</button>
    </form>
    <?php
    // Si en la variable constante $_POST existe un indice llamado 'guardar_cambios' ocurre el bloque de instrucciones.
    if (array_key_exists('guardar_cambios', $_POST)) {

        // 2. Almacenamos los datos actualizados del envío POST
        // a. generar variables para cada dato a almacenar en la bbdd
        // Si se desea almacenar una imagen en la base de datos usar lo siguiente:
        // addslashes(file_get_contents($_FILES['ID NOMBRE DE LA IMAGEN EN EL FORMULARIO']['tmp_name']))
        $tipo_prenda = $_POST['tipo_prenda'];
        $marca = $_POST['marca'];
        $talle = $_POST['talle'];
        $precio = $_POST['precio'];
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        // 3'. Preparar la orden SQL
        $consulta = "UPDATE ropa SET tipo_prenda='$tipo_prenda', marca='$marca', talle='$talle', precio='$precio', imagen='$imagen' WHERE id =$id";

        // 4'. Ejecutar la orden y actualizamos los datos
        // a. ejecutar la consulta
        mysqli_query($conexion, $consulta);

        // a. rederigir a index
        header('location: index.html');
    } ?>
</body>

</html>