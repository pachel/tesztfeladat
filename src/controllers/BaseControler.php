<?php

namespace Teszt\Controllers;

use Pachel\EasyFrameWork\DB\mySql;

class BaseControler
{
    /**
     * @var MyBase $app
     */
    protected $app;
    public function __construct($app)
    {
        $this->app = $app;
    }
}
/**
 * @method void reroute(string $path);
 * @method mixed env(string $name, mixed $value);
 * @method void send_error(int $code);
 * @method void setResultType(int $result);
 * @property  mySql DB;
 * @property  array POST;
 * @property  array GET;
 * @property  array SERVER;
 */
abstract class MyBase
{
}