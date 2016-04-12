<?php
namespace RabbitmqBackgroundJobs\Consumer;

use RabbitMqModule\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use RabbitMQBackgroundJobs\Job\JobInterface;
use RabbitMQBackgroundJobs\Job\Exception\RejectException;
use RabbitMQBackgroundJobs\Job\Exception\RejectRequeueException;

class ConsumerRouter implements ConsumerInterface
{
	public function execute(AMQPMessage $message) {
		$job = unserialize($message->body);
		if (!$job instanceof JobInterface) {
			throw new \Exception();
// 			return ConsumerInterface::MSG_REJECT;
		}
		
		
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