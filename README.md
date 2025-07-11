# Web Final Project

This repository contains a modern, responsive web application for an online furniture store. The project is built primarily with PHP for backend logic, using custom MVC-style routing and controllers, and uses Tailwind CSS for a sleek, mobile-first frontend. It also includes some JavaScript for UI enhancements.

> **Note:** This is a very simplified version of the e-commerce site we had in mind. While some core features are implemented, many advanced functionalities are still missing or planned for future development.

## Implemented Features

- **Home Page:** Highlights featured collections and new arrivals, with call-to-action sections to engage users.
- **Product Catalog:** Allows users to browse products by collection (e.g., Living Room, Dining Room) with detailed information, pricing, materials, and care instructions.
- **Product Details:** Rich product pages with image galleries, specifications, and reviews.
- **Shopping Cart:** Users can review their shopping bag, modify quantities, and proceed to checkout (cart logic is simplified).
- **Admin Dashboard:** Secure area for administrators to manage product catalog and inventory.
- **Authentication:** Admin features are protected and require basic login (session-based).
- **Responsive Design:** Mobile-friendly layout using Tailwind CSS with custom color themes and fonts.
- **Component-Based Views:** PHP includes and components for reusable UI elements.
- **Database Integration:** The app uses SQLite as its database engine, and includes a seed file to initialize products and collections.

## Missing or Planned Features

- User registration, login, and account management.
- Persistent cart and order history tied to users.
- Payment integration and checkout workflow.
- Product search and filtering.
- Order management and tracking.
- Email notifications, password reset, and other user-facing features.
- Improved admin controls (CRUD operations, analytics, etc.).
- Security hardening and input validation.
- And many more enhancements to bring it closer to a production-grade e-commerce site.

## Project Structure

```
├── app/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   ├── CartController.php
│   │   └── AdminController.php
│   ├── Core/
│   │   └── Controller.php
│   └── views/
│       ├── layouts/
│       │   └── app.php
│       ├── home.php
│       ├── product.php
│       ├── cart.php
│       └── admin/
│           ├── dashboard.php
│           └── product_list.php
├── database/
│   ├── database.sqlite
│   └── seed.sql
├── public/
│   ├── index.php
│   └── css/
│       └── app.css
├── tailwind.config.js
└── ...
```

- **app/Controllers/**: Application logic for handling requests and rendering views.
- **app/Core/Controller.php**: Base controller with helper methods for rendering views and JSON responses.
- **app/views/**: PHP templates for all user and admin pages.
- **database/**: Contains the SQLite database file and the SQL seed file for initial data.
- **public/index.php**: Entry point and front controller for all HTTP requests.
- **public/css/app.css**: Tailwind-generated styles with customizations.
- **tailwind.config.js**: Tailwind CSS configuration, including custom colors and fonts.

## Getting Started

### Prerequisites

- PHP 8.0+
- Composer (for dependency management)
- Node.js & npm (for Tailwind CSS and frontend asset building)
- SQLite (included with most PHP installations)

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/Karinkuto/web-final-project.git
   cd web-final-project
   ```

2. **Install PHP dependencies:**
   ```sh
   composer install
   ```

3. **Install and build frontend assets:**
   ```sh
   npm install
   npx tailwindcss -i ./public/css/app.css -o ./public/css/app.css --watch
   ```

4. **Set up the database:**
   - Ensure the `database/` directory is writable.
   - Create an SQLite database file if it doesn't exist:
     ```sh
     touch database/database.sqlite
     ```
   - Seed the database:
     ```sh
     sqlite3 database/database.sqlite < database/seed.sql
     ```

5. **Run the development server:**
   You can use PHP's built-in server for local development:
   ```sh
   php -S localhost:8000 -t public
   ```

6. **Access the app:**
   Open [http://localhost:8000](http://localhost:8000) in your browser.

## Customization

- **Configuring Products & Collections:**
  Product and collection data are now stored in the SQLite database. Update the `seed.sql` file or use an admin tool to manage your catalog.

- **Theming:**
  Modify `tailwind.config.js` and the CSS variables in your layout files to adjust branding, colors, and fonts.

## Folder Details

- **Controllers:** Each controller (e.g., `ProductController`, `CartController`, `AdminController`) handles a section of the site. The controllers pass data to views.
- **Views:** Use PHP to render dynamic content. Layouts and components are reused for consistency.
- **Admin Area:** Found under `app/views/admin/`, includes product management interfaces for administrators.
- **Database:** The `database/` folder contains the SQLite database and seeding scripts.

## Security

- Admin routes are protected with session-based authentication. Only users with the `is_admin` session variable set can access admin features.

