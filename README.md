# Symfony PHP Parser

Thank you for your interest in joining the technology team at Second Wave Delivery Systems!

## Parser
Parser File, Inserts into DB, and a Unit test that goes with it. Symfony 5.4

## Relevant Files
The files you'll need to complete the test are included in the `data` folder at the root of the project:

|Name                       |Description                                                                          |
|---------------------------|-------------------------------------------------------------------------------------|
|**mor-file-clean.txt**     |A de-identified MOR file                                                             |
|**PCUG-2021-October_1.pdf**|A user guide where you can find helpful specifications for understanding the MOR file|


## Setup
1. Install [Docker Engine](https://docs.docker.com/engine/install/)
2. Clone this reposiotry 
4. ```docker compose up```
5. The application should now be available at http://localhost:8002
6. (optional) Install the [Symfony Binary](https://symfony.com/download)

## Running it:
1. Type: 
```shell
php bin/console mor_file:parser data/mor-file-clean.txt 
```

## Running tests
You can run tests with the following command:
```shell
php bin/phpunit tests/MorFileParserCommandTest.php 
```

You can fix your code smell using [CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) with the following command:
```shell
bin/csfixer
```
