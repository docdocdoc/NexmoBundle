# DocDocDocNexmoBundle

Allow you to send sms using nexmo

## Installation

Run

````
php composer.phar require docdocdoc/nexmo-bundle dev-master
````

Add in your AppKernel :

````
new DocDocDoc\NexmoBundle\DocDocDocNexmoBundle(),
````

## Configuration

in config.yml :

````
doc_doc_doc_nexmo:
    api_key: YOUR_API_KEY
    api_secret: YOUR_API_SECRET
````

### Usage

````
$message = new \DocDocDoc\NexmoBundle\Message\Simple("SenderId", "phone", "content of your sms");
$nexmoResponse = $this->container->get('doc_doc_doc_nexmo')->send($message);
````

## Providers

For tests you can receive your sms in mail or just not send it :

in config.yml :

*Send by mail*

````
doc_doc_doc_nexmo:
    provider: doc_doc_doc_nexmo.send_mail
    mail_to: email@allsmshere.com
    mail_from: [default: no-reply@nexmobundle.com]
````

*Just trash it*

````
doc_doc_doc_nexmo:
    provider: doc_doc_doc_nexmo.noop
````