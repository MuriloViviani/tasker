<!doctype html>
<html>
  <head>
    <?php
        session_start();
        if(!isset($_SESSION['user']))
            header('Location: http://localhost/tasker/index.php');

        require_once("utilities/connector.php");
        if(isset($_REQUEST['newUserName'])){
            if($_REQUEST['newUserPasswd'] == $_REQUEST['ConfirmUserPasswd']){
                try{
                    $sql = "SELECT * FROM `user` WHERE `name` = '".$_REQUEST['newUserName']."'";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    if($row){
                        $insertError = true;
                    } else {
                        $sql = "INSERT INTO `user`(`name`, `passwd`) VALUES ('".$_REQUEST['newUserName']."', '".md5($_REQUEST['newUserPasswd'])."')";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $done = true;
                    }
                } catch (PDOException $e){
                    echo $e;
                    $error = true;
                } 
            } else {
                $passwdError = true;
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
    <?php
        $pg_code = 3;
        include_once("utilities/header.php"); 
    ?>
            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <div class="jumbotron opacy">
                    <div class="row main_title">
                        <div class="col-md-12 main_dashboard">
                            <center>
                                <h1 class="h1_dashboard animated fadeIn">Novo usuário</h1>
                                <h3 class="animated fadeIn">Portal para criação de novos usuários</h3>
                            </center>
                        </div>
                    </div>

                    <div class="jumbotron animated fadeIn">
                        <?php 
                            if(isset($error)) {
                                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>Ocorreu um erro ao cadastrar o usuário, por favor tente novamente</strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                            } else if(isset($done)) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Usuário cadastrado com sucesso</strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                            } else if(isset($passwdError)){
                                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>Opa! parece que suas senhas não batem, por favor tente novamente</strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                            } else if (isset($insertError)){
                                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>Opa! parece que este usuário ja foi cadastrado, por favor use outro nome </strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                            }
                        ?>
                        <h2>Novo usuário</h2>
                        <form action="new_user.php" action="POST">
                            <div class="form-group">
                                <label for="newUserName">Nome do usuário</label>
                                <input type="text" class="form-control" name="newUserName" id="newUserName" placeholder="Nome do usuário" maxlength="35" required>
                            </div>
                            <div class="form-group">
                                <label for="newUserPasswd">Senha</label>
                                <input type="password" class="form-control" name="newUserPasswd" id="newUserPasswd" placeholder="Senha" required>
                            </div>
                            <div class="form-group">
                                <label for="ConfirmUserPasswd">Confirmar Senha</label>
                                <input type="password" class="form-control" name="ConfirmUserPasswd" id="ConfirmUserPasswd" placeholder="Senha" required>
                            </div>
                            <button type="submit" class="btn btn-default">Salvar usuário</button>
                        </form>
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
    </body>
</html>