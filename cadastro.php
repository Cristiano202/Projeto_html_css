<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugestões</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section id="sugestoes">
    <h1>Sugestões</h1>
    
    <form id="sugestao" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="comentario">Comentário ou Sugestão:</label><br>
        <textarea id="comentario" name="comentario" rows="5" cols="30" required></textarea><br><br>
        
        <input type="submit" value="Enviar Sugestão">
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["comentario"])) {
            $comentario = trim($_POST["comentario"]);
            
            if (!empty($comentario)) {
                $comentario = htmlspecialchars($comentario, ENT_QUOTES, 'UTF-8');
                
                // Salvar o comentário em um arquivo
                $arquivo = "sugestoes.txt";
                if ($handle = fopen($arquivo, "a")) {
                    if (fwrite($handle, $comentario . PHP_EOL)) {
                        echo "<p style='color:green;'>Sugestão enviada com sucesso!</p>";
                    } else {
                        echo "<p style='color:red;'>Erro ao salvar a sugestão. Tente novamente.</p>";
                    }
                    fclose($handle);
                } else {
                    echo "<p style='color:red;'>Erro ao abrir o arquivo para salvar a sugestão.</p>";
                }
            } else {
                echo "<p style='color:red;'>Por favor, insira um comentário antes de enviar.</p>";
            }
        } else {
            echo "<p style='color:red;'>Campo de comentário não recebido.</p>";
        }
    }
    ?>
</section>

</body>
</html>