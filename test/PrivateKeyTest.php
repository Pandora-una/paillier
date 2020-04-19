<?php

declare(strict_types=1);

namespace PandoraUnaTest\Paillier;

use PandoraUna\Paillier\PrivateKey;
use PHPUnit\Framework\TestCase;

class PrivateKeyTest extends TestCase
{
    public function testDescryptSimples()
    {
        $mu = gmp_init(4106, 10);
        $lambda = gmp_init(288, 10);
        $n = gmp_init(7081, 10);
        $privKey = new PrivateKey($mu, $lambda, $n);

        $cipher = 4933896;

        $res = $privKey->decrypt($cipher);
        $this->assertEquals(100, $res);
    }
}
