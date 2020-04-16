namespace Phalcon\Container;

abstract class Service
{
    abstract public function getName() -> string;

    abstract public function isShared() -> bool;
}
