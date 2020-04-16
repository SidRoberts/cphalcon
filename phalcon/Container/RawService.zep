namespace Phalcon\Container;

use Closure;

class RawService extends Service
{
    /**
     * @var string
     */
    protected name;

    /**
     * @var bool
     */
    protected isShared;

    /**
     * @var \Closure
     */
    protected closure;



    public function __construct(string name, bool isShared, <Closure> closure)
    {
        let this->name     = name;
        let this->isShared = isShared;
        let this->closure  = closure;
    }



    public function getName() -> string
    {
        return this->name;
    }

    public function isShared() -> bool
    {
        return this->isShared;
    }

    public function resolve(<Container> container)
    {
        var closure;

        let closure = this->closure;

        return {closure}(container);
    }
}
