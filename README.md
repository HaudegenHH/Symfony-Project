# simple webapp to demonstrate the 1:n relationship between conferences and their related comments

1. Clone Repository
2. I left the .env-file in there on purpose, so that you just have to change the mysql credentials
3. Start local MySQL & Webserver
4. Run following commands:

composer install
php bin/console doctrine:database:create (or the abbrevviation: d:d:c)
php bin/console doctrine:migrations.migrate (or: d:m:m)
optional:
php bin/console doctrine:fixtures:load
symfony server:start or symfony serve

-> open your browser and go to: "https://localhost:8000"

## Using following software/modules

Symfony 6 (website-skeleton)
Bootswatch
DoctrineFixturesBundle
fzaninotti/faker
KnpPaginatorBundle
"https://github.com/KnpLabs/KnpPaginatorBundle"

### Problems you may encounter

1. The fzaninotto module has an error
   -> go to: \vendor\fzaninotto\faker\src\Faker\Provider\Lorem.php Line 95
   return join($words, ' ') . '.';
   change this to:
   return join(' ', $words) . '.';

2. Had to shorten the mysql DATABASE_URL in the .env
   (apperently serverVersion is not needed any more)

3. Wrapper for DateTimeImmutable in the AppFixture

4. Fix für Lorem.php (faker related)
   "https://gitlab.chinamcloud.com/php/dmd/blob/1da19f51f55f1586c63e9cacc95bc875278f29b4/vendor/fzaninotto/faker/src/Faker/Provider/Lorem.php"
