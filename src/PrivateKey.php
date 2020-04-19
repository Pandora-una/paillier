<?php
namespace PandoraUna\Paillier;

use GMP;

class PrivateKey
{
    protected $mu;
    protected $lambda;
    protected $n;

    public function __construct(GMP $mu, GMP $lambda, GMP $n)
    {
        $this->mu = $mu;
        $this->lambda = $lambda;
        $this->n = $n;
    }

    public function toArray() : array
    {
        return [
            'mu' => base64_encode(gmp_strval($this->mu)),
            'lambda' => base64_encode(gmp_strval($this->lambda)),
            'n' => base64_encode(gmp_strval($this->n)),
        ];
    }

    public static function fromArray(array $array)
    {
        return new self(
            gmp_init(base64_decode($array['mu']), 10),
            gmp_init(base64_decode($array['lambda']), 10),
            gmp_init(base64_decode($array['n']), 10)
        );
    }

    public function decrypt($cipher) : int
    {
        $cipher = gmp_init($cipher, 10);
        $n2 = gmp_pow($this->n, 2);

        $gmpRes = GMP_mod(GMP_mul(Paillier::l(gmp_powm($cipher, $this->lambda, $n2), $this->n), $this->mu), $this->n);

        return (int) gmp_strval($gmpRes);
    }





    /**
     * Get the value of mu
     */
    public function getMu() : GMP
    {
        return $this->mu;
    }

    /**
     * Get the value of lambda
     */
    public function getLambda() : GMP
    {
        return $this->lambda;
    }

    /**
     * Get the value of n
     */
    public function getN() : GMP
    {
        return $this->n;
    }
}
