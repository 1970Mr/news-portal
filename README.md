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
    - [Menu](#menu)
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

- **Modular Architecture:** Easy maintenance and scalability with separate modules for different functionalities.
- **Comprehensive Article Management:** Rich text editor, support for images and videos, categorization, and tagging.
- **User Authentication and Role Management:** User registration, login, password reset, email verification, and role-based access control.
- **Advertisement Management:** Create and manage ad campaigns, track ad performance, and display ads across the site.
- **Category and Tag Management:** Create and manage categories and tags, assign them to articles.
- **Commenting System:** User comments with moderation tools, nested comments, Markdown support, and status management (approved, rejected, pending).
- **File Management:** Upload, edit, and manage images and files.
- **Newsletter Management:** Subscription form, send newsletters to subscribers, track email campaign performance.
- **Social Network Integration:** Share articles on social media, manage user and site social media links.
- **Customizable Settings:** Site-wide settings, third-party integrations, cache management, and social network management.
- **SEO Management:** Manage meta tags for various pages (articles, authors, categories, tags, homepage, etc.), optimize site for search engines, and track SEO performance.
- **Menu Builder:** Create and manage different types of menus (main, submenu, category, parent category), add and arrange menu items.
- **Homepage Management:** Configurable sections for featured articles, latest news, and more; customizable layout.
- **Detailed Analytics:** Track article views, user interactions, and content performance.
- **Administrative Panel:** Dashboard with site statistics and management tools for all modules.
- **Hot Content Tracking:** Mark articles and tags as "hot" to highlight trending content.
- **Contact Form Management:** Manage incoming messages from users through the contact form.

## Requirements

- PHP >= 8.1
- Composer
- MySQL
- Laravel >= 10.x

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
    APP_NAME="News Portal"
    ...
    ADMIN_FULL_NAME=test
    ADMIN_USERNAME=test
    ADMIN_EMAIL=test@gmail.com
    ADMIN_PASSWORD=password

    PANEL_PREFIX=panel
    ```

    Configure your database and email server settings in the .env file:

    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=news_portal
    DB_USERNAME=root
    DB_PASSWORD=your_password
    
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=hello@example.com
    MAIL_FROM_NAME="${APP_NAME}"
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

7. **Create a symbolic link to the storage directory:**

    ```sh
    php artisan storage:link
    ```

8. **Start the development server:**

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
    - Set publication dates for articles
    - Specify the publication status of articles
    - Mark articles as "hot"
    - Feature articles as editor's picks

### Auth

The Auth module handles user authentication and authorization.

- **Features:**
    - User registration and login
    - Password reset functionality
    - Email verification functionality
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
    - Comments can be in three statuses: approved, rejected, or pending
    - Review and change the status of comments to approved, rejected, or seen
    - Comments can be submitted in Markdown format

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
    - Upload and manage images
      - View all uploaded files on the site
      - Edit existing files
      - Create new files

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

The Hotness module tracks and displays trending content, including articles and tags, and allows administrators to mark them as "hot".

- **Features:**
    - Mark articles as "hot"
    - Mark tags as "hot"

### Menu

The Menu module manages the creation and organization of site menus.

- **Features:**
    - Create and manage menus
    - Add and arrange menu items
    - Support for nested menus
    - Define four types of menus:
        - `main`: Main navigation menu
        - `submenu`: Submenu items
        - `category`: Menu items for specific categories
        - `parent_category`: Menu items for parent categories

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
    - Create and manage roles
    - Define permissions for each role
    - All site sections and operations are permission-based
    - Assign permissions to roles for comprehensive access control

### Seen

The Seen module tracks article views and user interactions.

- **Features:**
    - View analytics for article performance
    - Track user engagement

### SEOManager

The SEOManager module handles SEO-related settings and optimizations.

- **Features:**
    - Manage meta tags for articles 
    - Manage meta tags for articles 
    - Manage meta tags for author pages
    - Manage meta tags for categories
    - Manage meta tags for tags
    - Manage meta tags for the homepage
    - Manage meta tags for the contact us page
    - Manage meta tags for the about us page
    - Manage meta tags for search pages
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
    - Users can register their own social media links
    - Administrators can register social media links for the site

### Tag

The Tag module handles the tagging of articles.

- **Features:**
    - Create and manage tags
    - Assign tags to articles

### User

The User module manages user profiles and user-related functionalities.

- **Features:**
    - Perform CRUD (Create, Read, Update, Delete) operations on users
    - Assign roles to users
    - Deactivate users
    - Revoke email verification and other similar actions

## Contributing

We welcome contributions to the News Portal project. If you find a bug or have a feature request, please open an issue on GitHub. If you'd like to contribute code, please fork the repository and submit a pull request.

## License

The News Portal project is open-source software licensed under the MIT license. See the [LICENSE](LICENSE) file for more information.

---

> **Note**: All modules in this project were developed by [Mr1970](https://github.com/1970Mr), except for the frontend template, which uses a pre-built template.

> **Note:** The frontend template is in Persian, but all messages and sections in the backend code are read from translation files.

---

Thank you for using News Portal! If you have any questions or need further assistance, please feel free to contact us.
