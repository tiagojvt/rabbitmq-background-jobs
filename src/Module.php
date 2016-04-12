<?php
/**
 * RabbitMQ Background Jobs 
 *
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace RabbitMqBackgroundJobs;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * RabbitMQ Background Jobs 
 *
 * @author Tiago da Hora <ti@ecglobalsolutions.com>
 */
class Module implements
    AutoloaderProviderInterface,
    BootstrapListenerInterface,
    ConfigProviderInterface,
    ControllerPluginProviderInterface,
    ViewHelperProviderInterface,
    ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $event)
    {
        /* @var $app \Zend\Mvc\ApplicationInterface */
        $app            = $event->getTarget();
    }

    /**
     * {@inheritDoc}
     */
    public function getViewHelperConfig()
    {
        return include __DIR__ . '/../config/helper.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getControllerPluginConfig()
    {
        return include __DIR__ . '/../config/plugin.config.php';
    }
    
    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
    	return include __DIR__ . '/../config/service.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
