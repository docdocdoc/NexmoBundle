<?php

namespace DocDocDoc\NexmoBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class DocDocDocNexmoExtension extends Extension
{
    /**
     * Loads the Propel configuration.
     *
     * @param array            $configs   An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->getDefinition('doc_doc_doc_nexmo.send_sms')
                ->replaceArgument(1, $config['api_key'])
                ->replaceArgument(2, $config['api_secret'])
                ;

        $container->getDefinition('doc_doc_doc_nexmo.send_mail')
                ->replaceArgument(0, $config['mail_to'])
                ->replaceArgument(1, $config['mail_from'])
                ;

        $container->setAlias('doc_doc_doc_nexmo', $config['provider']);
    }

    /**
     * Returns the recommended alias to use in XML.
     *
     * This alias is also the mandatory prefix to use when using YAML.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'doc_doc_doc_nexmo';
    }
}
