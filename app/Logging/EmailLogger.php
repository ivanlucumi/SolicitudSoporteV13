<?php

namespace App\Logging;

use Monolog\Logger;

class EmailLogger
{
    /**
     * Crea una instancia de logger Monolog personalizada.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger('email');
        
        $level = Logger::toMonologLevel($config['level'] ?? 'error');
        
        $logger->pushHandler(new EmailHandler($level));

        return $logger;
    }
}
