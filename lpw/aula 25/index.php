<?php
    $read= fopen('trabalho1.txt','r');
    while(!feof($read)){
        $input[]=fgets($read);
    }
    fclose($read);
?>
<html>
    <body>
        <form action="" method="get">
            <label>Nome:</label><br>
            <input type="text" name="nome" value="<?php echo $input[0] ?>"><br><br>
            <label>Cargo:</label><br>
            <input type="text" name="cargo" value="<?php echo $input[1] ?>"><br><br>
            <label>Altura:</label><br>
            <input type="text" name="altura" value="<?php echo $input[2] ?>"><br><br>
            <input type="submit" value="enviar">
        </form>
    </body>
</html>
<?php
    if(isset($_GET['nome'])){
        $lista= fopen('trabalho1.txt','a');
        @fwrite($lista,
            "\n".$_GET['nome']."\n".$_GET['cargo']."\n".$_GET['altura']
        );
        fclose($lista);
        $read= fopen('trabalho1.txt','r');
        $i=0;
        while(!feof($read)){
            echo fgets($read)."<br>";

            $i++;
            if($i==3){
                $i=0;
                echo "<br>";
            }
        }
        fclose($read);
    }
?>