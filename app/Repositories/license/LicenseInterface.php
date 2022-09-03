<?php

namespace App\Repositories\license;

use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;

interface LicenseInterface
{
    /**
     * @param string $social_type
     * @param string $domain
     * @param string $product_type
     * @return string|null
     */
    public function checkLicense(string $social_type, string $domain,string $product_type) : ?string;
}
