<?php

namespace App\Command;

use App\Entity\ParsedFilesMor;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'mor_file:parser',
    description: 'Add a short description for your command',
)]
class MorFileParserCommand extends Command
{
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $em, LoggerInterface $logger, string $name = null)
    {
        parent::__construct($name);

        $this->entityManager = $em;
        $this->logger = $logger;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Parses an MOR text file (K-type) and inserts into the DB')
            ->addArgument('file', InputArgument::REQUIRED, 'File as argument')
            ->addOption('example_option', null, InputOption::VALUE_NONE, 'Blah blah');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('file');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('example_option')) {
            $io->note(sprintf('You picked an option: %s', $input->getOption('example_option')));
        }

        $this->processFile($arg1);
        $io->success('File parsed and inserted into DB!');

        return Command::SUCCESS;
    }

    private function processFile($file)
    {
        $recordTypeCode = '';
        $mbiString = '';
        $firstName = '';
        $lastName = '';
        $initialString = '';
        $dobString = '';
        $sex = '';
        $descriptionString = '';

        $params = [];

        $handle = fopen("$file", 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $stringChopper = '';

                $trimmedString = trim($line);

                $recordTypeCode = substr($trimmedString, 0, 1);
                $stringChopper .= $recordTypeCode;

                $mbiString = substr($trimmedString, 1, 11);
                $stringChopper .= $mbiString;

                $trimmedString = $this->chopBeginningOfString($stringChopper, $trimmedString);
                $descriptionString = substr($trimmedString, -128);

                $trimmedString = $this->chopEndOfString($descriptionString, $trimmedString);
                // break remaining string up by spaces
                $parts = preg_split('/\s+/', $trimmedString);

                if (3 === count($parts)) {
                    $lastName = $parts[0];
                    $firstName = $parts[1];

                    if (preg_match('/^[a-zA-Z]/', $parts[2])) {
                        $initialString = substr($parts[2], 0, 1);
                        $remainingString = $this->chopBeginningOfString($initialString, $parts[2]);

                        $dobString = substr($remainingString, 0, 8);
                        $sex = substr($remainingString, -1);
                    } else {
                        $dobString = substr($parts[2], 0, 8);
                        $sex = substr($parts[2], -1);
                    }
                } elseif (2 === count($parts)) {
                    $lastName = $parts[0];

                    preg_match('/([0-9]+)/', $parts[1], $matches);
                    preg_match('/([a-zA-Z]+)/', $parts[1], $lmatches);

                    if ($matches) {
                        $dobString = substr($matches[0], 0, 8);
                        $sex = substr($matches[0], -1);
                    }
                    if ($lmatches) {
                        $firstName = substr($lmatches[0], 0, 7);
                        $initialString = substr($lmatches[0], -1);
                    }
                }
                try {
                    $params['record_type'] = $recordTypeCode;
                    $params['mbi_string'] = $mbiString;
                    $params['first_name'] = $firstName;
                    $params['last_name'] = $lastName;
                    $params['initial_string'] = $initialString;
                    $params['dob'] = $dobString;
                    $params['sex'] = $sex;
                    $params['description_string'] = $descriptionString;

                    $this->insertParsedRowIntoDb($params);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
            fclose($handle);
        }

        return true;
    }

    /**
     * @param $params
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function insertParsedRowIntoDb($params)
    {
        $parsedMor = new ParsedFilesMor();
        $parsedMor->setRecordTypeCode($params['record_type']);
        $parsedMor->setMbi($params['mbi_string']);
        $parsedMor->setFirstName($params['first_name']);
        $parsedMor->setLastName($params['last_name']);
        $parsedMor->setInitial($params['initial_string']);
        $parsedMor->setDobString($params['dob']);
        $parsedMor->setSex((int) $params['sex']);
        $parsedMor->setDescriptionString($params['description_string']);

        $this->entityManager->persist($parsedMor);
        $this->entityManager->flush();
    }

    /**
     * @return array|string|string[]|null
     */
    private function chopBeginningOfString(string $stringChopper, string $trimmedString)
    {
        return preg_replace('/^'.preg_quote($stringChopper, '/').'/', '', $trimmedString);
    }

    /**
     * @return array|string|string[]|null
     */
    private function chopEndOfString(string $stringChopper, string $trimmedString)
    {
        return preg_replace('/'.preg_quote($stringChopper, '/').'$/', '', $trimmedString);
    }
}
