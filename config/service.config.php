<?php
use RabbitMqBackgroundJobs\Consumer\ConsumerRouter;
use RabbitMqBackgroundJobs\Producer\Plugin\Producer;
return [
	'factories' => [
		'RabbitmqBackgroundJobsConsumer' => function ($sm) {
			return new ConsumerRouter($sm);
		},
		'bgJobsProducer' => function ($sm) {
			$plugin = new Producer();
			$plugin->setServiceLocator($sm);
			return $plugin->__invoke();
		}
	]	
];