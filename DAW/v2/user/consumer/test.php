<pre>
    <?php
        session_start();
        print_r($_SESSION['carrinho']);

        include_once '../../class/DAO/produtoDAO.class.php';
        $objProdutosDAO = new Produto_DAO();
        print_r($objProdutosDAO->retornarProduto(1)) //nesse caso vai ser baseado nos ids do carrinho

    ?>
</pre>