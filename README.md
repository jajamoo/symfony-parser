[[_TOC_]]

# Symfony PHP Quiz

Thank you for your interest in joining the technology team at Second Wave Delivery Systems!

## Jobs to be Done
- Create a new branch off of `main`
- Create a Symfony command that reads and parses the Model Output Report (MOR) file
- Create one or more entities to store the parsed data using the ORM (Doctrine)
- Write unit tests
- Test and lint all code (see [Application Instructions](#application-instructions))
- Keep in mind that the business may want to expose this logic as part of an API in the future

## Relevant Files
The files you'll need to complete the test are included in the `data` folder at the root of the project:

|Name                       |Description                                                                          |
|---------------------------|-------------------------------------------------------------------------------------|
|**mor-file-clean.txt**     |A de-identified MOR file                                                             |
|**PCUG-2021-October_1.pdf**|A user guide where you can find helpful specifications for understanding the MOR file|

## Submission
In order to submit the test for review, please push your completed work upstream and open a new merge request.

# Application Instructions

## Setup
1. Install [Docker Engine](https://docs.docker.com/engine/install/)
2. Clone this reposiotry 
4. ```docker compose up```
5. The application should now be available at http://localhost:8002
6. (optional) Install the [Symfony Binary](https://symfony.com/download)

## Running tests
You can run tests with the following command:
```shell
bin/phpunit
```

## Linting
You can execute the [Psalm](https://psalm.dev/) linter with the following command:
```shell
bin/psalm
```

You can execute the [PHPStan](https://github.com/phpstan/phpstan) linter with the following command:
```shell
bin/phpstan
```

You can fix your code smell using [CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) with the following command:
```shell
bin/csfixer
```

## More reading materials
- https://symfony.com/
- https://symfony.com/doc/5.4/index.html
- https://symfony.com/doc/5.4/controller.html
- https://symfony.com/doc/5.4/doctrine.html
