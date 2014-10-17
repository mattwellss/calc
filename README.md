# Calc!

A very simple calculator


## About

Calc was built using the following technologies:

- [Aura](https://github.com/auraphp/Aura.Framework_Project)
- [Plates](https://github.com/league/plates)
- [Aura.Filter](https://github.com/auraphp/Aura.Filter)

## Installation and running

To run calc-app, the following requirements must be met:

* PHP5.4+
* [Composer](http://getcomposer.org)

Install initially by cloning the git repository:

```bash
> git clone https://github.com/mattwellss/calc-app
```

Once that completes, navigate to the newly-cloned repository and `composer install`. This installs all the required libraries, including the crux of the application, [calculation](https://github.com/mattwellss/calculation).

After composer has installed the app's dependencies, it's time to run! The simplest way to run the app is with PHP's built-in server.

```bash
> php -S localhost:8000 ./web/index.php
```

Now navigate with your browser to [localhost:8000](http://localhost:8000) and calculate away!
