<?php
include('verifica_login.php');

$itensPorPagina = 10;

$paginaAtual = intval($_GET['pagina']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Manutenção - Table</title>
    <?php include('templates/template_header.php'); ?>

</head>
<body>
    <div id="app">

        <?php include('templates/template_side_menu.php'); ?>

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
                            <h3>Table</h3>
                            <p class="text-subtitle text-muted">Examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap.</p>
                        </div>

                        <!-- breadcrumb -->
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table Itens</li>
                                </ol>
                            </nav>
                        </div>

                    </div>

                </div>






<!-- Striped rows start -->
<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Clientes</h3>
      </div>
      <div class="card-content">
        <div class="card-body">
          

            <div class="col-md-1 mb-1">
              <p>Qtde de registros</p>
              <fieldset class="form-group">
                  <select class="form-select" id="basicSelect">
                    <option>5</option>
                    <option selected>10</option>
                    <option>20</option>
                    <option>30</option>
                    <option>40</option>
                  </select>
              </fieldset>
            </div>

        </div>


        <script type="text/javascript">
          document.getElementById('basicSelect').onChange = function(){
            console.log "teste";
          }
        </script>

        <!-- table striped -->
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>ACTION</th>
                <th>ID</th>
                <th>NOME</th>
                <th>ENDEREÇO</th>
                <th>TELEFONE</th>
              </tr>
            </thead>
            <tbody>


              <?php
                include 'conexao.php';
                $pdo = Banco::conectar_tickets();

                $quantidadeRegistros = $pdo->query("SELECT count(*) from qtde_registros")->fetchColumn();
                $quantidadePaginas = ceil($quantidadeRegistros/$itensPorPagina);

                


                $sql = "SELECT * FROM qtde_registros ORDER BY id asc LIMIT 10, $itensPorPagina";

                foreach($pdo->query($sql)as $row)
                {
                  echo '<tr class="table-danger">';
                    // Operations
                    echo '<td>';
                    echo '<a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="edit"></i></a>';
                    echo ' ';
                    echo '<a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="delete"></i></a>';
                    echo '</td>';
                    
                    // Data
                    echo '<td>'. $row['id'] . '</td>';
                    echo '<td class="text-bold-500">'. $row['nome'] . '</td>';
                    echo '<td>'. $row['endereco'] . '</td>';
                    echo '<td>'. $row['telefone'] . '</td>';
                  echo '</tr>';
                }
                Banco::desconectar();
              ?>

              
            </tbody>
          </table>

          <div class="card-body">
          <?php   echo '<h1> Qtde de registros  = '. $quantidadeRegistros . '</h1>';  ?>
          <?php   echo '<h1> Qtde de paginas    = '. $quantidadePaginas . '</h1>';  ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-primary">
                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>
<!-- Striped rows end -->



<!-- Contextual classes start -->
<div class="row" id="table-contexual">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Contextual classes</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <p>Use contextual classes to color table rows or individual cells. Read full documnetation <a
              href="https://getbootstrap.com/docs/4.3/content/tables/#contextual-classes" target="_blank">here.</a></p>
        </div>
        <!-- table contextual / colored -->
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>NAME</th>
                <th>RATE</th>
                <th>SKILL</th>
                <th>TYPE</th>
                <th>LOCATION</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-active">
                <td class="text-bold-500">Michael Right</td>
                <td>$15/hr</td>
                <td class="text-bold-500">UI/UX</td>
                <td>Remote</td>
                <td>Austin,Taxes</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-primary">
                <td class="text-bold-500">Morgan Vanblum</td>
                <td>$13/hr</td>
                <td class="text-bold-500">Graphic concepts</td>
                <td>Remote</td>
                <td>Shangai,China</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-secondary">
                <td class="text-bold-500">Tiffani Blogz</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-success">
                <td class="text-bold-500">Ashley Boul</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-danger">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-warning">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-info">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-light">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
              <tr class="table-dark">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
              </tr>
            </tbody>
          </table>

          </p>
          <h3> Teste </h3>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contextual classes end -->


</div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-end">
                        <p>2022 &copy; Sidao</p>
                    </div>
             
                </div>
            </footer>
        </div>
    </div>
    <?php include('templates/template_footer.php'); ?>
</body>
</html>
