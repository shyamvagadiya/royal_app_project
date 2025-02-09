# Laravel Symfony Console Command for Adding Authors

## Overview

This Laravel project implements a Symfony CLI command to add authors to a remote system via an API. The command retrieves the API token from the session, then sends a `POST` request to a specified API endpoint. If successful, it adds a new author and provides an appropriate response message.

### Features:
- Adds a new author using the Symfony CLI.
- Validates user authentication by checking for an access token in the session.
- Sends a `POST` request to an external API to add an author.
- Provides success or error messages based on the API response.

---

## Prerequisites

- **PHP 8.1+**: This project requires PHP 8.1 or higher.
- **Laravel 8.x+**: This project is built with Laravel 8.x or higher.
- **Symfony Console**: Symfony CLI is used for creating and handling console commands.

---

## Installation

### Step 1: Clone the Repository

Clone this repository to your local machine:

```bash
git clone https://github.com/your-repository-url.git
cd your-repository-directory
```

### Step 2: Install Dependencies

Install the required dependencies using Composer:

composer install
```

### Step 3: Configure Environment Variables

Create a `.env` file in the project root and set the following variables:

and fire this command to add author

php artisan symfony:author:add "John Doe"

## Step 3: Run the Command to run the project

php artisan serve 
