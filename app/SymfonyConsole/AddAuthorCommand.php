<?php
namespace App\SymfonyConsole;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AddAuthorCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('symfony:author:add')  // Set the command name here
            ->setDescription('Add a new author using Symfony CLI')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the author');
    }

    // Make sure execute method returns an int
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Bootstrap Laravel to ensure facades are available
        $this->bootstrapLaravel();

        // Get author name from command argument
        $name = $input->getArgument('name');

        // Retrieve API token from session
        $token = Cache::get('access_token');

        // If no token is found, return failure with an error message
        if (!$token) {
            $output->writeln('<error>You are not authenticated. Please log in first.</error>');
            return Command::FAILURE;  // Return failure status code
        }

        // Split the full name into first and last name
        $name = explode(" ", $name);
        if (count($name) < 2) {
            $output->writeln('<error>Please provide both first and last name of the author.</error>');
            return Command::FAILURE;  // Return failure status code
        }

        // Make the HTTP request to add a new author
        $response = Http::withToken($token)->post(env('API_BASE_URL') . '/v2/authors', [
                'first_name' => $name[0],
                'last_name' => $name[1],
                'birthday' => "2025-02-09T14:04:45.610Z",  // Example birthday
                'biography' => 'Demo Biography',
                'gender' => 'male',
                'place_of_birth' => 'USA',
        ]);

        // $output->writeln('<error>'.json_encode($response->json()).'</error>');
        // return Command::FAILURE;  // Return failure st

        // Check if the response was successful
        if ($response->successful()) {
            $output->writeln("<info>Author '{$name[0]} {$name[1]}' added successfully!</info>");
            return Command::SUCCESS;  // Return success status code
        }

        // If the request failed, output the error message
        $output->writeln("<error>Failed to add author. API Response: " . $response->body() . "</error>");
        return Command::FAILURE;  // Return failure status code
    }

    private function bootstrapLaravel()
    {
        // Get the Laravel application instance
        $app = require __DIR__ . '/../../bootstrap/app.php';

        // Call the Laravel kernel to bootstrap the application
        $kernel = $app->make(\Illuminate\Foundation\Console\Kernel::class);
        $kernel->bootstrap();
    }
}
