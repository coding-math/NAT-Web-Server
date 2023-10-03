<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAT Web Server</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Informações do Servidor Dinâmico</h1>

        <?php
        // Verifica se o IP do servidor é reconhecido
        $serverIp = $_SERVER['SERVER_ADDR'];
        if ($serverIp) {
            echo '<div class="alert alert-primary"><strong>IP do Servidor: ' . $serverIp . '</strong></div>';
        } else {
            echo '<div class="alert alert-danger"><strong>IP do Servidor não reconhecido</strong></div>';
        }
        ?>

        <div class="alert alert-secondary" id="date-time-location"></div>
    </div>

    <script>
        function updateInformation() {
            var dateTimeLocation = new Date();
            var currentDate = dateTimeLocation.toLocaleDateString();
            var currentTime = dateTimeLocation.toLocaleTimeString();
            var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            document.getElementById("date-time-location").innerHTML = "<strong>Data:</strong> " + currentDate + "<br><strong>Hora:</strong> " + currentTime + "<br><strong>Fuso Horário:</strong> " + timeZone;
        }

        // Atualiza a cada segundo
        setInterval(updateInformation, 1000);
    </script>
</body>

</html>
