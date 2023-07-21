<?php

namespace App\Forms\Interfaces;

interface FormInter
{
    public function getConfig(): array;
    public function getMethod(): string;
    public function isSubmit(): bool;
}
