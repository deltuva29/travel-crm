<?php

namespace App\Http\Traits\ContentLoader;

trait WithContentLoader
{
    public bool $loaded = false;

    public function initBackgroundLoader(): void
    {
        $this->loaded = true;
    }
}
