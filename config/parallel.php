<?php

return [
    'tasks' => [
        ['command' => 'php artisan octane:start'],
        ['command' => 'php artisan queue:work'],
        ['command' => 'php artisan schedule:work'],
    ]
];
