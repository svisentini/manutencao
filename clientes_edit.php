<?php
    include('verifica_login.php');
    require 'conexao.php';

    $codigo = null;

    if (!empty($_GET['codigo'])) {
      $codigo = $_REQUEST['codigo'];
    }
  
    if (null == $codigo) {
      header("Location: index.php");
    }

    if (!empty($_POST)) {
      $nomeErro = null;
      $enderecoErro = null;
      $cidadeErro = null;

      $nome = $_POST['nome'];
      $endereco = $_POST['endereco'];
      $cidade = $_POST['cidade'];

      //Validação
      $validacao = true;
      if (empty($nome)) {
          $nomeErro = 'Por favor digite o nome!';
          $validacao = false;
      }

      if (empty($endereco)) {
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
      }

      if (empty($cidade)) {
        $cidadeErro = 'Por favor digite a cidade!';
        $validacao = false;
      }

      // update Cliente
      if ($validacao) {
        $pdo = Banco::conectar_consulta();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE clientes set nome = ?, endereco = ?, cidade = ? WHERE codigo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array( $nome, $endereco, $cidade, $codigo ));
        Banco::desconectar();
        header("Location: clientes.php");
      }


    } else {
      $pdo = Banco::conectar_consulta();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT nome, endereco, cidade FROM clientes where codigo = ?";

      $q = $pdo->prepare($sql);
      $q->execute(array($codigo));
      $data = $q->fetch(PDO::FETCH_ASSOC);

      $nome = $data['nome'];
      $endereco = $data['endereco'];
      $cidade = $data['cidade'];

      Banco::desconectar();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Manutenção - Clientes</title>
    <?php include('templates/template_header.php'); ?>

</head>
<body>
    <div id="app">

        <?php include('templates/template_side_menu.php'); ?>
        <form class="form-horizontal" action="clientes_edit.php?codigo=<?php echo $codigo ?>" method="post">
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        
                      <?php include('templates/template_user.php'); ?>

                    </ul>
                </div>
            </nav>
            

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Cadastro Clientes</h3>
                            
                        </div>

                        <!-- breadcrumb -->
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                                </ol>
                            </nav>
                        </div>

                    </div>

                </div>



                <h3> codigo cliente = <?php echo $codigo ?> </h3>
                <h3> nome cliente = <?php echo $nome ?> </h3>
                <h3> endereco cliente = <?php echo $endereco ?> </h3>



            <!-- Codigo -->
            <div class="col-md-2 col-12 ">
                        <label class="control-label">Código</label>
                        <div class="controls">
                            <input name="codigo" class="form-control"  type="text" placeholder="Código"
                                   value="<?php echo !empty($codigo) ? $codigo : ''; ?>">
                        </div>
            </div>


            <!-- Nome -->
            <div class="col-md-4 col-12 <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control"  type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
            </div>



            <div class="row">
                <!-- Cidade -->
                <div class="col-md-2 col-12 <?php echo !empty($cidadeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Cidade</label>
                        <div class="controls">
                            <input name="cidade" class="form-control"  type="text" placeholder="Cidade"
                                   value="<?php echo !empty($cidade) ? $cidade : ''; ?>">
                            <?php if (!empty($cidadeErro)): ?>
                                <span class="text-danger"><?php echo $cidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                </div>


                <!-- Endereço -->
                <div class="col-md-4 col-12 <?php echo !empty($enderecoErro) ? 'error' : ''; ?>">
                        <label class="control-label">Endereço</label>
                        <div class="controls">
                            <input name="endereco" class="form-control"  type="text" placeholder="Endereço"
                                   value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                            <?php if (!empty($enderecoErro)): ?>
                                <span class="text-danger"><?php echo $enderecoErro; ?></span>
                            <?php endif; ?>
                        </div>
                </div>


            </div>

            </br>
            
            <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="clientes.php" type="btn" class="btn btn-primary">Voltar</a>
            </div>


            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-end">
                        <p>2022 &copy; Sidao</p>
                    </div>
             
                </div>
            </footer>
        </div>
        </form>
    <?php include('templates/template_footer.php'); ?>
</body>
</html>
