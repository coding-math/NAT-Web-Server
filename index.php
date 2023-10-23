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
        <div class="alert alert-client" id="client-info"></div>
    </div>

    <script type=module>
        function updateInformation() {
            var dateTimeLocation = new Date();
            var currentDate = dateTimeLocation.toLocaleDateString();
            var currentTime = dateTimeLocation.toLocaleTimeString();
            var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            document.getElementById("date-time").innerHTML = "<strong>Data:</strong> " + currentDate + "<br><strong>Hora:</strong> " + currentTime + "<br><strong>Fuso Horário:</strong> " + timeZone;
        }

        function updateClientInformation() {
            fetch("https://api.ipify.org/?format=json")
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Não foi possível obter o IP do cliente");
                    }
                    return response.json();
                })
                .then(data => {
                    const { ip } = data;
                    return fetch(`https://ipapi.co/${ip}/json`);
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Não foi possível obter a localização do cliente");
                    }
                    return response.json();
                })
                .then(data => {
                    const { city, region, country } = data;
                    const clientInfo = `<strong>IP do Cliente:</strong> ${data.ip}<br><strong>Localização: </strong>${city}, ${region}, ${country}`;
                    document.getElementById("client-info").innerHTML = clientInfo;
                })
                .catch(error => {
                    console.error('Erro ao obter informações do cliente:', error);
                });
        }


        // Atualiza a cada segundo
        setInterval(updateInformation, 1000);

        // Atualiza a cada 50 segundos
        updateClientInformation();
        setInterval(updateClientInformation, 50000);
    </script>
</body>
</html>
