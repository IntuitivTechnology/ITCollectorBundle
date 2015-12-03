<?php

namespace ITCollectorBundle\DataCollector;

use Symfony\Component\DependencyInjection\Container;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestCollector extends DataCollector
{
    private $container;
    private $config;

    public function __construct(Container $container) {
        $this->container = $container;
        $this->config    = $this->container->getParameter('it_collector.git');
    }

    public function collect(Request $request, Response $response, \Exception $exception = null) {
        //get git informations
        $fetch = shell_exec("git fetch origin");
        $diff  = shell_exec("git rev-list HEAD..origin/".$this->config['branch']." --count");

        $commit['status']  = true;
        $commit['message'] = "Already up-to-date";
        $commit['count']   = 0;

        if ($diff > 0) {
            $commit['count']   = $diff;
            $commit['status']  = false;
            $commit['message'] = $diff . " commit(s) late.";
        }

        $this->data = array(
            'commit' => $commit,
            'branch' => $this->config['branch'],
            'slack'  => $this->config['slack']
        );
    }

    public function getData() {
        return $this->data;
    }


    public function getName() {
        return 'collector.git';
    }
}