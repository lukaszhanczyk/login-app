# login-app
## Instalation

1. Clone repository
2. Open project, move to build folder and run docker

   ```bash
   cd build
   docker-compose build
   docker-compose up
   ```
3. After the containers start correctly, open the php console in a new console

   ```bash
   cd build
   docker exec -it --user www-data php-login-app bash
   ```

4. Run composer install in bash

   ```bash
   composer install
   ```

5. Update database schema

   ```bash
   php bin/console doctrine:migration:migrate
   ```


The application is running on port 8083

   ```bash
   http://127.0.0.1:8083/
   ```