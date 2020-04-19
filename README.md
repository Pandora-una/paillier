# Criptografia de Paillier
Criptografia de Paillier

[![Build Status](https://secure.travis-ci.org/Pandora-una/paillier.png?branch=master)](http://travis-ci.org/Pandora-una/paillier)
[![Latest Stable Version](https://poser.pugx.org/pandora-una/paillier/v/stable)](https://packagist.org/packages/pandora-una/paillier) 
[![Latest Unstable Version](https://poser.pugx.org/pandora-una/paillier/v/unstable)](https://packagist.org/packages/pandora-una/paillier) 
[![Total Downloads](https://poser.pugx.org/pandora-una/paillier/downloads)](https://packagist.org/packages/pandora-una/paillier) 
[![Code Climate](https://codeclimate.com/github/Pandora-una/paillier/badges/gpa.svg)](https://codeclimate.com/github/Pandora-una/paillier)
[![Test Coverage](https://codeclimate.com/github/Pandora-una/paillier/badges/coverage.svg)](https://codeclimate.com/github/Pandora-una/paillier/coverage)


## Instalação

```shell
$ composer require pandora-una/paillier
```

## Uso

### Gerar Chaves
```php
$paillier = new Paillier();

//chave privada
$paillier->getPrivateKey();

//chave publica
$paillier->getPublicKey());

```

### Criptografar
```php
$paillier = new Paillier();

$msg = 123456781;

$encript = $paillier->getPublicKey()->encrypt($msg);

$msgDecript = $paillier->getPrivateKey()->decrypt($encript);

```

### Soma
```php

$paillier = new Paillier();
$v1 = 10;
$e1 = $paillier->getPublicKey()->encrypt($v1);
        
v2 = 15;
$e2 = $paillier->getPublicKey()->encrypt($v2);

$v3 = 3;
$e3 = $paillier->getPublicKey()->encrypt($v3);

$res = Paillier::sum($e1,$e2,$e3);

$dec = $paillier->getPrivateKey()->decrypt($res);

echo $dec; //= 28
```



