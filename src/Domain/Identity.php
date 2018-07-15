<?php

namespace App\Domain;

use Ramsey\Uuid\Uuid;

class Identity
{
    /**
     * @var string
     */
    protected $identity;

    public function __construct()
    {
        $this->identity = (string) Uuid::uuid4();
    }

    /**
     * @param string $identity
     * @return Identity
     * @throws \Exception
     */
    public static function createFromValue($identity)
    {
        if (!Uuid::isValid((string) $identity)) {
            throw new \Exception('Identity is not a valid unique identifier');
        }

        $instance = new static();
        $instance->identity = (string) $identity;

        return $instance;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->identity;
    }

    /**
     * @param  Identity $identity
     * @return bool
     */
    public function equals(Identity $identity)
    {
        return $this->identity === $identity->getValue();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}