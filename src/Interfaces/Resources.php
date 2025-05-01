<?php

declare(strict_types=1);

namespace App\PruebaPracticaStartup\Interfaces;

interface Resources {
    public function showType($id): string;

    public function showName($id): string;
}

