# E-Commerce
 Laravel E-Commerce application
 
# Install
``` Install
composer install
```

# Copy ENV
``` Env
mv .env.example .env
```

# Generate APP Key
``` App Key
php artisan key:generate
```
 
# Migration
``` Migration
php artisan migrate
```

# For create permission routes
``` For create permission routes
php artisan permission:create-permission-routes
```

# User & Role seeder
``` Seeder
php artisan db:seed --class=UserSeeder
```

# Admin Login Info
Default admin login
Username/Email = admin@gmail.com
Password = 12345678

After Login Admin can create Employee & give permission to them. Admin can edit role permissions for default roles/ create new roles. The dafault roles will be Admin,Empoloyee,Customer.
When run the seeder these default roles will be create . Before run seeder please run command for create permissions.

# Employee Login
When admin will create an employee, after that employee can login using email & password & he/she can create products

# Customer
Customer can register through portal .