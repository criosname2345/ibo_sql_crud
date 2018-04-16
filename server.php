<?php
/**
 * Created by PhpStorm.
 * User: Kernel-2018
 * Date: 29/03/2018
 * Time: 16:01
 */
    //Mostrar notificaciones de mensajes
    //3
    session_start();

    //INICIALIZAR VARIABLES
    //$name = "";
    //$address = "";
    //$id = 0;
    //1)variables para conectar con employees
    $empleado_id = "";//1
    $primer_nombre = "";//2
    $segundo_nombre = "";//3
    $correo = "";//4
    $numero_telefono = "";//5
    $fecha_ingreso = "";//6
    $trabajo_id = "";//7
    $salario = "";//8
    $jefe_id = "";//9
    $departamento_id = "";//10
    $sexo = "";//11
    $genero = ""; //12
    $estado_civil = "";//13




    //actualizar registros
    //3
    $edit_state = false;


    //conectar con la base de datos

$db = pg_connect("host=ec2-54-235-109-37.compute-1.amazonaws.com port=5432 dbname=d7gus2h865unf3 user=fmpvdytxhfvjih password=2d5a0a7ae034d99ca447c08ae00f98d57b1ac9ace2d104b6091d13d919a2f9ac");

    // si se presiona el boton save de el formulario

    if(isset($_POST['save'])){
        //2)empiezo a pasar los nombres de los atributos de mi formulario

        //$name = $_POST['name'];
        //$address = $_POST['address'];
        $empleado_id = $_POST['empleado_id'];
        $primer_nombre = $_POST['primer_nombre'];
        $segundo_nombre = $_POST['segundo_nombre'];
        $correo  = $_POST['correo'];
        $numero_telefono = $_POST['numero_telefono'];
        $fecha_ingreso  = $_POST['fecha_ingreso'];
        $trabajo_id = $_POST['trabajo_id'];
        $salario = $_POST['salario'];
        $jefe_id = $_POST['jefe_id'];
        $departamento_id  = $_POST['departamento_id'];
        $sexo = $_POST['sexo'];
        $genero  = $_POST['genero'];
        $estado_civil  = $_POST['estado_civil'];


        //3) hacemos la query de insertar datos

        $query = "INSERT INTO employees(empleado_id,primer_nombre,segundo_nombre,correo,numero_telefono,fecha_ingreso,trabajo_id,salario,jefe_id,departamento_id,sexo,genero,estado_civil) VALUES('$empleado_id', '$primer_nombre',
        '$segundo_nombre','$correo','$numero_telefono','$fecha_ingreso','$trabajo_id','$salario','$jefe_id','$departamento_id','$sexo','$genero','$estado_civil')";
        pg_query($db, $query);
        //Mostrar notificaciones de mensajes
        //3
        $_SESSION['msg'] = "Imformacion Guardada";

        header('location: index.php'); //redireccionamos a la pagina principal

    }

    //actualizar registros
    //4)-->

    if (isset($_POST['update'])){
        $empleado_id  = pg_escape_string($_POST['empleado_id']);
        $primer_nombre  = pg_escape_string($_POST['primer_nombre']);
        $segundo_nombre = pg_escape_string($_POST['segundo_nombre']);
        $correo = pg_escape_string($_POST['correo']);
        $numero_telefono = pg_escape_string($_POST['numero_telefono']);
        $fecha_ingreso    = pg_escape_string($_POST['fecha_ingreso']);
        $trabajo_id = pg_escape_string($_POST['trabajo_id']);
        $salario = pg_escape_string($_POST['salario']);
        $jefe_id = pg_escape_string($_POST['jefe_id']);
        $departamento_id = pg_escape_string($_POST['departamento_id']);
        $sexo = pg_escape_string($_POST['sexo']);
        $genero = pg_escape_string($_POST['genero']);
        $estado_civil = pg_escape_string($_POST['estado_civil']);
        $empleado_id = pg_escape_string($_POST['empleado_id']);


        pg_query($db, "UPDATE employees SET empleado_id='$empleado_id', primer_nombre='$primer_nombre', segundo_nombre='$segundo_nombre', correo='$correo' , numero_telefono='$numero_telefono', fecha_ingreso='$fecha_ingreso', trabajo_id='$trabajo_id', salario='$salario',jefe_id='$jefe_id', departamento_id='$departamento_id', sexo='$sexo', genero='$genero', estado_civil='$estado_civil' WHERE empleado_id=$empleado_id");
        $_SESSION['msg'] = "Imformacion Actualizada";

        header('location: index.php'); //redireccionamos a la pagina principal
    }

    //<!-- BORRAR REGISTROS
    //5)-->
    if(isset($_GET['del'])){
        $empleado_id = $_GET['del'];
        pg_query($db, "DELETE FROM employees WHERE empleado_id=$empleado_id");
        $_SESSION['msg'] = "Imformacion Eliminada";

        header('location: index.php'); //redireccionamos a la pagina principal

    }

    //recuperar registros##################
    //6)
    $results = pg_query($db, "SELECT * FROM employees");


?>