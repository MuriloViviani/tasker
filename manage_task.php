<!doctype html>
<html>
  <head>
    <?php
        session_start();
        if(!isset($_SESSION['user']))
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
        $pg_code = 1;
        include_once("utilities/header.php"); 
    ?>
        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <div class="jumbotron opacy">
            <div class="row main_title">
                <div class="col-md-12 main_dashboard">
                    <center>
                        <h1 class="h1_dashboard animated fadeIn">Modificar tarefa</h1>
                        <h3 class="animated fadeIn">Modificação das informações da tarefa</h3>
                    </center>
                </div>
            </div>

            <div class="jumbotron animated fadeIn">
                <div>
                    <a href="#" id="modal">
                        <img src="img/rem.png" class="side_options" alt="Remover" title="Remover tarefa" height="30px" width="30px" >
                    </a>
                    <a href="#" id="modal">
                        <img src="img/alter.png" class="side_options" alt="Remover" title="Remover tarefa" height="30px" width="30px" >
                    </a>
                    <h2>Modificar tarefa "Nome da tarefa"</h2>
                </div>
                <form>
                    <div class="form-group">
                        <label for="taskName">Nome da tarefa</label>
                        <input type="text" class="form-control" id="taskName" placeholder="Nome da Tarefa Antiga">
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Descrição da tarefa</label>
                        <textarea class="form-control" rows="3" id="taskDescription"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fileInput">Anexos</label>
                        <input type="file" id="fileInput">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">ID do Anexo</th>
                                    <th style="width: 80%">Nome</th>
                                    <th style="width: 10%">Anexo</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-default">Salvar Modificações</button>
                    <a href="tasks.html"><button type="button" class="btn btn-danger">Cancelar</button></a>
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
                Tem certeza que quer apagar a tarefa "Nome da tarefa"?
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
