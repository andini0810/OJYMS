protected $routeMiddleware = [
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    'check.status' => \App\Http\Middleware\CheckUserStatus::class,
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
];
