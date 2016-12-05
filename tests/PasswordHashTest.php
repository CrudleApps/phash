<?php

namespace Crudle\Phash;

use Crudle\Phash\Exception\HashValidationException;
use Crudle\Phash\Exception\InvalidPasswordException;

class PasswordHashTest extends \PHPUnit_Framework_TestCase
{
    public function test_exception_thrown_if_hash_provided_is_empty()
    {
        $this->expectException(\InvalidArgumentException::class);
        new PasswordHash('  ');
    }

    public function test_exception_thrown_if_password_checked_is_invalid()
    {
        $this->expectException(InvalidPasswordException::class);
        (new PasswordHash('test'))->verify('not valid');
    }

    public function test_exception_thrown_if_password_needs_to_be_rehashed()
    {
        $this->expectException(HashValidationException::class);
        (new PasswordHash('$2y$10$YCFsG6elYca568hBi2pZ0.3LDL5wjgxct1N8w/oLR/jfHsiQwCqTS', new Config(2)))->needsRehash();
    }

    public function test_nothing_happens_if_password_is_valid()
    {
        $hash = new PasswordHash('mypassword');
        (new PasswordHash((string) $hash))->verify('mypassword');
    }

    public function test_password_hash_can_be_cast_to_string()
    {
        $this->assertTrue(is_string((string) new PasswordHash('test')));
    }

    public function test_get_info_returns_array()
    {
        $this->assertArrayHasKey('algo', (new PasswordHash('test'))->getInfo());
        $this->assertArrayHasKey('options', (new PasswordHash('test'))->getInfo());
    }
}
