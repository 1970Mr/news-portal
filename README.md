# News Portal

Welcome to the News Portal, a comprehensive and modular news website built with Laravel. This project is designed to offer a wide range of features, providing a robust and flexible platform for managing news content. The application is organized into several modules, each responsible for a specific functionality.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Modules](#modules)
    - [AdManager](#admanager)
    - [Article](#article)
    - [Auth](#auth)
    - [Category](#category)
    - [Comment](#comment)
    - [Common](#common)
    - [ContactUs](#contactus)
    - [FileManager](#filemanager)
    - [Front](#front)
    - [Home](#home)
    - [Hotness](#hotness)
    - [Newsletter](#newsletter)
    - [Panel](#panel)
    - [Profile](#profile)
    - [Role](#role)
    - [Seen](#seen)
    - [SEOManager](#seomanager)
    - [Setting](#setting)
    - [SocialNetwork](#socialnetwork)
    - [Tag](#tag)
    - [User](#user)
- [Contributing](#contributing)
- [License](#license)

## Features

- Modular architecture for easy maintenance and scalability
- Comprehensive article management system
- User authentication and role management
- Advertisement management
- Category and tag management
- Commenting system
- File management
- Newsletter subscription and management
- Social network integration
- Customizable settings
- Detailed analytics for content performance

## Requirements

- PHP >= 7.4
- Composer
- MySQL or other supported database
- Laravel >= 8.x

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/1970Mr/news-portal.git
    cd news-portal
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Set up environment variables:**

   Copy the `.env.example` file to `.env` and update the necessary settings, such as database credentials.

    ```sh
    cp .env.example .env
    ```

   Add the following initial settings to your `.env` file:

    ```sh
    ADMIN_FULL_NAME=test
    ADMIN_USERNAME=test
    ADMIN_EMAIL=test@gmail.com
    ADMIN_PASSWORD=password

    PANEL_PREFIX=panel
    ```

4. **Generate application key:**

    ```sh
    php artisan key:generate
    ```

5. **Run migrations:**

    ```sh
    php artisan migrate
    ```

6. **Seed the database:**

    ```sh
    php artisan db:seed
    ```

7. **Start the development server:**

    ```sh
    php artisan serve
    ```

Your application should now be running at `http://localhost:8000`.

## Configuration

The configuration for each module can be found in the respective module's directory. Make sure to review and adjust the configuration files to suit your needs.

### Panel URL Prefix

With the `PANEL_PREFIX` configuration in your `.env` file, you can easily change the prefix for all admin panel URLs. For example, setting `PANEL_PREFIX=admin` will change all URLs that start with `/panel` to `/admin`. This change will automatically be applied to all administrative modules, ensuring a consistent and customizable URL structure for the admin panel.

For instance:
- If `PANEL_PREFIX=panel`, the URL for the admin dashboard might be `http://localhost:8000/panel/`.
- If you change `PANEL_PREFIX=admin`, the URL will change to `http://localhost:8000/admin/`.

This feature allows for flexibility in URL management, making it easier to integrate the News Portal with existing systems or to adhere to specific organizational URL schemes.

## Usage

Once installed, you can start using the News Portal by navigating to the appropriate sections via the web interface. Below are the details of the main modules and their functionalities.

## Modules

### AdManager

The AdManager module handles the creation, management, and display of advertisements across the site.

- **Features:**
    - Create and manage ad campaigns
    - Track ad performance
    - Display ads in various sections of the site

### Article

The Article module manages the creation, editing, and publishing of news articles.

- **Features:**
    - Rich text editor for writing articles
    - Support for images and videos
    - Article categorization and tagging

### Auth

The Auth module handles user authentication and authorization.

- **Features:**
    - User registration and login
    - Password reset functionality
    - Role-based access control

### Category

The Category module manages the categorization of articles.

- **Features:**
    - Create and manage categories
    - Assign articles to categories

### Comment

The Comment module allows users to comment on articles.

- **Features:**
    - User comments on articles
    - Moderation tools for comments
    - Nested comments support

### Common

The Common module includes shared functionalities and utilities used across different modules.

### ContactUs

The ContactUs module manages the contact form and incoming messages from users.

- **Features:**
    - Contact form management
    - View and respond to messages

### FileManager

The FileManager module handles the upload and management of files.

- **Features:**
    - Upload images, videos, and documents
    - Organize files in folders
    - Secure file access

### Front

The Front module deals with the frontend presentation of the site.

- **Features:**
    - Customizable templates
    - Responsive design
    - Widgets and dynamic content

### Home

The Home module manages the homepage content.

- **Features:**
    - Configurable sections for featured articles, latest news, and more
    - Customizable layout

### Hotness

The Hotness module tracks and displays trending articles.

- **Features:**
    - Calculate article popularity based on views and interactions
    - Display trending articles

### Newsletter

The Newsletter module manages newsletter subscriptions and email campaigns.

- **Features:**
    - Subscription form
    - Send newsletters to subscribers
    - Track email campaign performance

### Panel

The Panel module provides the administrative interface for managing the site.

- **Features:**
    - Dashboard with site statistics
    - Management tools for all modules

### Profile

The Profile module manages user profiles and user-related functionalities.

- **Features:**
    - Edit personal information
    - Change email
    - Change password
    - Manage user social networks

### Role

The Role module manages user roles and permissions.

- **Features:**
    - Create and assign roles
    - Define permissions for each role

### Seen

The Seen module tracks article views and user interactions.

- **Features:**
    - View analytics for article performance
    - Track user engagement

### SEOManager

The SEOManager module handles SEO-related settings and optimizations.

- **Features:**
    - Manage meta tags for articles
    - Optimize site for search engines
    - Track SEO performance

### Setting

The Setting module handles the site-wide settings and configurations.

- **Features:**
    - Manage site settings from the admin panel
    - Configure third-party integrations
    - **About Us:** Manage the "About Us" section of the site
    - **Cache Management:** Clear and manage cache settings
    - **Site Details:** Configure site-wide details such as site name, logo, and contact information
    - **Social Networks:** Manage social network links and integrations

### SocialNetwork

The SocialNetwork module manages social media integrations.

- **Features:**
    - Share articles on social media
    - Display social media feeds on the site

### Tag

The Tag module handles the tagging of articles.

- **Features:**
    - Create and manage tags
    - Assign tags to articles

### User

The User module manages user profiles and user-related functionalities.

- **Features:**
    - User profile management
    - User activity tracking

## Contributing

We welcome contributions to the News Portal project. If you find a bug or have a feature request, please open an issue on GitHub. If you'd like to contribute code, please fork the repository and submit a pull request.

## License

The News Portal project is open-source software licensed under the MIT license. See the [LICENSE](LICENSE) file for more information.

---

> **Note**: All modules in this project were developed by [Mr1970](https://github.com/1970Mr), except for the frontend template, which uses a pre-built template.

> **Note:** The frontend template is in Persian, but all messages and sections in the backend code are read from translation files.

---

Thank you for using News Portal! If you have any questions or need further assistance, please feel free to contact us.
