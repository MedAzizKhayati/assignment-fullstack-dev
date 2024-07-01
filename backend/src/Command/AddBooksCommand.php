<?php

namespace App\Command;

use App\Entity\BookFactory;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory as FakerFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'add-books',
    description: 'Add a specified number of random books to the database',
)]
class AddBooksCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('count', InputArgument::REQUIRED, 'The number of books to add');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = (int) $input->getArgument('count');

        if ($count <= 0) {
            $io->error('The number of books must be a positive integer.');
            return Command::FAILURE;
        }

        $faker = FakerFactory::create();

        for ($i = 0; $i < $count; $i++) {
            $title = $faker->sentence(3);
            $numAuthors = $faker->numberBetween(1, 3);
            $authors = [];
            for ($j = 0; $j < $numAuthors; $j++) {
                $authors[] = $faker->name;
            }
            $publishedDate = $faker->dateTimeBetween('-10 years', 'now');

            $book = BookFactory::create($title, $authors, $publishedDate);
            $this->entityManager->persist($book);
        }

        $this->entityManager->flush();

        $io->success("Successfully added $count books to the database.");

        return Command::SUCCESS;
    }
}
