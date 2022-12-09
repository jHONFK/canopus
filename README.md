# canopus

Go to "backend-cnp" path

ADMIN LOGIN:
email: admin@admin.com
senha: admin

1 - Install composer \
composer install

2 - Generate JWT \
php artisan jwt:generate

3 - Check .env \
DB_HOST, DB_DATABASE, DB_PASSWORD, DB_USERNAME

3 - Migrate DB \
php artisan migrate

5 - Seed admin user \
php artisan db:seed

4 - Start server \
php artisan serve



6 - API Acess \
http://localhost:8000/api/

Go to "frontend-cnp" path

1 - Install dependencies \
npm install

2 - Run server \
npm run serve

3 - Acess \
http://localhost:8080/
