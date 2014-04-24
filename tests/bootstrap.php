<?php
// Locate and include the composer autoloader
$sanity = 5;
$dir = realpath(__DIR__);
do {
    $dir = dirname($dir);
    $autoload = $dir.'/vendor/autoload.php';
} while ($sanity-- && !file_exists($autoload));
if ( ! @include $autoload )
{
    die(<<<'EOT'
You must set up the project dependencies, run the following commands:
wget http://getcomposer.org/composer.phar
php composer.phar install --dev

You can then run tests by calling:

phpunit

EOT
       );
}

function ezc_autoload( $className )
{
    if ( strpos( $className, '_' ) === false )
    {
        ezcBase::autoload( $className );
    }
}

spl_autoload_register( 'ezc_autoload' );

ezcBase::setWorkingDirectory(__DIR__);
