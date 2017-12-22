<!doctype html>
<html>
    <head>
        <?php
            session_start();
            if(!isset($_SESSION['user']))
                header('Location: http://localhost/tasker/index.php');

            require_once("utilities/connector.php");
            try{
                if(isset($_REQUEST['taskName'])){
                    if(isset($_FILES['inputFile'])){
                        $uploaddir = 'C:\\xampp2\\htdocs\\tasker\\uploads\\';
                        $uploadfile = $uploaddir . basename($_FILES['inputFile']['name']);
                        if (move_uploaded_file($_FILES['inputFile']['tmp_name'], $uploadfile)) {
                            $filepath = str_replace("\\", "\\\\",$uploadfile);
                            $filename = basename($_FILES['inputFile']['name']);
                        }
                    }
                

                    $sql = "INSERT INTO `task`(`name`, `description`, `user_id`) VALUES ('".$_REQUEST['taskName']."', '".$_REQUEST['taskDescription']."', ".$_SESSION['user_id'].")";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    if(isset($filepath)){
                        $lastid = $conn->lastInsertId();

                        $sql = "INSERT INTO `file`(`name`, `path`, `task_id`) VALUES ('".$filename."', '".$filepath."', ".$lastid.")";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                    }

                    $done = true;
                }
            } catch (Exception $e){
                echo $e;
                $error = true;
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
                            <h1 class="h1_dashboard animated fadeIn">Nova tarefa</h1>
                            <h3 class="animated fadeIn">Portal para criação de novas tarefas</h3>
                        </center>
                    </div>
                </div>

                <div class="jumbotron animated fadeIn">
                    <?php 
                        if(isset($done)){
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Tarefa cadastrada com sucesso</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                        } else {
                            if(isset($error)){
                                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>Ocorreu um erro ao cadastrar esta tarefa, por favor tente novamente</strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                            }
                        }
                    ?>
                    <h2>Nova tarefa</h2>
                    <form enctype="multipart/form-data" action="new_task.php" method="POST">
                        <div class="form-group">
                            <label for="taskName">Nome da tarefa</label>
                            <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Nova tarefa" maxlength="35" required>
                        </div>
                        <div class="form-group">
                            <label for="taskDescription">Descrição da tarefa</label>
                            <textarea class="form-control" rows="3" name="taskDescription" id="taskDescription" placeholder="Descrição da tarefa" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">Anexos</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                            <input type="file" id="inputFile" name="inputFile">
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