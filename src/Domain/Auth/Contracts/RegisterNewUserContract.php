<?php

namespace Domain\Auth\Contracts;

use Domain\Auth\DTOs\NewAdminDTO;

interface RegisterNewUserContract
{
    public function __invoke(NewAdminDTO $data);
}
