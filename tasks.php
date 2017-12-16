<!doctype html>
<html lang="en">
  <head>
    <?php
        session_start();
        if(!isset($_SESSION['logged']))
            header('Location: http://localhost/tasker/index.php');
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
                                <tr>
                                    <td>1</td>
                                    <td>Lorem</td>
                                    <td>ipsum</td>
                                    <td>dolor</td>
                                    <td>
                                        <a href="#" id="modal">
                                            <img src="img/rem.png" class="options_list" alt="Remover" title="Remover tarefa" height="25px" width="25px" >
                                        </a>
                                        <a href="manage_task.php">
                                            <img src="img/view.png" class="options_list" alt="Visualizar" title="Visualizar tarefa" height="25px" width="25px">
                                        </a>
                                        <a href="manage_task.php"> 
                                            <img src="img/alter.png" class="options_list" alt="Alterar" title="Alterar dados" height="25px" width="25px">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>amet</td>
                                    <td>consectetur</td>
                                    <td>adipiscing</td>
                                    <td>
                                        <a href="#">
                                            <img src="img/rem.png" class="options_list" alt="Remover" title="Remover tarefa" height="25px" width="25px">
                                        </a>
                                        <a href="manage_task.php">
                                            <img src="img/view.png" class="options_list" alt="Visualizar" title="Visualizar tarefa" height="25px" width="25px">
                                        </a>
                                        <a href="manage_task.php"> 
                                            <img src="img/alter.png" class="options_list" alt="Alterar" title="Alterar dados" height="25px" width="25px">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                Tem certeza que quer apagar a tarefa "Nom da tarefa"?
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
