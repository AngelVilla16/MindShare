<?php
//Configurar conexion y datos

$servidor = "localhost";
$usuario = "root";
$contraseña = "277353";
$bd= "Mindshare";

$con = mysqli_connect($servidor, $usuario, $contraseña, $bd);

//Consulta select a la tabla alumnos

$sql = "SELECT IdAlumno, Nombre, Apellido, Correo, Password FROM Alumnos";
$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>
        Consulta
    </title>
    <link rel="stylesheet" href="../../../main/Vista/CSS/consulta.css">
</head>
<body>
    <div class="tabla">
        <table border="3px">
            <tr>
            <th>
                Id 
            </th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Contraseña</th>
        </tr>
      
        <?php
            //Crear un bucle para mostrar las cosas
            if($resultado->num_rows>0){

                while($fila = $resultado->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>". htmlspecialchars($fila['IdAlumno']) .  "</td>";
                     echo "<td>". htmlspecialchars($fila['Nombre']) .  "</td>";
                      echo "<td>". htmlspecialchars($fila['Apellido']) .  "</td>";
                       echo "<td>". htmlspecialchars($fila['Correo']) .  "</td>";
                       echo"<td>". htmlspecialchars($fila["Password"]). "</td>";
                    echo "</tr>";
                
                }
            }
            else{
                echo "<tr><td colspan='4'>No hay alumnos registrados.</td></tr>";
            }
        ?>
          </table>
    </div>
</body>

</html>