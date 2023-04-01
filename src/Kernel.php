<?php

namespace App;

use App\DesignPatterns\Observer\Display\TemperatureDisplayInterface;
use App\DesignPatterns\Observer\WeatherStation\TemperatureTransmissionService;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel implements CompilerPassInterface
{
    use MicroKernelTrait;

    protected function build(ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(TemperatureDisplayInterface::class)
            ->addTag('temperature.display');
        //to check the displays (i.e observers) has the tags, run the command below in the terminal
        //./bin/console debug:container phonedisplay
    }

    public function process(ContainerBuilder $container): void
    {
        $definition = $container->findDefinition(TemperatureTransmissionService::class);
        $taggedObservers = $container->findTaggedServiceIds('temperature.display');
        foreach ($taggedObservers as $id => $tags) {
            $definition->addMethodCall('subscribe', [new Reference($id)]);
        }
    }
}
