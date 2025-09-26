
protected $routeMiddleware = [
    ...
    'isAdmin' => \App\Http\Middleware\IsAdmin::class,
];
