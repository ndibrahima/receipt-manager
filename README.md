# Recipe-manager
<h1 align="center">Welcome to Recipe Manager 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-0.1.0-blue.svg?cacheSeconds=2592000" />
</p>

> Symfony application

## 🔨 The realizations

```sh
  
   - Users can create account an login(Done)
   - Users can edit accounts(Done)
   - Users can add and edit ingredients(Done)
   - Users can add and edit a recipe(Done)
   - Admin User can delete ingrediant & recipe(Done)
   - User can share recipe ( In progress, 80% done)
   - Share recipe by email ( In progress)
   - A page that displays all recipes(Done)
   - A page that displays all ingredients(Done)
   - A page that displays the best recipes with a search bar( Done)
   - A page to manage user Profile( Done 80% complete)
   - For the database the ingredient table is composed of a name and a price(Done)
   - For the database the recipe table is composed of a name, description, preparation, instruction, level and a picture(Done)
   - For the database the user table is composed of a username, email, password and role (Done)
   
```

## 💾 Install

```sh
composer install
```
install the dependency.

```sh
symfony check:requirements
```

```sh
composer require symfony/dotenv
```

## 🔨 Usage

```sh
symfony server:start 
```

## Database connection

Open the file Add or Modify this line on the file ```.env``` and replace by your ```db_user```, ```db_password```, ```db_name```.

```sh
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```

## share recipe by email

Open the file Add or Modify this line on the file ```.env``` and replace the mailer_url by your ```email_adress```, ```email_password```, ```host```.

For exemple: MAILER_URL=gmail://mailsender@gmail.com:mypassword@localhost


## Database importation(Option 1)

```sh
php bin/console doctrine:database:create
```
```sh
import the sql file( receipt-manager.sql) on your database server( XAMP or WAMP) 
```

## Database migration(Option 2)

```sh
php bin/console doctrine:database:create
```
Create the database.

```sh
php bin/console doctrine:migrations:migrate
```
Create the table on datatbase.


## Routes
```sh
 
 ----------------------------- ---------- -------- ------ ------------------------------------------------ 
  Name                          Method     Scheme   Host   Path                                            
 ----------------------------- ---------- -------- ------ ------------------------------------------------ 
  ingrediant_list               GET        ANY      ANY    /ingrediant_list
  ingrediant_add                ANY        ANY      ANY    /ingrediant/add
  ingrediant_update             GET|POST   ANY      ANY    /ingrediant/update/{id}
  ingrediant_show               ANY        ANY      ANY    /ingrediant/{id}
  ingrediant_delete             DELETE     ANY      ANY    /ingrediant/delete/{id}
  app_home                      GET        ANY      ANY    /log
  receipt_list                  GET        ANY      ANY    /receipt_list
  app_homepage                  GET        ANY      ANY    /acceuil
  after_login_route_name        GET        ANY      ANY    /bestreceipt
  receipt_add                   ANY        ANY      ANY    /receipt/add
  receipt_update                GET|POST   ANY      ANY    /receipt/update/{id}
  receipt_show                  ANY        ANY      ANY    /receipt/{id}
  receipt_delete                DELETE     ANY      ANY    /receipt/delete/{id}
  user_registration             ANY        ANY      ANY    /register
  app_login                     ANY        ANY      ANY    /login
  app_logout                    ANY        ANY      ANY    /logout
  share                         ANY        ANY      ANY    /share
  user_list                     ANY        ANY      ANY    /user
  user_show                     ANY        ANY      ANY    /user/{id}
  user_update                   GET|POST   ANY      ANY    /user/update/{id}
  user_delete                   DELETE     ANY      ANY    /user/delete/{id}
  easyadmin                     ANY        ANY      ANY    /admin/
  liip_imagine_filter_runtime   GET        ANY      ANY    /media/cache/resolve/{filter}/rc/{hash}/{path}
  liip_imagine_filter           GET        ANY      ANY    /media/cache/resolve/{filter}/{path}
  login                         GET|POST   ANY      ANY    /login
 ----------------------------- ---------- -------- ------ ------------------------------------------------

```
## Com

👤 **NDIAYE Ibrahima**

* Github: [@ndibrahima](https://github.com/ndibrahima)
