<?php

namespace Crudle\Phash;

use Crudle\Phash\Exception\HashValidationException;
use Crudle\Phash\Exception\InvalidPasswordException;

class PasswordHash
{
    /**
     * @var string
     */
    private $hash;

    /**
     * @var Config
     */
    private $config;

    /**
     * PasswordHash constructor
     * @param string $password
     * @param Config|null $config
     * @throws \InvalidArgumentException
     */
    public function __construct(string $password, Config $config = null)
    {
        $this->config = $config ?? new Config;

        if (empty(trim($password))) {
            throw new \InvalidArgumentException('Password or hash provided is empty');
        }

        if (!password_get_info($password)['algo']) {
            $this->hash = password_hash($password, $this->config->getAlgo(), $this->config->getOptions());
            return;
        }

        $this->hash = $password;
    }

    /**
     * @param string $password
     * @return void
     * @throws InvalidPasswordException
     */
    public function verify(string $password)
    {
        if (!password_verify($password, $this->hash)) {
            throw new InvalidPasswordException('The password provided does not match the given hash');
        }
    }

    /**
     * @return void
     * @throws HashValidationException
     */
    public function needsRehash()
    {
        if (password_needs_rehash($this->hash, $this->config->getAlgo(), $this->config->getOptions())) {
            throw new HashValidationException('The password hash needs to be rehashed');
        }
    }

    /**
     * @return mixed[]
     */
    public function getInfo(): array
    {
        return password_get_info($this->hash);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->hash;
    }
}
