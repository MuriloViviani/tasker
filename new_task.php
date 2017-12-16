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
        $pg_code = 1;
        include_once("utilities/header.php"); 
    ?>
        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <div class="jumbotron opacy">
            <div class="row main_title">
                <div class="col-md-12 main_dashboard">
                    <center>
                        <h1 class="h1_dashboard animated fadeIn">Nova tarefa</h1>
                        <h3 class="animated fadeIn">Portal para criação de novas tarefas</h3>
                    </center>
                </div>
            </div>

            <div class="jumbotron animated fadeIn">
                <h2>Nova tarefa</h2>
                <form>
                    <div class="form-group">
                        <label for="taskName">Nome da tarefa</label>
                        <input type="text" class="form-control" id="taskName" placeholder="Nova tarefa">
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Descrição da tarefa</label>
                        <textarea class="form-control" rows="3" id="taskDescription" placeholder="Descrição da tarefa" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputFile">Anexos</label>
                        <input type="file" id="inputFile">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">#ID</th>
                                    <th style="width: 80%">Nome</th>
                                    <th style="width: 10%">Anexo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Lorem</td>
                                    <td>
                                        <a href="#" id="modal">
                                            <img src="img/rem.png" alt="Remover" title="Remover tarefa" height="25px" width="25px" >
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Lorem</td>
                                    <td>
                                        <a href="#" id="modal">
                                            <img src="img/rem.png" alt="Remover" title="Remover tarefa" height="25px" width="25px" >
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-default">Salvar tarefa</button>
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
  </body>
</html>
