<?php
namespace Lube;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class LoadEnv
 *
 * @package Lube
 */
class LoadEnv
{
    /**
     * @var string 默认环境
     */
    protected $defaultEnv = 'production';
    /**
     * The directory containing the environment file.
     *
     * @var string
     */
    protected $filePath;
    /**
     * The name of the environment file.
     *
     * @var string|null
     */
    protected $fileName;
    /**
     * @var array
     */
    protected static $supportedEnv = ['local', 'test', 'production', 'dev', 'preview'];

    /**
     * Create a new loads environment variables instance.
     *
     * @param string $path
     *
     * @return void
     */
    public function __construct(string $path)
    {
        $this->filePath = $path;
        $this->init();
    }

    /**
     * Setup the environment variables.
     * If no environment file exists, we continue silently.
     */
    public function bootstrap() : void
    {
        try {
            $this->createDotEnv()->safeLoad();
        } catch (InvalidFileException $e) {
            $this->writeErrorAndDie([
                'The environment file is invalid!',
                $e->getMessage(),
            ]);
        }
    }

    /**
     * Create a dot env instance.
     *
     * @return Dotenv
     */
    protected function createDotEnv() : Dotenv
    {
        return Dotenv::create(Env::getRepository(), $this->filePath, $this->fileName);
    }

    protected function init() : void
    {
        $env = get_cfg_var('lubye-env');
        $env = empty($env) ? $this->defaultEnv : $env;
        if (false === in_array($env, static::$supportedEnv)) {
            $this->writeErrorAndDie('unset env variable or unsupport env!');
        }
        $fileName = '.env';
        if ($env) {
            $fileName = sprintf('.env.%s', $env);
        }
        $filePath = sprintf('%s/%s', $this->filePath, $fileName);
        if (!file_exists($filePath)) {
            $this->writeErrorAndDie('not found env config file!'.$filePath);
        }
        $this->fileName = $fileName;
    }

    /**
     * Write the error information to the screen and exit.
     *
     * @param string[]|string $errors
     *
     * @return void
     */
    protected function writeErrorAndDie($errors) : void
    {
        $output = (new ConsoleOutput)->getErrorOutput();
        if (is_array($errors)) {
            foreach ($errors as $errMsg) {
                $output->writeln($errMsg);
            }
            exit(1);
        }
        $output->writeln($errors);
        exit(1);
    }
}
