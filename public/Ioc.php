<?php

/**
 * @Author: liiuchunlei
 * @Date:   2018-08-03 08:30:24
 * @Last Modified by:   Administrator
 * @Last Modified time: 2018-08-04 08:47:23
 */
//容器类装实例或提供实例的回调函数
class Container {

    //用于装提供实例的回调函数，真正的容器还会装实例等其他内容
    //从而实现单例等高级功能
    protected $bindings = [];

    //绑定接口和生成相应实例的回调函数
    public function bind($abstract, $concrete=null, $shared=false) {

        //如果提供的参数不是回调函数，则产生默认的回调函数
        if(!$concrete instanceof Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
        }

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    //默认生成实例的回调函数
    protected function getClosure($abstract, $concrete) {

        return function($c) use ($abstract, $concrete) {
            $method = ($abstract == $concrete) ? 'build' : 'make';
            return $c->$method($concrete);
        };

    }

    public function make($abstract) {
        $concrete = $this->getConcrete($abstract);

        if($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete);
        } else {
            $object = $this->make($concrete);
        }

        return $object;
    }

    protected function isBuildable($concrete, $abstract) {
        return $concrete === $abstract || $concrete instanceof Closure;
    }

    //获取绑定的回调函数
    protected function getConcrete($abstract) {
        if(!isset($this->bindings[$abstract])) {
            return $abstract;
        }

        return $this->bindings[$abstract]['concrete'];
    }

    //实例化对象
    public function build($concrete) {

        if($concrete instanceof Closure) {
            return $concrete($this);
        }

        $reflector = new ReflectionClass($concrete);
        if(!$reflector->isInstantiable()) {
            echo $message = "Target [$concrete] is not instantiable";
        }

        $constructor = $reflector->getConstructor();
        if(is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();
        $instances = $this->getDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);
    }

    //解决通过反射机制实例化对象时的依赖
    protected function getDependencies($parameters) {
        $dependencies = [];
        foreach($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if(is_null($dependency)) {
                $dependencies[] = NULL;
            } else {
                $dependencies[] = $this->resolveClass($parameter);
            }
        }

        return (array)$dependencies;
    }

    protected function resolveClass(ReflectionParameter $parameter) {
        return $this->make($parameter->getClass()->name);
    }

}

$app = new Container();
$app->bind("Pay", "Alipay");//Pay 为接口， Alipay 是 class Alipay
$app->bind("tryToPayMyBill", "PayBill"); //tryToPayMyBill可以当做是Class PayBill 的服务别名

//通过字符解析，或得到了Class PayBill 的实例
$paybill = $app->make("tryToPayMyBill"); 

//因为之前已经把Pay 接口绑定为了 Alipay，所以调用pay 方法的话会显示 'pay bill by alipay '
$paybill->payMyBill(); 