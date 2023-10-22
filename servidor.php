
<?php
/* Función para conectar utilizando PDO */
function conectar() {
    $servidor = "127.0.0.1";
    $usuario = "root";
    $password = "";
    $database = "chat";

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$database", $usuario, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

/* Función para ejecutar una consulta utilizando PDO */
function ejecutar($sql) {
    $conexion = conectar();
    
    try {
        $conexion->exec($sql);
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

/* Función para consultar utilizando PDO */
function consultar($sql, $cols_num) {
    $conexion = conectar();
    
    try {
        $query = $conexion->query($sql);
        $matriz = $query->fetchAll(PDO::FETCH_NUM);
        return $matriz;
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

/* Resto de tu código sigue igual */

/* Función de retorno de datos AJAX */
function AJAX($nombre, $mensaje) {
    if ($nombre != "" && $mensaje != "") {
        ejecutar("CALL insertar('".$nombre."','".$mensaje."')");
    }
    $chat = consultar("CALL mostrar()", 2);
    header("Content-Type: text/plain");
    foreach ($chat as $dato) {
        echo($dato[0].": ".$dato[1]."\n\n");
    }
}
?>