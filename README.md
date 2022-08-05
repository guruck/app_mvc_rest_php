Esse projeto em PHP foi construído sem usar frameworks de mercado, foi concebido uma estrutura não tão trivial, mas sólida para sustentabilidade de links com a camada de segurança para autenticação/autorização e algumas praticas para "esconder" (se assim for necessário) as estruturas internas, deixando publico apenas o que é necessario.

O projeto ainda esta em andamento, então, ainda falta dar uma robustes maior no tratamento de ERROS e possívelmente alguns tratamentos a mais de segurança na aplicação.

## License
As ideias aqui para montar tudo isso foi realmente uma colcha de retalhos, mas acredito que o uso após um tempo fica simples e sem depender de frameworks para controlar o site. 

## Downloads 
Necessário montar uma estrutura basica de servidor de web com banco de dados e suporte a PHP
Apache2
PHP 7+
MySQL

## How-to build
As configurações de PHP, APACHE e MySQL são as basicas, mas como utilizo um apache para varios sites e nesse projeto há um "roteador" que captura as requests é necessario ter um conhecimento um pouco mais aprofundado para montar o ambiente.

## How-to run after build
rodar essa beleza depois de configurado o servidor de aplicação e de subir os dados no banco de dados é só inicializar o apache e o mysql.
ai acessar seu "URL/"... localhost/ ou www.binguin.local se tiver um DNS ou até definir no hosts do seu equipamento.

mais um ponto que preciso fazer é uma documentação tecnica...

repositorio tem a configuração de banco com alguns dados ficticios, qualquer semelhança com a vida real será mera coincidencia, dado que foram gerados aleatoriamente sem qualquer vinculo com a realidade.
caso tenha encontrado algum dado que corresponda a algo conhecido, favor informar que removo a massa de dados e substituo assim que recebido a informação. A massa de dados é em caracter informativo, repito novamente, sem qualquer relação com dados reais.

senhas foram geradas especificamente para essa finalidade apenas e estão expostas, caso queira altere de acordo com sua necessidade.