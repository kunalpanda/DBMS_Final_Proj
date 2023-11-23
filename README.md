# Project Setup Guide

Welcome to our project! This guide will walk you through the steps needed to set up the project environment on your local machine.

## Prerequisites

Before you start, ensure you have the following installed:

- XAMPP: Make sure to install the version that is compatible with our project.
- Composer: A PHP dependency manager.
- Git: For cloning the repository.

## Installation Steps

### Step 1: Install XAMPP

Download and install the correct version of XAMPP for your operating system. Our teams web apps work on XAMPP/PHP versions less 8.0. Recommended `XAMPP/PHP 7.4.30` XAMPP will provide you with the necessary Apache server, MySQL, and PHP.

- **Download XAMPP**: [XAMPP Official Website](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/)

### Step 2: Install Composer

Composer is required for managing PHP dependencies.

- **Download Composer**:

- Run `Composer-setup.exe` [Run Composer](https://github.com/your-repository/path/to/Composer-setup.exe)
- Dont select any extra options
- Select the installation directory to XAMPP/php, (it automatically detects)
- Complete Install.
- Open CMD with XAMPP htdocs directory (`cd path/to/htdocs`)
- Verify the installation by running `composer` in your CMD.

### Step 3: Clone Repository

Clone the project repository into the 'htdocs' directory of your XAMPP installation.

- Open your command line tool.
- Navigate to your 'htdocs' directory: `cd path/to/htdocs`
- Clone the repository: `git clone <repository link>`

### Step 4: Set Up PHP Dependencies

Open your command line tool and execute the following commands:

1. `composer` - This checks if Composer is correctly installed.
2. `composer update --ignore-platform-req=ext-gd` - Updates your project dependencies, ignoring the GD extension requirement.
3. `composer require guzzlehttp/guzzle` - Adds Guzzle, an HTTP client, to your project.

### Step 5: Database Setup

Download the provided SQL dump file for setting up your database.

- **Download SQL Dump Schema**: [Download](https://github.com/your-repository/path/to/Composer-setup.exe)

Import this file into your MySQL database via PHPMyAdmin or MySQL Workbench.

### Step 6: Start XAMPP Server

Finally, start the XAMPP server:

- Open the XAMPP Control Panel.
- Start the Apache and MySQL modules. (MySQL may not start if you have a workbench setup. Use port and local user credentials from workbench)
- Access the project in the browser.
- Use `localhost/<your repo & file paths>`

## Conclusion

You should now have everything set up for the project.
