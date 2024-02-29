<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <script>
            function toggleDarkMode() {
                const body = document.body;
                body.classList.toggle("dark-mode");
            }
        </script>
    </head>
    <body>
        <div class="moon"></div>
        <button onclick="toggleDarkMode()">Toggle Dark Mode</button>
        <form method="POST">
            <div id="pessoa">
                <h1>Pessoa</h1><br>
                <label>Nome:</label><br>
                <input type="text" name="nome" id="nome" required><br><br>
                <div id="cpf">
                    <label>CPF:</label><br>
                    <input type="text" name="cpf"><br><br>
                </div>
                <div id="cnpj">
                    <label>CNPJ:</label><br>
                    <input type="text" name="cnpj"><br><br>
                </div>
                <label>Idade:</label><br>
                <input type="number" name="idade" id="idade"><br><br>
                <label>Altura:</label><br>
                <input type="text" name="altura" id="altura"><br><br>
                <select name="tipo" id="tipo">
                    <option value="0">Escolha</option>
                    <option value="fisica">Fisica</option>
                    <option value="juridica">Juridica</option>
                </select>
                <input type="submit" value="enviar">
            </div>
            <script> //display
                const cpf = document.getElementById("cpf")
                cpf.style.display = 'none';
                const cnpj = document.getElementById("cnpj")
                cnpj.style.display = 'none';

                document.getElementById("tipo").addEventListener("change", function(event){
                    let tipo = document.getElementById("tipo");
                    if(tipo.value==0){
                        cnpj.style.display = 'none';
                        cpf.style.display = 'none';
                        alert("escolha um tipo de pessoa");
                    }else if(tipo.value=='fisica'){
                        cnpj.style.display = 'none';
                        cpf.style.display = 'inline';
                    }else{
                        cpf.style.display = 'none';
                        cnpj.style.display = 'inline';
                    }
                });
            </script>
        </form>
        <div class="dados-pessoa">
    </body>
</html>
<?php
    include_once 'pessoa.php';
    include_once 'juridica.php';
    include_once 'fisica.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        session_start();
        if($_POST['tipo']=='fisica'){
            $_SESSION['lista'][]= new fisica($_POST['nome'],$_POST['idade'],$_POST['altura'],$_POST['cpf']);
        }else{
            $_SESSION['lista'][]= new juridica($_POST['nome'],$_POST['idade'],$_POST['altura'],$_POST['cnpj']);
        }
        foreach($_SESSION['lista'] as $i=>$lista){
            echo "<h2>Dados da Pessoa $i:</h2>";
            echo "<ul>";
            echo "<li>Nome: " . $lista->getNome() . "</li>";
            echo "<li>Idade: " . $lista->getIdade() . "</li>";
            echo "<li>Altura: " . $lista->getAltura() . "</li>";
            if(get_class($lista) == 'fisica'){
                echo "<li>CPF: " . $lista->getCpf() . "</li>";
            }else{
                echo "<li>CNPJ: " . $lista->getCnpj() . "</li>";
            }
            echo "</ul>";
        }
    }
?>
<html>
    </div>
</html>