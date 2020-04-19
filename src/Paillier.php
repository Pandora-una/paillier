<?php
namespace PandoraUna\Paillier;

use GMP;

class Paillier
{
    protected $publicKey;
    protected $privateKey;

    public function __construct($keysize = 2048)
    {
        $this->generateKeys($keysize);
    }



    public static function l($a, $n) : GMP
    {
        return gmp_div(gmp_sub($a, 1), $n);
    }

    /**
     * Get the value of publicKey
     */
    public function getPublicKey() : PublicKey
    {
        return $this->publicKey;
    }

    /**
     * Get the value of privateKey
     */
    public function getPrivateKey() : PrivateKey
    {
        return $this->privateKey;
    }

    public static function sum($val1, ...$val) : string
    {
        $sum = gmp_init($val1, 10);
        foreach ($val as $v) {
            $sum = gmp_mul($sum, gmp_init($v, 10));
        }
        return gmp_strval($sum);
    }
    protected function generateKeys($keysize = 2048) : void
    {
        do {
            $p = gmp_nextprime(gmp_random_bits(floor($keysize / 2) + 1));
            $q = gmp_nextprime(gmp_random_bits(floor($keysize / 2)));
            $n = gmp_mul($p, $q);
        } while (($p == $q) || (strlen(gmp_strval($n, 2)) != $keysize));


        $n2 = gmp_pow($n, 2);

        $g = self::getGenerator($n, $n2);
        $lambda = gmp_lcm(gmp_sub($p, 1), gmp_sub($q, 1));

        $mu = gmp_invert(self::l(gmp_powm($g, $lambda, $n2), $n), $n);

        $this->privateKey = new PrivateKey($mu, $lambda, $n);
        $this->publicKey = new PublicKey($n, $g);
    }

    protected function getGenerator($n, $n2)
    {
        $alpha = gmp_random_range(gmp_init(1), gmp_sub($n, 1));
        $beta = gmp_random_range(gmp_init(1), gmp_sub($n, 1));
        return gmp_mod(gmp_mul(gmp_add(gmp_mul($alpha, $n), 1), gmp_powm($beta, $n, $n2)), $n2);
    }
}
