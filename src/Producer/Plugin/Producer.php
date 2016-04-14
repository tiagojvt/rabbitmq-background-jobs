<?php

namespace RabbitMqBackgroundJobs\Producer\Plugin;

use Core\Library\Community\CommunityBootstrapAwareInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
class Producer extends AbstractPlugin implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    public function __invoke()
    { 
    	$config = $this->getServiceLocator()->get('Configuration');
    	$options = $config['rabbitmq'];
    	
    	if (!isset($options['producer'])) {
    		throw new \Exception('Miss configuration');
    	}
    	
    	$producers = array_keys($options['producer']);
        return $this->getServiceLocator()->get('rabbitmq.producer.' . $producers[0]);
    }
}