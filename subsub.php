    <?php
    session_start();

    if (!isset($_SESSION['tipo_usuario'])) {
        header('Location: index.php');
        exit();
    }

    $tipo_usuario = $_SESSION['tipo_usuario'];
    include('includes/conexion.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesar el formulario
        $nombre_subcategoria = $_POST['nombre_subcategoria'];
        $categoria = $_POST['categoria'];
        $coordinacion = $_POST['coordinacion']; // Nuevo campo para la coordinación

        // Obtener el identificador de la categoría seleccionada
        $query_identificador = "SELECT identificador FROM categorias WHERE Fullname = '$categoria'";
        $result_identificador = mysqli_query($conn, $query_identificador);
        $row_identificador = mysqli_fetch_assoc($result_identificador);
        $identificador_categoria = $row_identificador['identificador'];

        // Obtener las subcategorías basadas en el identificador de la categoría
        $query_subcategoria = "SELECT nombre_subcategoria FROM subcategoria WHERE identificador_categoria = '$identificador_categoria'";
        $result_subcategoria = mysqli_query($conn, $query_subcategoria);
        $subcategorias = array();

        while ($row_subcategoria = mysqli_fetch_assoc($result_subcategoria)) {
            $subcategorias[] = $row_subcategoria['nombre_subcategoria'];
        }

        // Ejemplo de impresión
        echo "Categoría: $categoria<br>";
        echo "Subcategoría: $nombre_subcategoria<br>";
        echo "Coordinación: $coordinacion<br>";
        echo "Subcategorías asociadas: " . implode(", ", $subcategorias) . "<br>";
    }

    // ...
    ?>

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIF | Añadir Servicio </title>
    <link rel="stylesheet" href="assets/css/tarjeta-dist.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="contenedor">
        <form action="add_subsub.php" method="POST" class="tarjeta contenido">
            <label>Servicio<span style="color:red;">*</span></label>
            <input type="text" name="nombre_subsub" placeholder="Añade el nombre de la subcategoría (servicio)">

            <div class="form-group">
                <label>Dirección<span style="color:red;">*</span></label>
                <select name="categoria" class="form-control" onchange="actualizarSubcategorias(this)">
                    <?php
                    // Conectar a la base de datos (puedes considerar incluir esta parte en el archivo de conexión)
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "sistemas";

                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    if (!$conn) {
                        die("Conexión fallida: " . mysqli_connect_error());
                    }

                    // Obtener todas las categorías de la tabla categorias
                    $query = "SELECT DISTINCT Fullname, identificador FROM categorias";
                    $result = mysqli_query($conn, $query);

                    // Mostrar las categorías en el menú desplegable
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['Fullname'] . "' data-identificador='" . $row['identificador'] . "'>" . $row['Fullname'] . "</option>";
                    }

                    // Cerrar la conexión
                    mysqli_close($conn);
                    ?>
                </select>

                <!-- Nuevo campo para la Coordinación -->
                <label>Coordinación<span style="color:red;">*</span></label>
                <select name="subcategoria" class="form-control">
                    <?php
                    // Conectar a la base de datos (puedes considerar incluir esta parte en el archivo de conexión)
                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    if (!$conn) {
                        die("Conexión fallida: " . mysqli_connect_error());
                    }

                    // Obtener todas las subcategorías de la tabla subcategoria
                    $query_subcategoria = "SELECT DISTINCT nombre_subcategoria FROM subcategoria";
                    $result_subcategoria = mysqli_query($conn, $query_subcategoria);

                    // Mostrar las subcategorías en el menú desplegable
                    while ($row_subcategoria = mysqli_fetch_assoc($result_subcategoria)) {
                        echo "<option value='" . $row_subcategoria['nombre_subcategoria'] . "'>" . $row_subcategoria['nombre_subcategoria'] . "</option>";
                    }

                    // Cerrar la conexión
                    mysqli_close($conn);
                    ?>
                </select>

                <!-- Campos ocultos para almacenar identificadores -->
                <input type="hidden" name="identificador_categoria" id="identificador_categoria" value="">
                <input type="hidden" name="identificador_subcategoria" id="identificador_subcategoria" value="">
            </div>
            <input type="submit" value="Añadir">
        </form>
    </div>

    <script>
        function actualizarSubcategorias(selectElement) {
            var identificadorCategoria = selectElement.options[selectElement.selectedIndex].getAttribute('data-identificador');
            var subcategoriaSelect = document.querySelector("select[name='nombre_subcategoria']");
            subcategoriaSelect.innerHTML = '';
            document.getElementById('identificador_categoria').value = identificadorCategoria;
        }
    </script>
</body>

</html>
