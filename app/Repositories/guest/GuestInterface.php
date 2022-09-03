<?php

namespace App\Repositories\guest;

use phpDocumentor\Reflection\Types\Boolean;

interface GuestInterface
{
    public function get_client_info(Bool $update = false);
}
