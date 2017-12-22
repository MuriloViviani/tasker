<!doctype html>
<html>
  <head>
    <?php
        session_start();
        if(!isset($_SESSION['user']))
            header('Location: http://localhost/tasker/index.php');
        
        require_once("utilities/connector.php");
        try{
            if(isset($_REQUEST['userId'])){
                if($_REQUEST['passwd'] == $_REQUEST['confirmPasswd']){
                    $sql = "UPDATE `user` set `name`='".$_REQUEST['userName']."', `passwd` = '".md5($_REQUEST['passwd'])."' WHERE `user_id` = ".$_REQUEST['userId']."";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    $_SESSION['last_mod_user'] = $_REQUEST['userId'];
                    header('Location: http://localhost/tasker/user_management.php?mode=3&done=1');
                } else {
                    $_SESSION['last_mod_user'] = $_REQUEST['userId'];
                    header('Location: http://localhost/tasker/user_management.php?mode=3&error=1');
                }
            } else if (isset($_REQUEST['mode'])){
                $mode = $_REQUEST['mode'];
                if($mode == 3 || isset($_REQUEST['error'])){
                    $user_id = $_SESSION['last_mod_user'];
                } else {
                    $user_id = $_REQUEST['user_id'];
                }
                $stmt = $conn->prepare("SELECT * FROM `user` where user_id = '".$user_id."'"); 
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
        $pg_code = 3;
        include_once("utilities/header.php"); 
    ?>
        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <div class="jumbotron opacy">
            <div class="row main_title">
                <div class="col-md-12 main_dashboard">
                    <center>
                        <h1 class="h1_dashboard animated fadeIn"><?php if($mode!=1) { echo "Modificar"; } else { echo "Visualizar"; } ?> usuário</h1>
                        <h3 class="animated fadeIn"><?php if($mode!=1) { echo "Modificação"; } else { echo "Visualização"; } ?> das informações de usuários</h3>
                    </center>
                </div>
            </div>

            <div class="jumbotron animated fadeIn">
                <?php 
                    if(isset($_REQUEST['error'])){
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Opa! parece que as senhas não batem, por favor tente novamente</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>"; 
                    } else if (isset($_REQUEST['done'])){
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Dados atualizados com sucesso!</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>"; 
                    }
                ?>
                <div>
                    <?php if($user_id != $_SESSION['user_id']) { ?>
                        <a data-toggle='modal' class='open-delete_user_dialog' href='#delete_user_dialog' data-user='<?php echo $user_id; ?>'>
                            <img src="img/rem.png" class="side_options" alt="Remover" title="Remover usuário" height="30px" width="30px" >
                        </a>
                    <?php } ?>
                    <?php if($mode == 1){ ?>
                        <a href="user_management.php?user_id=<?php echo $user_id ?>&mode=2">
                            <img src="img/alter.png" class="side_options" alt="Alterar" title="Alterar usuário" height="30px" width="30px" >
                        </a>
                    <?php } ?>
                    <h2><?php if($mode != 1) { echo "Modificar"; } else { echo "Visualizar"; } ?> usuário "<?php echo $row['name']; ?>"</h2>
                </div>
                <form>
                    <input type="hidden" name="userId" id="userId" value="<?php echo $user_id; ?>">
                    <div class="form-group">
                        <label for="userName">Nome do usuário</label>
                        <?php 
                            if($mode != 1) { 
                                echo "<input type='text' class='form-control' name='userName' id='userName' placeholder='Nome do usuário' required value='".$row['name']."'>";
                            } else { 
                                echo "<h5>".$row['name']."</h5>";
                            } 
                        ?>
                    </div>
                    <?php if($mode != 1) { ?>
                        <div class="form-group">
                            <label for="passwd">Senha</label>
                            <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Senha" required>
                        </div>
                        <div class="form-group">
                            <label for="confirPasswd">Confirmar senha</label>
                            <input type="password" class="form-control" name="confirmPasswd" id="confirmPasswd" placeholder="Confirmar senha" required>
                        </div>
                        <button type="submit" class="btn btn-default">Salvar Modificações</button>
                        <a href="user_overview.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                    <?php 
                        } else {
                            echo "<a href='user_overview.php'><button type='button' class='btn btn-default'>Voltar</button></a>";
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

    <!-- Delete User Modal -->
    <div class="modal fade" id="delete_user_dialog" name="delete_user_dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalTitle">Tem certeza disso?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="user_overview.php" method="POST">
                <div class="modal-body">
                    <h5 id="text_1" name="text_1">Quer mesmo apagar este usuário?</h5>
                    <input type="hidden" id="txtUserId" name="DeleteUserId" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-delete">Sim</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
  </body>
</html>