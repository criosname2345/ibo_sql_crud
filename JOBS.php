<?php
include_once('JOBS_SERVER.php');//SERVIDOR BACKEND

//fetch the record to be updated
if(isset($_GET['edit'])){
    $trabajo_id = $_GET['edit'];
    $edit_state = true;
    //frontend 7) llamara datos
    $rec = pg_query($db, "SELECT * FROM jobs WHERE trabajo_id=$trabajo_id");
    $record = pg_fetch_array($rec);
    $trabajo_id = $record['trabajo_id'];
    $titulo_trabajo = $record['titulo_trabajo'];
    $min_salario = $record['min_salario'];
    $max_salario = $record['max_salario'];



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
        <th>trabajo_id</th>
        <th>titulo_trabajo</th>
        <th>min_salario</th>
        <th>max_salario</th>


        <th colspan="2" >Action</th>
    </tr>

    </thead>


    <tbody>
    <!-- 9)llamando registros de la base de datos-->
    <?php while ($row = pg_fetch_array($results))   { ?>
        <tr>
            <td><?php echo $row['trabajo_id']; ?></td>
            <td><?php echo $row['titulo_trabajo']; ?></td>
            <td><?php echo $row['min_salario']; ?></td>
            <td><?php echo $row['max_salario']; ?></td>

            <td>
                <!--10)//actualizar registros-->
                <a class="ui circular blue  icon button" href="JOBS.php?edit=<?php echo $row['trabajo_id'];?>"> Edit</a>
            </td>
            <td>
                <!-- 11)BORRAR REGISTROS-->
                <a class="ui circular teal twitter icon button" href="JOBS_SERVER.php?del=<?php echo $row['trabajo_id'];?>" >Delete</a>
            </td>
        </tr>

    <?php }?>
    </tbody>

</table>
<!--server.php conexion con la base de datos-->
<form action="JOBS_SERVER.php"  method="POST"  class="ui form">
    <!--//12) actualizar registros en el formulario-->
    <input type="hidden" name="trabajo_id"  value="<?php echo $trabajo_id;?>">

    <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
    <div class="field">
        <div class="two fields">
            <div class="ui right labeled input">
                <input type="text" placeholder="Enter ..." autofocus maxlength="20" name="trabajo_id" value="<?php echo $trabajo_id;?>">
                <div class="ui teal  label">
                    trabajo_id
                </div>
            </div>

            <div class="ui right labeled input ">
                <input type="text" placeholder="Enter ..." autofocus maxlength="20" name="titulo_trabajo" value="<?php echo $titulo_trabajo;?>">
                <div class="ui teal   label">
                    titulo_trabajo
                </div>
            </div>
        </div>
    </div>


    <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
    <div class="field">
        <div class="two fields">
            <div class="ui right labeled input ">
                <input type="number" placeholder="Enter ..." autofocus maxlength="20" name="min_salario" value="<?php echo $min_salario;?>">
                <div class="ui teal   label">
                    min_salario
                </div>
            </div>


            <div class="ui right labeled input ">
                <input type="number" placeholder="Enter ..." name="max_salario" autofocus maxlength="50" value="<?php echo $max_salario;?>">
                <div class="ui teal   label">
                    max_salario
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