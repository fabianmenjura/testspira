1. Descargar el archivo .env.example, borrar el .example de modo que quede así: .env
2. Al iniciar el proyecto se debe inicializar el npm install y luego npm run watch
3. Entrar al phpmyadmin y crear una nueva base de datos que se llama: db_test_spira
4. Crear la migración con el comando php artisan migrate:fresh --seed
5. Iniciar el servidor: php artisan ser
6. Una vez iniciado el servidor, accedemos a nuestro navegador y pegamos lo siguiente: http://127.0.0.1:8000
7. Desde la base de datos en la tabal 'role_user se puede establecer los roles (Alumno o Administrador)
