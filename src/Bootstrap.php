<?php

namespace Lube;

/**
 * Class Bootstrap
 *
 * @package Lube
 */
class Bootstrap
{
    /**
     * 运行
     *
     * @param string $generateService
     * @param string $output
     * @param array $params
     * @param string $dataSource
     */
    public function run(string $generateService, string $output, array $params, string $dataSource = '')
    {
        if (false === class_exists($generateService)) {
            exit(sprintf('Sorry,not found the generate service(%s)!', $generateService));
        }
        $generate_plan = new $generateService(...$params);
        if (!$generate_plan instanceof GeneratePlan) {
            exit(sprintf('Sorry,not found the generate plan instance(%s)!', $generateService));
        }
        $generate_plan->doPlan($output);
    }
}