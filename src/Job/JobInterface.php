<?php
namespace RabbitMqBackgroundJobs\Job;

interface JobInterface
{
	public function execute();
}