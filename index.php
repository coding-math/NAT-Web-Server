<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAT Web Server</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/he/he.js"></script>
</head>
<body>
    <div class="container">
        <h1>Informações do Servidor e do Cliente</h1>

        <?php
            // Verifica se o IP do servidor é reconhecido
            $serverIp = $_SERVER['SERVER_ADDR'];
            if ($serverIp) {
                echo '<div class="alert alert-primary"><strong>IP do Servidor: </strong>' . $serverIp . '</div>';
            } else {
                echo '<div class="alert alert-danger"><strong>IP do Servidor não reconhecido</strong></div>';
            }
        ?>
        <div class="alert alert-secondary" id="date-time"></div>
        <?php
            // Verifica se o IP do cliente é reconhecido
            $ip = file_get_contents('https://api.ipify.org');

            // Localização do cliente
            $location = file_get_contents('https://ipinfo.io/' . $ip . '/geo');
            $locationData = json_decode($location, true);

            $city = $locationData['city'];
            $state = $locationData['region'];
            $country = $locationData['country'];
            $cep = $locationData['postal'];

            if ($ip) {
                echo '<div class="alert alert-client"><strong>IP do Cliente: </strong>' . $ip . 
                    '<br><strong>Localização:</strong> ' . $city . ', ' . $state . ', ' . $country . '. CEP: ' . $cep . '</div>';
            } else {
                echo '<div class="alert alert-danger"><strong>IP do Cliente não reconhecido</strong></div>';
            }
        ?>
    </div>

    <script type=module>
        function updateInformation() {
            var dateTimeLocation = new Date();
            var currentDate = dateTimeLocation.toLocaleDateString();
            var currentTime = dateTimeLocation.toLocaleTimeString();
            var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            document.getElementById("date-time").innerHTML = "<strong>Data:</strong> " + currentDate + "<br><strong>Hora:</strong> " + currentTime + "<br><strong>Fuso Horário:</strong> " + timeZone;
        }

        // Atualiza a cada segundo
        setInterval(updateInformation, 1000);
    </script>
</body>
</html>
