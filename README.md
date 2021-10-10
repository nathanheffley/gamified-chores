## Gamified Chores

This project is a gamified chore management platform intended to be run locally on your LAN
or on a single, centrally located device not connected to the internet.

### Installation

This project was developed using [Laravel Sail](https://laravel.com/docs/8.x/sail).
If you don't have PHP and MySQL set up locally to use `php artisan serve`, you can
use Docker Desktop and Docker Compose to run the project in a Docker container. Run
the script below, and then use `./vendor/bin/sail up` to start the container.

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

You will also need to install the front-end dependencies with `npm install` and
run `npm run dev` to compile the assets.

Once the Docker container is running and the assets are compiled, you can visit
`localhost` to access the site.

### Usage

Once you visit the site, you will be prompted to create a profile. Once you have
created a least one profile, you can go back to the dashboard where you'll select
a profile to use. You can switch profiles from the dashboard at any time by clicking
the "switch" link next to your profile photo. You will also need to create chores
(there is a link to the list of chores saved in the system in the top right of the
dashboard). Once you've created some chores, you will see a little paper icon with a
plus in it. Click on this and you will see the chore show up on the dashboard (you
can add the same chore multiple times if you want). These available chores are
visible for any profile user. This chore can now be claimed by clicking on the
bookmark icon so that moves up to Your Chores. Once the chore is completed, you can
come back and click the thumbs up icon to mark that it has been finished, and you'll
be given the appropriate number of points.

### Future Development

There are three major features that still need to be implemented:

1. PIN authentication for admin pages. The Profiles and Chores pages should be protected behind a PIN login page.
2. Admin page for reviewing completed chores, so chore completion can be confirmed.
3. A reward selection system. Enter rewards into the system (like chores) that can be redeemed for points.
