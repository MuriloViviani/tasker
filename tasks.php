<!doctype html>
<html>
  <head>
    <?php
        session_start();
        if(!isset($_SESSION['user']))
            header('Location: http://localhost/tasker/index.php');
        
        require_once("utilities/connector.php");

        try{
            if(isset($_REQUEST['DeleteTaskId'])){
                $sql = "DELETE FROM `task` WHERE `task_id` = '".$_REQUEST['DeleteTaskId']."'";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
            }
        } catch (PDOException  $e){
            
        }

        try{
            $stmt = $conn->prepare("SELECT t.name, t.description, t.task_id, f.name as 'file_name' 
                FROM `task` as t left join `file` as f 
                on t.task_id = f.task_id 
                where t.user_id = '".$_SESSION['user_id']."' order by t.task_id"); 
            $stmt->execute();
        } catch (PDOException  $e){
            
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
        $pg_code = 0;
        include_once("utilities/header.php");
    ?>
        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <div class="jumbotron opacy">
                <div class="row main_title animated fadeIn">
                    <div class="col-md-12 main_dashboard">
                        <center>
                            <h1 class="h1_dashboard">Dashboard</h1>
                            <h3>Resumo de todas as tarefas</h3>
                        </center>
                    </div>
                </div>

                <div class="jumbotron animated fadeIn">
                    <div>
                        <a href="new_task.php">
                            <img src="img/add.png" class="side_options" alt="Adicionar" title="Nova Tarefa" height="30px" width="30px" >
                        </a>
                        <h2>Tarefas</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">#ID</th>
                                    <th style="width: 20%">Nome</th>
                                    <th style="width: 40%">Descrição</th>
                                    <th style="width: 20%">Anexo</th>
                                    <th style="width: 10%">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($stmt){
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>".$row['task_id']."</td>";
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['description']."</td>";
                                            echo "<td>".$row['file_name']."</td>";
                                            echo "<td>
                                                <a data-toggle='modal' class='open-delete_task_dialog' href='#delete_task_dialog' data-task='".$row['task_id']."'>
                                                    <img src='img/rem.png' class='options_list' alt='Remover' title='Remover tarefa' height='25px' width='25px' >
                                                </a>
                                                <a href='manage_task.php?task_id=".$row['task_id']."&mode=2'>
                                                    <img src='img/view.png' class='options_list' alt='Visualizar' title='Visualizar tarefa' height='25px' width='25px'>
                                                </a>
                                                <a href='manage_task.php?task_id=".$row['task_id']."&mode=1'> 
                                                    <img src='img/alter.png' class='options_list' alt='Alterar' title='Alterar dados' height='25px' width='25px'>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delete_task_dialog" name="delete_task_dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTaskModalTitle">Tem certeza disso?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="tasks.php" method="POST">
                <div class="modal-body">
                    <h5 id="text_1" name="text_1">Quer mesmo apagar esta tarefa?</h5>
                    <input type="hidden" id="txtTaskId" name="DeleteTaskId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-delete">Sim</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
  </body>
</html>
