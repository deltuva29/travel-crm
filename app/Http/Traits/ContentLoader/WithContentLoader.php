<?php

namespace App\Http\Traits\ContentLoader;

trait WithContentLoader
{
    public bool $loaded = true;

    public function initBackgroundLoader(): void
    {
        $this->loaded = false;
    }
}
