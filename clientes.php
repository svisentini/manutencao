<?php
include('verifica_login.php');

$itensPorPagina = 10;
$paginacaoLinksAntesDepois = 4;

// Pegar a pagina atual por GET
$paginaAtual = $_GET['page'];

// Verifica se a variável tá declarada, senão deixa na primeira página como padrão
if(isset($paginaAtual)) { 
  $paginaAtual = $paginaAtual;
} else { 
  $paginaAtual = 1; 
}



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
                            <h3>Cadastro de Clientes</h3>
                            
                        </div>

                        <!-- breadcrumb -->
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cadastro de Clientes</li>
                                </ol>
                            </nav>
                        </div>

                    </div>

                </div>






<!-- Striped rows start -->
<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">

    
      <div class="card-content">
        <div class="card-body">
          
        <form class="form">
          <div class="row">

          <div class="col-md-2 col-12">
              <div class="form-group">
                <label for="filtro-codigo">Código</label>
                <input type="text" id="filtro-codigo" class="form-control" placeholder="Código"
                       name="input-codigo">
              </div>
            </div>

            <div class="col-md-5 col-12">
              <div class="form-group">
                <label for="filtro-nome">Nome</label>
                <input type="text" id="filtro-nome" class="form-control" placeholder="Nome"
                       name="input-nome">
              </div>
            </div>

            <div class="col-md-3 col-12">
              <div class="form-group">
                <label for="filtro-cidade">Cidade</label>
                <input type="text" id="filtro-cidade" class="form-control" placeholder="Cidade"
                       name="input-cidade">
              </div>
            </div>

            <div class="col-md-2 col-12">
              <div class="form-group">
                <label for="filtro-funcao">Função</label>
                <input type="text" id="filtro-funcao" class="form-control" placeholder="Função"
                       name="input-funcao">
              </div>
            </div>

            <div class="float-right">
              <div class="form-group">
                </br>   
                <button type="submit" class="btn btn-primary me-1 mb-1"> Filtrar </button>
              </div>
            </div>

          </div>
        </form>
    

        </div>



        <!-- table striped -->
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>ACTION</th>
                <th>CÓDIGO</th>
                <th>NOME</th>
                <th>CIDADE</th>
                <th>FUNÇÃO</th>
              </tr>
            </thead>
            <tbody>


              <?php
                include 'conexao.php';
                $pdo = Banco::conectar_consulta();

                
                $InicioBusca = ($paginaAtual * $itensPorPagina) - $itensPorPagina;



                $sql = "SELECT codigo,nome,cidade,funcao FROM clientes ORDER BY nome asc LIMIT $InicioBusca, $itensPorPagina";

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
                    echo '<td>'. $row['codigo'] . '</td>';
                    echo '<td class="text-bold-500">'. $row['nome'] . '</td>';
                    echo '<td>'. $row['cidade'] . '</td>';
                    echo '<td>'. $row['funcao'] . '</td>';
                  echo '</tr>';
                }


                $quantidadeTotalRegistros = $pdo->query("SELECT count(*) from clientes")->fetchColumn();
                $quantidadePaginas = ceil($quantidadeTotalRegistros / $itensPorPagina);

                Banco::desconectar();
              ?>

              
            </tbody>
          </table>

          <div class="card-body">
          <?php   echo '<h1> Qtde de registros  = '. $quantidadeTotalRegistros . '</h1>';  ?>
          <?php   echo '<h1> Qtde de paginas    = '. $quantidadePaginas . '</h1>';  ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-primary">
                    <li class="page-item"><a class="page-link" href="clientes.php?page=1">First</a></li>

                    <?php
                      // Paginas Anteriores
                      for($i = $paginaAtual - $paginacaoLinksAntesDepois; $i <= $paginaAtual - 1; $i++) {
                        if ($i > 0){
                          echo '<li class="page-item"><a class="page-link" href="clientes.php?page=' .$i. '">' .$i. '</a></li>';
                        }
                      }
                      // Pagina atual
                      echo '<li class="page-item active"><a class="page-link" >' .$paginaAtual. '</a></li>';
                      // Paginas posteriores
                      for($i = $paginaAtual + 1; $i <= $paginaAtual + $paginacaoLinksAntesDepois; $i++) {
                        if($i <= $quantidadePaginas){
                          echo '<li class="page-item"><a class="page-link" href="clientes.php?page=' .$i. '">' .$i. '</a></li>';
                        }
                      }
                      // Ultima página
                      echo '<li class="page-item"><a class="page-link" href="clientes.php?page=' .$quantidadePaginas. '">Last</a></li>';
                    ?>

             
                    
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
