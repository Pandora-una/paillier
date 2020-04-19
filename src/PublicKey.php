<?php
namespace PandoraUna\Paillier;

use GMP;

class PublicKey
{
    protected $n;
    protected $g;


    public function __construct(GMP $n, GMP $g)
    {
        $this->n = $n;
        $this->g = $g;
    }

    public function toArray() : array
    {
        return [
            'n' => base64_encode(gmp_strval($this->n)),
            'g' => base64_encode(gmp_strval($this->g)),
        ];
    }

    public static function fromArray(array $array)
    {
        return new self(
            gmp_init(base64_decode($array['n']), 10),
            gmp_init(base64_decode($array['g']), 10),
        );
    }


    public function encrypt(int $value) : string
    {
        $value = gmp_init($value, 10);
        $r = gmp_random_range(GMP_init(1), gmp_sub($this->n, 1));
        $n2 = gmp_pow($this->n, 2);

        $cript = gmp_mod(gmp_mul(gmp_powm($this->g, $value, $n2), gmp_powm($r, $this->n, $n2)), $n2);

        return gmp_strval($cript, 10);
    }

    /**
     * Get the value of n
     */
    public function getN() : GMP
    {
        return $this->n;
    }

    /**
     * Get the value of g
     */
    public function getG() : GMP
    {
        return $this->g;
    }
}
