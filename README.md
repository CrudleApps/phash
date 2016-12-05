## Overview

`Crudle\Phash` provides a convenient wrapper class for the native `password_hash` functions. 
The primary benefit of this is the ability to remain object oriented.

## Install

`composer require crudle/phash`

## Usage

The simplest usage of `PasswordHash` is indeed that; simple!

```php
$hash = new PasswordHash('mypassword');
```

The string `'mypassword'` will be hashed and stored in the object. If you provide 
an already hashed string, the value will just be stored and no hashing will occur.

```php
// This works too! This is the hash that was generated from 'mypassword'
$hash = new PasswordHash('$2y$10$F4L/hmnkYOSvGqU0tI4DuuszxFarOedNQA1Ws.ZHwKcRLmUlWaDTW');
```

Once you've created the PasswordHash object (either from a raw password or a hashed string), 
you can perform all the native operations on it:

```php
$hash = new PasswordHash('$2y$10$F4L/hmnkYOSvGqU0tI4DuuszxFarOedNQA1Ws.ZHwKcRLmUlWaDTW');
$hash->verify('mypassword'); // Throws an InvalidPasswordException if validation fails
```

#### Retrieving the hash

Hashing a password is pretty useless unless we can store it for later validation.
Thankfully, we can just cast the object to a string and we'll get our hash.

```php
$passwordHash = new PasswordHash('mypassword');
$hash = (string) $passwordHash;
```

#### Extra config

By default, the package uses the `PASSWORD_DEFAULT` hashing algorithm. If you 
want to change that, or any hashing options, you can provide a custom `Config` object 
to the `PasswordHash` constructor.

```php
$config = new Config(PASSWORD_BCRYPT, ['cost' => 12]);
$hash = new PasswordHash('mypassword', $config);
```

#### Available methods

```php
$hash->verify('mypassword'); // throws InvalidPasswordException
$hash->needsRehash(); // throws HashValidationException
$hash->getInfo(); // returns an array of config info
$hash->__toString(); // returns the hash string
```