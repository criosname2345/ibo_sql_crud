<?php
include_once('DEPARTMENTS_SERVER.php');//SERVIDOR BACKEND

//fetch the record to be updated
if(isset($_GET['edit'])){
    $departamento_id = $_GET['edit'];
    $edit_state = true;
    //frontend 7) llamara datos
    $rec = pg_query($db, "SELECT * FROM departments WHERE departamento_id=$departamento_id");
    $record = pg_fetch_array($rec);
    $departamento_id = $record['departamento_id'];
    $nombre_departamento = $record['nombre_departamento'];
    $jefe_id = $record['jefe_id'];
    $localizacion_id = $record['localizacion_id'];



}

?>


<!DOCTYPE HTML>

<html lang="es">

<head>
    <title> MI primer CRUD</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/semantic.min.css">
    <!--    //SEMANTIC UI CON  JQUERY-->

    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <script src="js/semantic.js"></script>

</head>
<body>
<!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
<div class="ui teal  menu">
    <div class="header item">
        CRUD PHP HEROKU POSTGRESQL
    </div>
    <a class="item active " href="index.php" >
        EMPLOYEES
    </a>
    <a class="item" href="DEPARTMENTS.php">
        DEPARTMENTS
        <i ></i>
    </a>
    <a class="item" href="JOBS.php">
        JOBS
    </a>
</div>
<!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->

<!--//Mostrar notificaciones de mensajes
//3-->
<?php if (isset($_SESSION['msg'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        ?>
    </div>

<?php endif;  ?>



<table class="ui inverted blue table celled">
    <thead>
    <tr>
        <!--fronted 8) desplegar datos en html-->
        <th>departamento_id</th>
        <th>nombre_departamento</th>
        <th>jefe_id</th>
        <th>localizacion_id</th>


        <th colspan="2" >Action</th>
    </tr>

    </thead>


    <tbody>
    <!-- 9)llamando registros de la base de datos-->
    <?php while ($row = pg_fetch_array($results))   { ?>
        <tr>
            <td><?php echo $row['departamento_id']; ?></td>
            <td><?php echo $row['nombre_departamento']; ?></td>
            <td><?php echo $row['jefe_id']; ?></td>
            <td><?php echo $row['localizacion_id']; ?></td>

            <td>
                <!--10)//actualizar registros-->
                <a class="ui circular blue  icon button" href="DEPARTMENTS.php?edit=<?php echo $row['departamento_id'];?>"> Edit</a>
            </td>
            <td>
                <!-- 11)BORRAR REGISTROS-->
                <a class="ui circular teal twitter icon button" href="DEPARTMENTS_SERVER.php?del=<?php echo $row['departamento_id'];?>" >Delete</a>
            </td>
        </tr>

    <?php }?>
    </tbody>

</table>
<!--server.php conexion con la base de datos-->
<form action="DEPARTMENTS_SERVER.php"  method="POST"  class="ui form">
    <!--//12) actualizar registros en el formulario-->
    <input type="hidden" name="empleado_id"  value="<?php echo $departamento_id;?>">

    <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
    <div class="field">
        <div class="two fields">
        <div class="ui right labeled input">
            <input type="number" placeholder="Enter ..." autofocus maxlength="3" name="departamento_id" value="<?php echo $departamento_id;?>">
            <div class="ui teal  label">
                departamento_id
            </div>
        </div>




        <div class="ui right labeled input ">
            <input type="text" placeholder="Enter ..." autofocus maxlength="20" name="nombre_departamento" value="<?php echo $nombre_departamento;?>">
            <div class="ui teal   label">
                nombre_departamento
            </div>
        </div>
        </div>
    </div>


    <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
    <div class="field">
            <div class="two fields">
                <div class="ui right labeled input ">
                    <input type="number" placeholder="Enter ..." autofocus maxlength="20" name="jefe_id" value="<?php echo $jefe_id;?>">
                    <div class="ui teal   label">
                        jefe_id
                    </div>
                </div>


                <div class="ui right labeled input ">
                    <input type="number" placeholder="Enter ..." name="localizacion_id" autofocus maxlength="50" value="<?php echo $localizacion_id;?>">
                    <div class="ui teal   label">
                        localizacion_id
                    </div>
                </div>
            </div>
    </div>


    <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->


    <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
    <div class="input-group">
        <!-- //actualizar registros
         //3-->
        <?php   if ($edit_state == false): ?>

            <button type="submit" name="save" class="btn" onclick="alert('Tu imformacion se esta actualizando')" >Guardar</button>
            <button type="button" onclick="alert('Tu imformacion se esta actualizando')"  class="ui secondary  loading button positive"></button>
        <?php else: ?>

            <button type="submit" name="update" class="btn" onclick="alert('Tu imformacion se esta actualizando')" >Actualizar</button>
            <button type="button" onclick="alert('Tu imformacion se esta actualizando')"  class="ui secondary  loading button positive"></button>
        <?php endif; ?>

    </div>



</form>


</body>


</html>