<?php
namespace RabbitmqBackgroundJobs\Consumer;

use RabbitMqModule\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use RabbitMQBackgroundJobs\Job\JobInterface;
use RabbitMQBackgroundJobs\Job\Exception\RejectException;
use RabbitMQBackgroundJobs\Job\Exception\RejectRequeueException;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsumerRouter implements ConsumerInterface
{
	use ServiceLocatorAwareTrait;
	
	public function __construct(ServiceLocatorInterface $sm) {
		$this->setServiceLocator($sm);	
	}
	
	public function execute(AMQPMessage $message) {
		$job = unserialize($message->body);
		
		if (!$job instanceof JobInterface) {
			return ConsumerInterface::MSG_REJECT;
		}
		
		$job->setServiceLocator($this->getServiceLocator());
		
		try {
			$job->execute();
		} catch (RejectRequeueException $e) {
			return ConsumerInterface::MSG_REJECT_REQUEUE;
		} catch (RejectException $e) {
			return ConsumerInterface::MSG_REJECT;
		}
		
		return ConsumerInterface::MSG_ACK;
	}
}