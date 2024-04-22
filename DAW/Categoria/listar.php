<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../login.php");
    }
    include_once '../class/categoria.class.php';
    include_once '../class/DAO/categoriaDAO.class.php';

    if(isset($_GET['deleteOk'])){
        echo "<p style='color: red;'>Categoria excluida com sucesso</p>";
    }elseif(isset($_GET['deleteNOk'])){
        echo "<p style='color: red;'>Não foi possivel deletar a Categoria</p>";
    }
    if(isset($_GET['atualizarOk'])) echo "<p style='color: red;'>Categoria atualizado com sucesso</p>";
    elseif(isset($_GET['atualizarNOk'])) echo "<p style='color: red;'>Não foi possivel atualizar Categoria</p>";
    

    $objCategoriaDAO = new Categoria_DAO();
    $retorno = $objCategoriaDAO->listar();
?>
    <p><a href="../usuario/adm/index.php">Voltar</a></p>
<?php
    foreach ($retorno as $i => $linha) {
        ?>
        <div style="border:1px solid; margin-bottom:2px;">
            <h3><?= $linha['descricao'];?></h3>
            <p><a href="editar.php?id=<?=$linha['idCategoria']?>">Editar</a></p>
            <p><a href="excluir.php?id=<?=$linha['idCategoria']?>">Excluir</a></p>
        </div>
    <?php
    }
?>