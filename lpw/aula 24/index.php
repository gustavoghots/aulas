<html>
    <body>
        <form action="" method="post">
            <?php
                include_once 'conexão.php';
                if(isset($_GET['atualizar'])){
                    $cidade= mysqli_query($con, "select * from cidade where id=".$_GET['atualizar']);
                    $cidade= mysqli_fetch_assoc($cidade);
                    $estado= mysqli_query($con, "select nome from estado where id=".$cidade['estado']);
                    $estado= mysqli_fetch_assoc($estado);
                    $cidade['estado']=$estado['nome'];
                }
            ?>
            <label>Nome cidade:</label><br>
            <input type="text" name="cidade" value="<?php echo $cidade['nome'] ;?>" required><br><br>
            <label>Nome estado:</label><br>
            <input type="text" name="estado" value="<?php echo $cidade['estado'] ;?>" required><br><br>
            <input type="hidden" name="id" value="<?php echo $cidade['id'] ;?>">
            <input type="submit" name="insert" value="Cadastro">
            <input type="submit" name="update" value="Atualizar">
        </form>
    </body>
</html>
<?php
    if(isset($_POST['insert'])){
        mysqli_query($con,"
            insert into cidade(nome,estado) 
            values('".$_POST['cidade']."',(select id from estado 
                                            where nome='".$_POST['estado']."'))
        ");
    }elseif(isset($_POST['update'])){
        mysqli_query($con, "update cidade set nome='".$_POST['cidade']."', estado = (select id from estado
                                                                            where nome='".$_POST['estado']."') where id=".$_POST['id']);
    }
    if(isset($_GET['excluir'])){
        mysqli_query($con,"delete from cidade where id=".$_GET['excluir']."");
    }
    $cidades = mysqli_query($con,"
        select c.id as id_cidade, c.nome as nome_cidade, e.nome as nome_estado
        from cidade c inner join estado e
            on e.id = c.estado
        order by c.id desc");
    while ($linha = mysqli_fetch_assoc($cidades)) {
        echo $linha['nome_estado']." - ". $linha['nome_cidade'].
        "   <a href='index.php?excluir=".$linha['id_cidade']."'>Deletar</a>".
        "   <a href='index.php?atualizar=".$linha['id_cidade']."'>Update</a><br>";
    }
    mysqli_close($con);
?>