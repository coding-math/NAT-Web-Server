# Configuração do Ambiente PHP com Apache no Linux

Este guia fornece instruções passo a passo para configurar um ambiente PHP com Apache no seu sistema Linux e executar seu projeto PHP localmente.

### Pré-requisitos
- **Linux**: Certifique-se de estar usando um sistema Linux, como Ubuntu, Debian, etc.
- **PHP**: Tenha o PHP instalado no seu sistema. Caso não tenha, você pode instalar usando o seguinte comando:
  ```
  sudo apt install php
  ```

### Instalação e Configuração do Apache

1. **Instalar o Apache**:
   ```
   sudo apt update
   sudo apt install apache2
   ```

2. **Iniciar o Apache**:
   ```
   sudo systemctl start apache2
   ```

3. **Habilitar na Inicialização**:
   ```
   sudo systemctl enable apache2
   ```

### Configuração do Projeto PHP

1. **Clone o Projeto**:
   ```
   git clone https://github.com/garpereira/Computer-Networks.git
   ```

2. **Copie seu Projeto para o Diretório do Apache** (geralmente em `/var/www/html/`):
   ```
   sudo cp -r NATWebServer /var/www/html/
   ```

3. **Ajuste as Permissões** (para garantir que o Apache possa acessar os arquivos):
   ```
   sudo chown -R www-data:www-data /var/www/html/NATWebServer
   sudo chmod -R 755 /var/www/html/NATWebServer
   ```

### Acesso ao Seu Projeto

Agora, seu projeto PHP está configurado para rodar localmente. Você pode acessá-lo em seu navegador web usando o seguinte URL:

```
http://localhost/NATWebServer/index.php
```
