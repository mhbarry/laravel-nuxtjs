# Laravel-Nuxt(spa)

> A Laravel-Nuxt starter project template.

## Features

- Nuxt ^2.0.0
- Laravel 6
- SPA
- Websockets with beyondcode/laravel-websockets
- Vuetify ^2.2.22
- Login, register
- Chat
- axios
- vue-session
- Laravel Passport

## Build Setup development

### Server-side
``` bash
# cloning project
$ git clone https://github.com/builderapps/laravel-nuxtjs.git

# install dependencies
$ composer install

# init application by preparing database and run seeders and installing passport
# default users email: admin@admin.com, user@user.com
# default passord: password
$ php artisan app:init

# execute websocket server
$ php artisan websockets:serve

# execute server
$ php artisan serve
```

### Client-Side
``` bash
# install dependencies
$ cd client
$ cd yarn install

# serve with hot reload at localhost:3000
$ yarn dev
```

## Build Setup production

``` bash

# Build client for production

$ php artisan app:client-build

# execute server
$ php artisan serve
```

For detailed explanation on how things work, check out [Nuxt.js docs](https://nuxtjs.org),  [Laravel docs](https://laravel.com), 
