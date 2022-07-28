<?php
    include('verifica_login.php');

    $itensPorPagina = 10;
    $paginacaoLinksAntesDepois = 4;
    $paginaAtual = 1;

    // Verifica se existe o parametro "page", senão deixa na primeira página como padrão
    if(isset($_GET['page'])) { 
      $paginaAtual = $_GET['page'];
    } else { 
      $paginaAtual = 1; 
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
                                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                                </ol>
                            </nav>
                        </div>

                    </div>

                </div>


<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" relo="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="deletecode.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="update_id" id="update_id">
          <h4> Do you want to delete this Data ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
          <button type="submit" name="updatedata" class="btn btn-primary"> YES, delete it. </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- TABELA DE CLIENTES -->

<div class="row" id="table-striped">
  <div class="col-12">
    <div class="card">

    
      <div class="card-content">
        <div class="card-body">
          
        <form class="form">
          <div class="row">

            <!-- Botao FILTRAR -->
            <div class="col-md-2 col-12">
              <div class="form-group">
                </br>   
                <button type="submit" class="btn btn-primary me-1 mb-1"> Filtrar </button>
              </div>
            </div>

            <!-- Codigo -->
            <div class="col-md-2 col-12">
              <div class="form-group">
                <label for="filtro-codigo">Código</label>
                <input type="text" id="filtro-codigo" class="form-control" placeholder="Código"
                       value="<?php echo isset($_GET['codigo']) ? $_GET['codigo'] : ''; ?>"   
                       name="codigo">
              </div>
            </div>

            <!-- Nome -->
            <div class="col-md-4 col-12">
              <div class="form-group">
                <label for="filtro-nome">Nome</label>
                <input type="text" id="filtro-nome" class="form-control" placeholder="Nome"
                    value="<?php echo isset($_GET['nome']) ? $_GET['nome'] : ''; ?>"   
                    name="nome">
              </div>
            </div>

            <!-- Cidade -->
            <div class="col-md-2 col-12">
              <div class="form-group">
                <label for="filtro-cidade">Cidade</label>
                <input type="text" id="filtro-cidade" class="form-control" placeholder="Cidade"
                      value="<?php echo isset($_GET['cidade']) ? $_GET['cidade'] : ''; ?>"   
                      name="cidade">
              </div>
            </div>

            <!-- Função -->
            <div class="col-md-2 col-12">
              <div class="form-group">
                <label for="filtro-funcao">Função</label>
                    <select class="form-select" name="funcao">
                      <option <?php echo ($_GET['funcao'] == 'Todos') ?          'selected' : '' ?> >Todos</option>
                      <option <?php echo ($_GET['funcao'] == 'Cliente') ?        'selected' : '' ?> >Cliente</option>
                      <option <?php echo ($_GET['funcao'] == 'Transportadora') ? 'selected' : '' ?> >Transportadora</option>
                    </select>

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

                unset($_REQUEST['page']);
                $filtroClientes = "";
                         
                // ===========================================================
                // FILTRO DOS CLIENTES
                // Nome
                if (!empty($_GET['nome'])){ 
                  $filtroClientes = " AND nome LIKE '%" . $_GET['nome'] . "%' "; 
                }
                // Função
                if (!empty($_GET['funcao']) && $_GET['funcao'] != 'Todos'){ 
                  $filtroClientes .= " AND funcao = '" . $_GET['funcao'] . "' "; 
                }
                // Código
                if (!empty($_GET['codigo'])){ 
                  $filtroClientes .= " AND codigo LIKE '%" . $_GET['codigo'] . "%' "; 
                }
                // Cidade
                if (!empty($_GET['cidade'])){ 
                  $filtroClientes .= " AND cidade LIKE '%" . $_GET['cidade'] . "%' "; 
                }
                // ===========================================================
                
                $quantidadeTotalRegistros = $pdo->query("SELECT count(*) from clientes WHERE 1=1 " . $filtroClientes)->fetchColumn();
                $quantidadePaginas = ceil($quantidadeTotalRegistros / $itensPorPagina);
                $sql = "SELECT codigo,nome,cidade,funcao FROM clientes WHERE 1=1 " . $filtroClientes . " ORDER BY nome asc LIMIT $InicioBusca, $itensPorPagina";

                foreach($pdo->query($sql)as $row)
                {
                  echo '<tr class="table-danger">';
                    // Operations
                    echo '<td>';
                    echo '<a href="clientes_edit.php?codigo=' . $row['codigo'] . '"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="edit"></i></a>';
                    echo ' ';
                    echo '<a href="clientes_delete.php?codigo=' . $row['codigo'] . '"><i class="badge-circle badge-circle-light-secondary font-medium-1 deletebtn" data-feather="delete"></i></a>';
                    echo '</td>';
                    
                    // Data
                    echo '<td>'. $row['codigo'] . '</td>';
                    echo '<td class="text-bold-500">'. $row['nome'] . '</td>';
                    echo '<td>'. $row['cidade'] . '</td>';
                    echo '<td>'. $row['funcao'] . '</td>';
                  echo '</tr>';
                }
                
                Banco::desconectar();
              ?>

              
            </tbody>
          </table>


          <!-- PAGINACAO -->

         



          <div class="card-body">

          <div class="float-end">
              <h5> Quantidade de Registros = <?php echo $quantidadeTotalRegistros; ?></h5>
              <h5> Quantidade de Páginas = <?php echo $quantidadePaginas; ?></h5>
          </div>

          <?php $parametrosUrl =  http_build_query($_REQUEST); ?>
          
          
          
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-primary">
                    <?php
                      // Primeira página
                      echo '<li class="page-item"><a class="page-link" href="clientes.php?page=1&' .$parametrosUrl . '">First</a></li>';

                      // Paginas Anteriores
                      for($i = $paginaAtual - $paginacaoLinksAntesDepois; $i <= $paginaAtual - 1; $i++) {
                        if ($i > 0){
                          echo '<li class="page-item"><a class="page-link" href="clientes.php?page=' .$i. '&' . $parametrosUrl . '">' .$i. '</a></li>';
                        }
                      }
                      // Pagina atual
                      echo '<li class="page-item active"><a class="page-link" >' .$paginaAtual. '</a></li>';
                      // Paginas posteriores
                      for($i = $paginaAtual + 1; $i <= $paginaAtual + $paginacaoLinksAntesDepois; $i++) {
                        if($i <= $quantidadePaginas){
                          echo '<li class="page-item"><a class="page-link" href="clientes.php?page=' .$i. '&' .$parametrosUrl . '">' .$i. '</a></li>';
                        }
                      }
                      // Ultima página
                      echo '<li class="page-item"><a class="page-link" href="clientes.php?page=' .$quantidadePaginas. '&' .$parametrosUrl . '">Last</a></li>';

                      
                    ?>

             
                    
                </ul>

            </nav>
            
            
            


          </div>


        </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM DA TABELA DE CLIENTES -->





            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-end">
                        <p>2022 &copy; Sidao</p>
                    </div>
             
                </div>
            </footer>

  <?php include('templates/template_footer.php'); ?>
  <script 
  
    $(document).ready(function () {
      $('.deletebtn').on('click', function()) {
        $('#deletemodal').modal('show');
      });
    });
  
  </script>
</body>
</html>
