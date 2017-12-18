<!doctype html>
<html>
  <head>
    <?php
        session_start();
        if(!isset($_SESSION['user']))
            header('Location: http://localhost/tasker/index.php');

        require_once("utilities/connector.php");
        try{
            if(isset($_REQUEST['taskId'])){
                $sql = "UPDATE `task` set `name`='".$_REQUEST['taskName']."', `description` = '".$_REQUEST['taskDescription']."' WHERE `task_id` = ".$_REQUEST['taskId']."";

                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $_SESSION['last_mod_task'] = $_REQUEST['taskId'];
                header('Location: http://localhost/tasker/manage_task.php?mode=3');
            } else if (isset($_REQUEST['mode'])){
                $mode = $_REQUEST['mode'];
                if($mode == 3){
                    $task_id = $_SESSION['last_mod_task'];
                } else {
                    $task_id = $_REQUEST['task_id'];
                }
                $stmt = $conn->prepare("SELECT t.name, t.description, f.name as 'file_name', f.path, f.file_id 
                    FROM `task` as t left join `file` as f 
                    on t.task_id = f.task_id
                    where t.user_id = '".$_SESSION['user_id']."' and t.task_id=".$task_id.""); 
                $stmt->execute();
                $row = $stmt->fetch();
            } 
            else{
                header('Location: http://localhost/tasker/tasks.php');
            }
        } catch (PDOException $e){

        }
    ?>
    <title>Tasker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <script src="js/mdb.min.js"></script>
  </head>
  <body>
    <?php
        $pg_code = 1;
        include_once("utilities/header.php"); 
    ?>
        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <div class="jumbotron opacy">
            <div class="row main_title">
                <div class="col-md-12 main_dashboard">
                    <center>
                        <h1 class="h1_dashboard animated fadeIn"><?php if($mode != 1){ echo "Visualizar"; } else { echo "Modificar"; } ?> tarefa</h1>
                        <h3 class="animated fadeIn"><?php if($mode != 1){ echo "Visualização"; } else { echo "Modifição"; } ?> das informações da tarefa</h3>
                    </center>
                </div>
            </div>

            <div class="jumbotron animated fadeIn">
                <div>
                    <a href="#" id="modal">
                        <img src="img/rem.png" class="side_options" alt="Remover" title="Remover tarefa" height="30px" width="30px">
                    </a>
                    <?php if($mode != 1) { ?>
                        <a href="manage_task.php?mode=1&task_id=<?php echo $task_id; ?>">
                            <img src="img/alter.png" class="side_options" alt="Alterar" title="Alterar tarefa" height="30px" width="30px" >
                        </a>
                    <?php } ?>
                    <h2><?php if($mode != 1){ echo "Visualizar"; } else { echo "Modificar"; } ?> tarefa "<?php echo $row['name']; ?>"</h2>
                </div>
                <form enctype="multipart/form-data" action="manage_task.php" method="POST">
                    <input type="hidden" name="taskId" id="taskId" value="<?php echo $task_id; ?>">
                    <div class="form-group">
                        <label for="taskName">Nome da tarefa</label>
                        <?php 
                            if($mode != 1){
                                echo "<h5>".$row['name']."</h5>"; 
                            } else { 
                                echo "<input type='text' class='form-control' name='taskName' id='taskName' value='".$row['name']."'>"; 
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Descrição da tarefa</label>
                        <?php 
                            if($mode != 1){
                                if($row['description'] == "")
                                    echo "<h5>Nenhuma descrição foi dada a esta tarefa</h5>";
                                else 
                                    echo "<h5>".$row['description']."</h5>";
                            } else { 
                                echo "<textarea class='form-control' name='taskDescription' rows='3' id='taskDescription'>".$row['description']."</textarea>"; 
                            }
                        ?>
                    </div>
                    <?php if($row['file_name'] == "" && $mode == 1) { ?>
                        <div class="form-group">
                            <label for="fileInput">Anexos</label>
                            <input type="file" id="fileInput">
                        </div>
                    <?php } ?>
                    <p>Anexos</p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">ID do Anexo</th>
                                    <th style="width: 30%">Nome</th>
                                    <th style="width: 50%">Anexo</th>
                                    <th style="width: 10%">Opções</th>
                                </tr>
                            </thead>
                            <?php if($row['file_name'] != "") { ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['file_id']; ?></td>
                                    <td><?php echo $row['file_name']; ?></td>
                                    <td><?php echo "<a href='".$row['path']."' target='_blank'>".$row['path']."</a>" ?></td>
                                    <td>
                                        <a data-toggle='modal' class='open-delete_task_dialog' href='#delete_task_dialog' data-file='<?php echo $row['file_id']; ?>'>
                                            <img src='img/rem.png' class='options_list' alt='Remover' title='Remover tarefa' height='25px' width='25px' >
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <?php 
                        if($mode != 1){
                            echo "<a href='tasks.php' class='btn btn-success'>Voltar</a>"; 
                        } else { 
                            echo "<button type='submit' class='btn btn-default'>Salvar Modificações</button>
                            <a href='tasks.php' class='btn btn-danger'>Cancelar</a>"; 
                        }
                    ?>
                </form>
            </div>
        </main>
        </div>
    </div>


    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tem certeza disso?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que quer apagar este arquivo?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Sim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </div>
        </div>
    </div>
  </body>
</html>
