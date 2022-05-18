<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Manutenção</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Manutenção</h3>
                        <p></p>
                    </div>
                    <form action="login.php" method="POST">
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Username</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" name="login-username">
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Password</label>
          
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control" name="login-password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class='form-check clearfix my-4'>

                           <?php if(isset($_SESSION['nao_autenticado'])): ?>
                                <div class="notification is-danger">
                                <p>
                                   <code class="highlighter-rouge">ERRO: Usuário ou senha inválidos.</code>
                                </p>
                                </div>
                                <?php
                                endif;
                                unset($_SESSION['nao_autenticado']);
                           ?>

                        </div>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end" type="submit">Sign in</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>

</html>
