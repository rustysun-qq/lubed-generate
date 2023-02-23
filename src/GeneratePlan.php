<?php

namespace Lube;

use Lube\Utils\Path;

/**
 * GeneratePlan interface
 */
interface GeneratePlan
{
    public function __construct(string $data_source_name);

    public function doPlan(string $outputDir = '');
}