<?php
    include('verifica_login.php');
    $codigo = filter_input(INPUT_GET, 'codigo', FILTER_SANITIZE_NUMBER_INT);

    if(!empty($codigo)){
        echo "<h3>Oi</h3>";
	    $result_usuario = "DELETE FROM clientes WHERE codigo='$codigo'";
	//    $resultado_usuario = mysqli_query($conn, $result_usuario);
	//    if(mysqli_affected_rows($conn)){
		    $_SESSION['msg'] = "<p style='color:green;'>Usuário apagado com sucesso</p>";
		    header("Location: clientes.php");
	//    }else{
	//	
	//	    $_SESSION['msg'] = "<p style='color:red;'>Erro o usuário não foi apagado com sucesso</p>";
	//	    header("Location: clientes.php");
	//    }
    //}else{	
	//    $_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um usuário</p>";
	//    header("Location: clientes.php");
    }
