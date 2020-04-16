namespace Phalcon\Container;

use ReflectionClass;
use ReflectionMethod;

class Resolver
{
    /**
     * @var Container
     */
    protected container;



    public function __construct(<Container> container)
    {
        let this->container = container;
    }



    public function typehintClass(string className)
    {
        var reflectionClass, reflectionMethod, params;

        let reflectionClass = new ReflectionClass(className);

        if (!reflectionClass->hasMethod("__construct")) {
            return reflectionClass->newInstance();
        }

        let reflectionMethod = reflectionClass->getMethod("__construct");

        let params = this->resolveParams(reflectionMethod);

        return reflectionClass->newInstanceArgs(params);
    }



    public function typehintMethod(classObject, string method)
    {
        var className, reflectionMethod, params;

        let className = get_class(classObject);

        let reflectionMethod = new ReflectionMethod(className, method);

        let params = this->resolveParams(reflectionMethod);

        return call_user_func_array(
            [
                classObject,
                method
            ],
            params
        );
    }



    public function typehintService(<Service> service)
    {
        return this->typehintMethod(service, "resolve");
    }



    protected function resolveParams(<ReflectionMethod> reflectionMethod)
    {
        var reflectionParameters, reflectionParameter, serviceName, paramService;
        array params;

        let reflectionParameters = reflectionMethod->getParameters();

        let params = [];

        for reflectionParameter in reflectionParameters {
            let serviceName = reflectionParameter->getName();

            if serviceName === "container" {
                let paramService = this->container;
            } else {
                let paramService = this->container->get(serviceName);
            }

            let params[] = paramService;
        }

        return params;
    }
}
