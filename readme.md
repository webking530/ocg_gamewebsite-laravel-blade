## Setting up the project


Install dependencies and run migrations:
```
$ composer self-update
$ composer install 
$ npm install
$ artisan migrate
```

Generate PHPstorm metadata:
```
$ artisan ide-helper:generate
```

Compile assets in development:

```
$ npm run dev
```

Compile assets in production:

```
$ npm run prod
```

Run local server:

```
$ artisan serve
```