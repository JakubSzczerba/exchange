# Exchange
> Application for currency checking.
## Technologies
* PHP - version 8.3
* Symfony - version 6.4
* PostgreSQL - version 13.2
* [CurrencyBeaconApi](https://currencybeacon.com/api-documentation)

## Local Setup
```
docker compose up -d
```
```
docker compose exec php bin/console doctrine:migrations:migrate
```
```
 docker compose exec php bin/console exchange:load:currency
```

## Contact
* [GitHub](https://github.com/JakubSzczerba)
* [LinkedIn](https://www.linkedin.com/in/jakub-szczerba-3492751b4/)