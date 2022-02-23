## Biblioteca e configuração do JWT

* composer require tymon/jwt-auth
* php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
* php artisan jwt:secret
* Em config/auth.php alterar o guard de web para api e definir o driver para jwt
* Em config/jwt.php determinar o tempo de inspiração do token jwt
* Em Models/User.php adiconnar a importação e implementação do jwt