# Project Setup Guide

Welcome to our project! This guide will walk you through the steps needed to set up the project environment on your local machine.

## Prerequisites

Before you start, ensure you have the following installed:
- XAMPP: Make sure to install the version that is compatible with our project.
- Composer: A PHP dependency manager.
- Git: For cloning the repository.

## Installation Steps

### Step 1: Install XAMPP

Download and install the correct version of XAMPP for your operating system. XAMPP will provide you with the necessary Apache server, MySQL, and PHP.

- **Download XAMPP**: [XAMPP Official Website](https://www.apachefriends.org/index.html)

### Step 2: Install Composer

Composer is required for managing PHP dependencies.

- **Download Composer**: [Get Composer](https://getcomposer.org/download/)
- After installing, verify the installation by running `composer` in your command line.

### Step 3: Set Up PHP Dependencies

Open your command line tool and execute the following commands:

1. `composer` - This checks if Composer is correctly installed.
2. `composer update --ignore-platform-req=ext-gd` - Updates your project dependencies, ignoring the GD extension requirement.
3. `composer require guzzlehttp/guzzle` - Adds Guzzle, an HTTP client, to your project.

### Step 4: Database Setup

Download the provided SQL dump file for setting up your database.

- **Download SQL Dump**: [Download Link](<link>)

Import this file into your MySQL database via PHPMyAdmin or a similar tool.

### Step 5: Clone Repository

Clone the project repository into the 'htdocs' directory of your XAMPP installation.

- Open your command line tool.
- Navigate to your 'htdocs' directory: `cd path/to/htdocs`
- Clone the repository: `git clone <repository link>`

### Step 6: Start XAMPP Server

Finally, start the XAMPP server:

- Open the XAMPP Control Panel.
- Start the Apache and MySQL modules.
- Access your project in the browser.

## Conclusion

You should now have everything set up for the project. If you encounter any issues, please refer to the documentation of the respective tools or contact the project maintainers.

