<?php
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
	Doctrine\Common\Cache\ArrayCache,
	Doctrine\Common\ClassLoader,
    Doctrine\DBAL\Logging\EchoSQLLogger;
 
define('DEBUGGING', FALSE);
 
class Doctrine {
 
    public $em = null;
 
    public function __construct()
    {
        // load database configuration and custom config from CodeIgniter
        require APPPATH . 'config/database.php';
 
        // Set up class loading.
        require_once APPPATH . 'libraries/Doctrine/Common/ClassLoader.php';
 
        $doctrineClassLoader = new \Doctrine\Common\ClassLoader('Doctrine', APPPATH . 'libraries');
        $doctrineClassLoader->register();
 
        $entitiesClassLoader = new \Doctrine\Common\ClassLoader('entities', APPPATH . 'models');
        $entitiesClassLoader->register();
 
        $proxiesClassLoader = new \Doctrine\Common\ClassLoader('proxies', APPPATH . 'models');
        $proxiesClassLoader->register();
 
        $symfonyClassLoader = new \Doctrine\Common\ClassLoader('Symfony', APPPATH . 'libraries/Doctrine');
        $symfonyClassLoader->register();

		$repositoriesClassLoader = new \Doctrine\Common\ClassLoader('repositories', APPPATH . 'models');
		$repositoriesClassLoader->register();  

        // Choose caching method based on application mode (ENVIRONMENT is defined in /index.php)
        if (ENVIRONMENT == 'development') {
            $cache = new \Doctrine\Common\Cache\ArrayCache;
        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache;
            //$cache = new \Doctrine\Common\Cache\XcacheCache;
        }
 
        // Set some configuration options
        $config = new Configuration;
 
        // Metadata driver
        $driverImpl = $driver = new \Doctrine\ORM\Mapping\Driver\XmlDriver(APPPATH . 'models/mapping');
        $config->setMetadataDriverImpl($driverImpl);
 
        // Caching
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
		$config->setResultCacheImpl($cache);
 
        // Proxies
        $config->setProxyDir(APPPATH . 'models/proxies');
        $config->setProxyNamespace('DoctrineProxies');
 	
        if (ENVIRONMENT == 'development') {
            $config->setAutoGenerateProxyClasses(FALSE);
        } else {
            $config->setAutoGenerateProxyClasses(FALSE);
        }
 
        // SQL query logger
        if (DEBUGGING)
        {
            $logger = new \Doctrine\DBAL\Logging\EchoSQLLogger;
            $config->setSQLLogger($logger);
        }
 
        // Database connection information
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' => $db['default']['username'],
            'password' => $db['default']['password'],
            'host' => $db['default']['hostname'],
            'dbname' => $db['default']['database']
        );
 
        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}
