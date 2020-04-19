<?php

declare(strict_types=1);

namespace PandoraUnaTest\Paillier;

use PandoraUna\Paillier\Paillier;
use PandoraUna\Paillier\PrivateKey;
use PandoraUna\Paillier\PublicKey;
use PHPUnit\Framework\TestCase;

class PaillierTest extends TestCase
{
    public function testGenerateKeys()
    {
        $paillier = new Paillier();

        $this->assertInstanceOf(PrivateKey::class, $paillier->getPrivateKey());

        $this->assertInstanceOf(PublicKey::class, $paillier->getPublicKey());
    }


    public function testComplete()
    {
        $paillier = new Paillier();

        $msg = 123456781;

        $encript = $paillier->getPublicKey()->encrypt($msg);

        $msgDecript = $paillier->getPrivateKey()->decrypt($encript);

        $this->assertEquals($msg, $msgDecript);
    }

    public function testSum()
    {
        $paillier = new Paillier();
        $v1 = 10;
        $e1 = $paillier->getPublicKey()->encrypt($v1);

        $v2 = 15;
        $e2 = $paillier->getPublicKey()->encrypt($v2);

        $res = Paillier::sum($e1, $e2);

        $dec = $paillier->getPrivateKey()->decrypt($res);

        $this->assertEquals($v1+$v2, $dec);
    }

    public function testSumMult()
    {
        $paillier = new Paillier();
        $v1 = 10;
        $e1 = $paillier->getPublicKey()->encrypt($v1);

        $v2 = 15;
        $e2 = $paillier->getPublicKey()->encrypt($v2);

        $v3 = 3;
        $e3 = $paillier->getPublicKey()->encrypt($v3);

        $res = Paillier::sum($e1, $e2, $e3);

        $dec = $paillier->getPrivateKey()->decrypt($res);

        $this->assertEquals($v1+$v2+$v3, $dec);
    }
}
