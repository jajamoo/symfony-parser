<?php

// Used by PHPStan for analysis

declare(strict_types=1);

use App\Kernel;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

(new Dotenv())->bootEnv(realpath(__DIR__.'/../.env') ?: throw new RuntimeException("Can't resolve path"));
$kernel = new Kernel((string) $_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

/** @var ManagerRegistry $orm */
$orm = $kernel->getContainer()->get('doctrine');

return $orm->getManager();
