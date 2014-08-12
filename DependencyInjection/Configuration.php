<?php

namespace DocDocDoc\NexmoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('doc_doc_doc_nexmo');

        $rootNode
            ->children()
                ->scalarNode('provider')->defaultValue('doc_doc_doc_nexmo.send_sms')->end()
                ->scalarNode('api_key')->defaultNull()->end()
                ->scalarNode('api_secret')->defaultNull()->end()
                ->scalarNode('mail_to')->defaultNull()->end()
                ->scalarNode('mail_from')->defaultValue('no-reply@nexmobundle.com')->end()
            ->end()
            ;

        return $treeBuilder;
    }
}
