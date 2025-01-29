# Invoicing System 

## Introduction
This is a Laravel 11-based invoicing system with user authentication, role-based access control, and invoice management functionalities. The application allows administrators to manage normal employees, sections, products, and invoices.
It features a dashboard built using Blade templates and visualizes data using Laravel ChartsJS for charts.

## Features
- User Authentication (Laravel Breeze)
- Role-based Access Control (Admin & Employee)
- Section & Product Management
- Invoice Management (Create, Edit, Archive, Print)
- Soft Delete & Restore for Invoices

## Technologies Used
- **Laravel 11** (PHP framework)
- **Spatie Permissions** (Role-based access control)
- **Blade Templates** (Frontend UI)
- **Laravel Chartjs** (For draw charts)

## Installation
1. **Clone the repository**
   ```sh
   git clone https://github.com/your-repo.git
   cd your-project-folder
   ```

2. **Install dependencies**
   ```sh
   composer install
   npm install && npm run dev
   ```

3. **Set up environment**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
   Configure your `.env` file with database credentials.

4. **Run migrations & seed database**
   ```sh
   php artisan migrate --seed
   ```

5. **Start the server**
   ```sh
   php artisan serve
   ```

## Authentication
- Users must log in to access the system.
- Admin users can manage employees, sections, products, and invoices.

## Routes Overview

### **Authenticated Routes (`auth` middleware)**
| Method | URI | Controller | Function                        |
|--------|----|------------|---------------------------------|
| GET    | `/dashboard` | `HomeController@index` | Dashboard                       |
| GET    | `/sections` | `SectionController@index` | View sections                   |
| GET    | `/sections/{section}/get-products` | `SectionController@getProducts` | Get section products            |
| GET    | `/products` | `ProductController@index` | View products                   |
| GET    | `/invoices` | `InvoicesController@index` | View invoices                   |
| GET    | `/invoices/create` | `InvoicesController@create` | Create invoice                  |
| POST   | `/invoices` | `InvoicesController@store` | Store invoice                   |
| GET    | `/invoices/archive` | `InvoicesController@archive` | View archived invoices          |
| PATCH  | `/invoices/{invoice}/change-status` | `InvoicesController@changeStatus` | Change invoice status (un/paid) |

### **Admin-Only Routes (`role:admin` middleware)**
| Method | URI | Controller | Function |
|--------|----|------------|----------|
| GET    | `/users` | `AdminController@users` | View users |
| POST   | `/admin/add-employee` | `AdminController@storeEmployee` | Add employee |
| DELETE | `/admin/delete-employee/{user}` | `AdminController@deleteEmployee` | Remove employee |
| POST   | `/sections` | `SectionController@store` | Add section |
| GET    | `/sections/{section}/edit` | `SectionController@edit` | Edit section |
| PUT    | `/sections/{section}` | `SectionController@update` | Update section |
| DELETE | `/sections/{section}` | `SectionController@destroy` | Delete section |
| GET    | `/invoices/{invoice}/edit` | `InvoicesController@edit` | Edit invoice |
| PUT    | `/invoices/{invoice}` | `InvoicesController@update` | Update invoice |
| DELETE | `/invoices/{invoice}` | `InvoicesController@destroy` | Delete invoice |
| PUT    | `/invoices/{id}/unarchive` | `InvoicesController@unarchive` | Restore invoice |
| GET    | `/invoices/{invoice}/print` | `InvoicesController@print` | Print invoice |
| POST   | `/products` | `ProductController@store` | Add product |
| GET    | `/products/{product}/edit` | `ProductController@edit` | Edit product |
| PUT    | `/products/{product}` | `ProductController@update` | Update product |
| DELETE | `/products/{product}` | `ProductController@destroy` | Delete product |

---
