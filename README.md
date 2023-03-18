# Crypto Tracker

O Crypto Tracker é um site desenvolvido em Laravel e Vue.js que exibe os valores atuais em real e dólar de duas criptomoedas chamadas de Draco e Hydra. Além disso, o site tem a funcionalidade de gravar os valores dessas moedas de 30 em 30 minutos em um banco de dados para gerar um gráfico.

## Funcionalidades

- Exibição dos valores atuais em real e dólar de Draco e Hydra
- Gravação dos valores das moedas de 30 em 30 minutos em um banco de dados
- Geração de gráfico com os valores das moedas ao longo do tempo

## Tecnologias Utilizadas

- Laravel
- Vue.js
- Banco de dados (a definir)

## Instalação

1. Clone o repositório
2. Instale as dependências do Laravel e do Vue.js
3. Configure o banco de dados
4. Execute as migrations para criar as tabelas no banco de dados
5. Inicie o servidor do Laravel e do Vue.js

## Como Usar

1. Acesse o site através do seu navegador
2. Visualize os valores atuais de Draco e Hydra
3. A cada 30 minutos, os valores das moedas serão gravados no banco de dados
4. Para visualizar o gráfico com os valores das moedas ao longo do tempo, acesse a página "Gráfico"

## Contribuição

Este projeto é aberto para contribuições. Se você encontrar algum problema ou tiver sugestões de melhorias, sinta-se à vontade para criar uma issue ou enviar um pull request.

## Licença

Este projeto está licenciado sob a licença MIT. Consulte o arquivo LICENSE para obter mais informações.

##Run
-npm run dev
-php artisan serve
-php artisan schedule:work
