<?php

namespace Crudle\Phash;

class Config
{
    /**
     * @var mixed[]
     */
    private $options;

    /**
     * @var int
     */
    private $algo;

    /**
     * Config constructor
     * @param int $algo
     * @param mixed[] $options
     */
    public function __construct(int $algo = PASSWORD_DEFAULT,  array $options = [])
    {
        $this->algo = $algo;
        $this->options = $options;
    }

    /**
     * @return int
     */
    public function getAlgo(): int
    {
        return $this->algo;
    }

    /**
     * @return mixed[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
