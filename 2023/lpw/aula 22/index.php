<html>
    <body>
        <form action="" method="post">
            <label>Nome cidade:</label><br>
            <input type="text" name="cidade" required><br><br>
            <label>Nome estado:</label><br>
            <input type="text" name="estado" required><br><br>
            <label>ID Cidade:</label><br>
            <input type="number" name="id"><br><br>
            <input type="submit" name="insert" value="insert">
            <input type="submit" name="delete" value="delete">
        </form>
    </body>
</html>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include_once 'conexão.php';
        if(isset($_POST['insert'])){
            mysqli_query($con,"
                insert into cidade(nome,estado) 
                values('".$_POST['cidade']."',(select id from estado 
                                                where nome='".$_POST['estado']."'))
            ");
        }elseif(isset($_POST['delete'])){
            mysqli_query($con,"delete from cidade where id=".$_POST['id']);
        }
        $cidades = mysqli_query($con,"
        select c.nome as nome_cidade, e.nome as nome_estado
        from cidade c inner join estado e
            on e.id = c.estado
        order by c.id desc");
        while ($linha = mysqli_fetch_assoc($cidades)) {
            echo $linha['nome_estado']." - ". $linha['nome_cidade']."<br>";
        }
        mysqli_close($con);
    }
?>