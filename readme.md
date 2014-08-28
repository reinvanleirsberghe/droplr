Droplr
=====================

A starting project where user can make drops

## Installation

To use this project as is, first clone the repo from GitHub

```bash
git clone https://github.com/reinvanleirsberghe/droplr.git
```

If you are working with Homestead, update your Homestead.yaml

```bash
'folders:'
	- map: /Users/username/code/droplr
      to: /home/vagrant/droplr
'sites:'
	- map: droplr.app
      to: /home/vagrant/droplr
```

Update your /etc/hosts
```bash
sudo vi /etc/hosts

127.0.0.1    droplr.app
```

cd into homestead and do a `vagrant reload` and `vagrant provison`

`vm` into the site

Depending on the files that are available

Do a `composer update` (composer.json), a `npm install` (package.json) and a `bower install` (bower.json)

Create a local database and create a  `.env.local.php` file with the data of the database you just made

Create local test database and create a `.env.testing.php` file with the data of the database you just made

`vm` into the site

Do a `php artisan migrate`

Do a `php artisan migrate --env=testing`

Good to go!