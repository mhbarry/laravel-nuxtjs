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

## Laravel-side
``` bash
# init application by preparing database and run seeders and installing passport
# default users email: admin@admin.com, user@user.com
# default passord: password

$ php artisan app:init

# execute websocket server
$ php artisan websockets:serve

# build for production and launch server
$ yarn build
$ yarn start

# generate static project
$ yarn generate
```

``` bash
# install dependencies
$ yarn install

# serve with hot reload at localhost:3000
$ yarn dev

# build for production and launch server
$ yarn build
$ yarn start

# generate static project
$ yarn generate
```

For detailed explanation on how things work, check out [Nuxt.js docs](https://nuxtjs.org).
