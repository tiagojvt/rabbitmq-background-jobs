<?php
use RabbitMqBackgroundJobs\Producer\Plugin\Producer;
use Zend\ServiceManager\ServiceLocatorInterface;
return [
	'factories' => [
		'bgJobsProducer' => function (ServiceLocatorInterface $sm) {
			$plugin = new Producer();
			$plugin->setServiceLocator($sm->serviceLocator);
			return $plugin;
		}
	]
];