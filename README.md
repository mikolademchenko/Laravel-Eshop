# E-commerce website in  Laravel 11

### Demo page:https://e-comm.mk

## Features :

====== FRONT-END =======

- Responsive Layout
- Elastic Search
- Shopping Cart, Wishlist, Product Reviews
- Coupons & Discounts
- Product attributes: cost price, promotion price, stock, size...
- Blog: category, tag, content, web page
- Module/Extension: Shipping, payment, discount, ...
- Upload manager: banner, images,..
- Bundles module
- SEO support: customer URL
- Newsletter management
- Contact forms with the real-time notification (Laravel Pusher)
- Related Products, Recommendations for you in our categories
- A Product search form
- Laravel Socialite implement(Facebook, Google & twitter) & Customer login
- Product Share and follow from different social platform...
- Payment integration(Paypal, Stripe, Casys)
- Multi-level comment system many more......

======= ADMIN =======

- Admin roles, permission
- Product manager
- Media manager using unisharp laravel file manager
- Banner manager
- Bundles manager
- Order management
- Category management
- Brand management
- Shipping Management
- Review Management
- Blog, Category & Tag manager
- User Management
- Role
- Permission
- Coupon Management
- System config: email setting, info shop, maintain status,...
- Line Chart & Pie chart ...
- Generate order in pdf form...
- Real time message & notification
- Translation manager
- Impersonate
- Activity log
- IP blocker
- Profile Settings Many more....

======= USER DASHBOARD =======

- Order management
- Review Management
- Comment Management
- Profile Settings

======= SECURITY =======

- Google 2FA

======= Caching =======

- Redis

======= OPEN AI =======

- Integrate open ai for product description generation and many more...

## Set up :

1. Clone the repo and cd into it
2. composer install
3. Rename or copy .env.example file to .env
4. php artisan key:generate
5. Set your database credentials in your .env file
6. Set your Braintree credentials in your .env file if you want to use PayPal
7. Run php artisan migrate:fresh --seed
8. npm install
9. npm run watch
10. run command[laravel file manager]:- php artisan storage:link
11. Edit .env file :- remove APP_URL
12. php artisan serve or use virtual host
13. Visit localhost:8000 in your browser
14. Visit /admin if you want to access the admin panel. Admin Email/Password: superadmin@mail.com/password. User
    Email/Password:
    client@mail.com/password

### Requirements installation and configuration for docker

* **Docker**
* **In project root run**: docker-compose up -d.
* **Install laravel packages**: composer install
* **ENV**: rename DB_HOST=127.0.0.1 to DB_HOST=mysql
* **Container ssh**: docker-compose exec app sh
* **Run migrations**: php artisan:migrate:fresh --seed.

### Enable ElasticSearch:

* php artisan scout:import Modules\\Product\\Models\\Product,
* php artisan scout:import Modules\\Brand\\Models\\Brand,
* php artisan scout:import Modules\\Category\\Models\\Category

### Management

- **User create**: `php artisan user:create`

### Enabling Multi-Tenant Functionality

To enable and configure the multi-tenant functionality in your application, follow these steps:

1. **Add Multi-Tenant Configuration**:

   Update your `.env` file to include the multi-tenant configuration:

   ```env
   MULTI_TENANT_ENABLED=true
   
   OWNER_DB_CONNECTION=owner
   OWNER_DB_HOST=127.0.0.1
   OWNER_DB_PORT=3306
   OWNER_DB_DATABASE=homestead
   OWNER_DB_USERNAME=homestead
   OWNER_DB_PASSWORD=secret

2. **Init Multi-Tenant database**:

   ```env
   php artisan tenant:init
3. **Creating a Tenant**:

   You will be prompted to provide the tenant's name, domain, and database name.
   ```env
   php artisan tenant:create
4. **Migrate Tenant**:

   The command tenants:migrate has optional arguments (tenant) and options (--fresh and --seed).
   Single Tenant Migration: If a tenant ID is provided (tenant argument), it finds the tenant and calls the migrate
   method for that specific tenant.
   All Tenants Migration: If no tenant ID is provided, it fetches all tenants and calls the migrate method for each
   one using each, also it accepts --fresh and --seed options.
   ```env
   php artisan tenant:migrate

### Enabling OpenAI Functionality

To enable and configure the OpenAI functionality in your application, follow these steps:

1. **Add OpenAI Configuration**:

   Update your `.env` file to include the OpenAI configuration:

   ```env
   OPENAI_API_KEY=YOUR_API_KEY
   ENABLE_OPENAI=true

Generate description button will SHOW in product CRUD page.

<p style="text-align:center">Thank You so much for your time !!!</p>

