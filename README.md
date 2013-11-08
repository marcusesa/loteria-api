#Loteria Api

Este projeto tem como objetivo fornecer dados da loteria da Caixa Econômica Federal através de uma api.

## Instalação
##### Ambiente 
* Apache >= 2.2.16
* PHP >= 5.4

##### *Vagrant 
Com vagrant você pode subir o ambiente com apenas um vagrant up.
Veja mais em [http://www.vagrantup.com/].

##### Setup
Baixe o vendor via composer. 
```
php composer.phar install
```

Execute os testes.
```
cd test
php ../vendor/bin/phpunit .
```

