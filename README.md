✔️ Laravel Developer Test
======================
>  Laravel And Livewire MultiStep Form Application 

# Task

- Create a new Laravel and Livewire application (you can use the latest version)


- Create a 2 page form (livewire form so both pages are on the same URL route). First page should have Next button, the second page should have Previous and Submit buttons. (Previous goes to page 1, where it should keep all of the form input user entered, the submit button submits the form, etc...)



- Page 1 fields:
- First name
- Last name
- Address
- City
- Country
- Date of birth (3 separate select fields month/day/year) - on the backend combine these so it's easy to save as date time field in MySQL.



- Page 2 fields:
- "Are you married?" - Yes/No
- If Yes, the following fields show up conditionally:
- Date of marriage - same logic as Date of birth (If date of marriage occurred before the user was 18 years old, show an error message "You are not eligible to apply because your marriage occurred before your 18th birthday." and do not allow submission of form.)
- Country of marriage
- If No, the following fields show up conditionally:
- Are you widowed? Yes/No
- Have you ever been married in the past? Yes/No



Submit - Form submission should show a white page with output of the form results.



* Do not worry about the design/style of the form for now.
* We want to evaluate how the form functions when you're ready to show us.
* We want to evaluate how you developed the form, so we'll need access to the source code when it's ready.

## 🔌 Requirements

- PHP version: >= 8.1
- Composer

## 🧰 Built with

- Laravel 10
- Livewire 3
- Bootstrap

## Installation

### 1. Clone the repository

This step involves cloning the project's Git repository to your local machine using the provided Git clone command.

```
git clone https://github.com/vahagnhov/laravel-livewire-task.git
```

### 2. Install Dependencies

After cloning the repository, navigate to the project directory and install PHP using
Composer

```
cd laravel-livewire-task
composer install
```

### 3. Create .env File

Copy the .env.example file to create a .env file and configure it with your environment-specific
settings, including database credentials.

```
cp .env.example .env
```

### 4. Generate Laravel Application Key

Use this command to generate a unique application key for your Laravel application.

```
php artisan key:generate
```

### 5. Change to your database credentials

Then you'll need to **create a new database** and add your database credentials to the `.env` file.:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Database Migrations
Migrate the database schema using this command

```
php artisan migrate
```

### 7. Run Development Server

This command is commonly used in Laravel projects to serve the application locally.

```
php artisan serve
```

