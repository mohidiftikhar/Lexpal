<?php

namespace App\Repositories\language;

interface LanguageInterface
{
    public function getAllLanguages() : array;

    public function searchDictionary(array $request);
}
