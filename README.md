#Loteria Api

Este projeto tem como objetivo fornecer dados da loteria da Caixa Econômica Federal através de uma api.

## Instalação
##### Ambiente 
* Apache >= 2.2.16
* PHP >= 5.4

##### *Vagrant 
Com vagrant você pode subir o ambiente com apenas um vagrant up.
Veja mais em [aqui](http://www.vagrantup.com/).

##### Setup
Baixe o vendor via composer. 
```
php composer.phar install
```

Execute os testes.
```
vendor/bin/phpunit
```

## Como funciona 
A api é basicamente composta por duas partes, uma que consome os dados da Caixa e outro que fornece estes dados.

- - -

###Consumer

Esta parte é executada por um script em ```bin/console```.

1. Baixa os dados da loteria através das urls em ```etc/datasource.ini```.
2. Descompacta o arquivo.
3. Consome o arquivo e parseia-o para um xml amigavel em ```var/xml```.

Obs: os algoritmos que parseiam os dados estão em classes que implementam a interface IReader.

###Provider

1. Recebe a requisição através de rotas definidas.
2. Consome o xml com os dados.
3. Entrega os dados para o usuário em json.






