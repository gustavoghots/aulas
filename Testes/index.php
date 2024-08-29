<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Hashes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            background: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        form {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: calc(100% - 22px); /* Ajusta a largura para compensar o padding e bordas */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Inclui padding e bordas na largura total */
        }

        button {
            background: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #555;
        }

        .hash-output {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .hash-output p {
            margin: 10px 0;
        }

        .hash-output strong {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .hash-output em {
            display: block;
            font-style: italic;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerador de Hashes</h1>

        <p>
            Um <strong>hash</strong> é uma função que transforma um dado de entrada, geralmente uma string, em uma sequência fixa de caracteres. Ele é amplamente utilizado para garantir a integridade dos dados e para armazenamento seguro de senhas. Os algoritmos de hash garantem que pequenas alterações no dado original resultem em hashes completamente diferentes.
        </p>
        
        <p>
            Alguns dos algoritmos de hash mais comuns são o <strong>BLOWFISH</strong>, <strong>SHA-256</strong>, e <strong>RIPEMD-160</strong>. O Blowfish é um algoritmo de cifra de bloco que pode ser usado para gerar hashes de forma segura. O SHA-256 gera um hash de 256 bits e oferece um nível superior de proteção contra ataques de colisão. O RIPEMD-160 gera um hash de 160 bits e é uma alternativa ao SHA-1, oferecendo uma segurança adequada para muitas aplicações.
        </p>
        
        <form method="POST">
            <label for="inputData">Digite o dado para gerar as hashes:</label>
            <input type="text" id="inputData" name="inputData" required>
            <button type="submit">Gerar Hashes</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputData = $_POST["inputData"];
            
            // Gerando hashes usando diferentes algoritmos
            $blowfishHash = crypt($inputData, '$2y$10$' . bin2hex(random_bytes(22)) . '$');
            $sha256Hash = hash('sha256', $inputData);
            $ripemd160Hash = hash('ripemd160', $inputData);
            
            echo "<div class='hash-output'>";
            echo "<p><strong>Blowfish:</strong> $blowfishHash</p>";
            echo "<p><em>Blowfish é um algoritmo de cifra de bloco que pode ser usado para gerar hashes seguros. No PHP, o Blowfish é utilizado através da função <code>crypt()</</code> com um salt apropriado. Ele é conhecido por sua segurança e eficiência, especialmente em criptografia de senhas.</em></p>";
            
            echo "<p><strong>SHA-256:</strong> $sha256Hash</p>";
            echo "<p><em>SHA-256 (Secure Hash Algorithm 256-bit) é parte da família SHA-2 e gera um hash de 256 bits (32 bytes). É amplamente utilizado para proteger dados e oferece uma resistência robusta contra ataques de colisão, sendo mais seguro que o SHA-1.</em></p>";
            
            echo "<p><strong>RIPEMD-160:</strong> $ripemd160Hash</p>";
            echo "<p><em>RIPEMD-160 (RACE Integrity Primitives Evaluation Message Digest) gera um hash de 160 bits (20 bytes). Desenvolvido na Europa, é uma alternativa ao SHA-1 e é considerado uma opção segura para muitas aplicações, oferecendo um nível de proteção similar ao SHA-1.</em></p>";
            echo "</div>";
        }
        ?>

    </div>
</body>
</html>
