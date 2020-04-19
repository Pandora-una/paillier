<?php

declare(strict_types=1);

namespace PandoraUnaTest\Paillier;

use PandoraUna\Paillier\PublicKey;
use PHPUnit\Framework\TestCase;

class PublicKeyTest extends TestCase
{
    use \phpmock\phpunit\PHPMock;

    protected $randomMock;

    public function setUp() : void
    {
    }

    /**
     * @runInSeparateProcess
     */
    public function testCryptSimples()
    {
        $exec = $this->getFunctionMock("PandoraUna\Paillier", "gmp_random_range");
        $exec->expects($this->once())->willReturn(1931);

        $n = gmp_init(7081);
        $g = gmp_init(7082);
        $m = 100;
        $crypt = new PublicKey($n, $g);

        $criRes = $crypt->encrypt($m);

        $this->assertEquals(4933896, $criRes);
    }
}
