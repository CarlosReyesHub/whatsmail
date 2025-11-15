<?php

use MdhDigital\MdhLicense\Providers\MdhdigitalLicenseServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\EmailConfigServiceProvider::class,
    MdhdigitalLicenseServiceProvider::class
];
