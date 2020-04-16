namespace Phalcon\Container;

use Phalcon\Container\Exception\ServiceNotFoundException;
use ReflectionClass;
use ReflectionMethod;

class Container
{
    /**
     * @var array
     */
    protected services = [];

    /**
     * @var array
     */
    protected sharedServices = [];

    /**
     * @var Resolver
     */
    protected resolver;



    public function __construct()
    {
        let this->resolver = new Resolver(this);
    }



    public function getResolver() -> <Resolver>
    {
        return this->resolver;
    }



    public function get(string name)
    {
        var service, resolvedService;

        if isset this->sharedServices[name] {
            return this->sharedServices[name];
        }

        if !isset this->services[name] {
            throw new ServiceNotFoundException(name);
        }



        let service = this->services[name];

        let resolvedService = this->resolver->typehintService(service);

        if service->isShared() {
            let this->sharedServices[name] = resolvedService;
        }

        return resolvedService;
    }

    public function set(string name, var value)
    {
        let this->sharedServices[name] = value;
    }



    public function add(<Service> service) -> <Container>
    {
        var name;

        let name = service->getName();

        let this->services[name] = service;

        return this;
    }



    public function has(string name) -> bool
    {
        return isset this->services[name] || isset this->sharedServices[name];
    }
}
