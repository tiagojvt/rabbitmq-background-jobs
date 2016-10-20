# rabbitmq-background-jobs
### The RabbitMQModule Background Jobs implementation

# Installation

### Composer

`composer.phar require eclabsit/rabbitmq-background-jobs`

# Usage
### Configuration
Use RabbitMQModule Configuration to set up [Connection, Consumers and Producers](https://github.com/thomasvargiu/RabbitMqModule)
### Publishing Jobs
```php
$this->bgJobsProducer()->publish(serialize(new MailJob()));
```
MailJob MUST implements `RabbitMqBackgroundJobs\Job\JobInterface`

