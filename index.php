<!doctype html>
<html>
  <head>
    <?php
      $error = false;
      if(isset($_POST['name']) & isset($_POST['passwd'])){
        $user = $_POST['name'];
        $passwd = md5($_POST['passwd']);
        require_once("utilities/connector.php");

        try{
          $stmt = $conn->prepare("SELECT `user_id`, `name` FROM `user` WHERE `name` = '".$user."' AND `passwd` = '".$passwd."'"); 
          $stmt->execute();
          $row = $stmt->fetch();
          
          if($row){
            session_start();
            $_SESSION['user'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id'];

            header('Location: http://localhost/tasker/tasks.php');
          } else {
            $error = true;
          }
          
          $conn = null;
        }catch(PDOException  $e){
            echo "Error: ".$e;
        }
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
    <header>
        <nav class='navbar navbar-default navbar-expand-md fixed-top'>
            <div class='container-fluid'>
                <div class='navbar-header'>
                    <a class='navbar-brand' href='#'>
                        <img alt='Brand' src='img/tasker.png'>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
      <br />
      <div class="jumbotron opacy main">
        <div class="flex-center flex-column">
          <h1 class="animated fadeIn mb-4">Bem-Vindo ao Tasker!</h1>
          <h5 class="animated fadeIn mb-3">Antes de começar, por favor entre com seu usuário e senha</h5>

          <br/>
          <div class="jumbotron animated fadeIn mb-3 col-sm-4">
            <?php 
              if($error == true){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>usuário ou senha não encontrados</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              }
            ?>
            <form class="form-horizontal" action="index.php" method="POST">
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Usuário</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Usuário" required>  
                </div>
              </div>
              <div class="form-group">
                <label for="passwd" class="col-sm-3 control-label">Senha</label>
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Senha" required>
                </div>
              </div>
              <div class="form-group">
                <center>
                  <button type="submit" class="btn btn-default">Entrar</button>
                </center>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
  </body>
</html>
