<?php
namespace RabbitMqBackgroundJobs\Job;

use Zend\ServiceManager\ServiceLocatorInterface;

interface JobInterface
{
	public function setServiceLocator(ServiceLocatorInterface $sm);
	public function execute();
}