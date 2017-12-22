<?php
    echo "<header>
        <nav class='navbar navbar-default navbar-expand-md fixed-top'>
            <div class='container-fluid'>
                <div class='navbar-header'>
                    <a class='navbar-brand' href='#'>
                        <img alt='Brand' src='img/tasker.png'>
                    </a>
                </div>";
            if(isset($_SESSION['user'])){
                echo"<span class='navbar-text'>
                    Logado como ".$_SESSION['user'].", <a href='utilities/session.php'>SAIR</a>
                </span>";
            }
            echo "</div>
        </nav>
    </header>";

    echo "<div class='container-fluid'>
    <div class='row'>
        <nav class='col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar'>
            <ul class='nav nav-pills flex-column'>
                <li class='nav-item'>";
    
    // Check the page and set the respective menu
    if($pg_code == 0)
        echo "<a class='nav-link active' href='#'>Overview<span class='sr-only'>(current)</span></a>";
    else
        echo "<a class='nav-link' href='tasks.php'>Overview</a>";
    
    echo "</li> <li class='nav-item'>";
    
    if($pg_code == 1)
        echo "<a class='nav-link active' href='#'>Gerenciar tarefas<span class='sr-only'>(current)</span></a>";
    else
        echo "<a class='nav-link' href='new_task.php'>Gerenciar tarefas</a>";
    
    echo "</li> <li class='nav-item'>";
    
    if($pg_code == 2)
        echo "<a class='nav-link active' href='#'>Usuários<span class='sr-only'>(current)</span></a>";
    else
        echo "<a class='nav-link' href='user_overview.php'>Usuários</a>";

    echo "</li> <li class='nav-item'>";

    if($pg_code == 3)
        echo "<a class='nav-link active' href='#'>Gerenciar usuário<span class='sr-only'>(current)</span></a>";
    else
        echo "<a class='nav-link' href='new_user.php'>Gerenciar usuário</a>";

    echo "</li></ul></nav>";
?>