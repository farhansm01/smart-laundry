# 🧺 Smart Laundry & Rentals
 
A browser-based, role-based web application that brings **laundry order processing** and **clothing/accessory rentals** for small Bangladeshi laundry shops into one system. Customers order laundry and book rentals from any browser; staff process jobs from a lighter dashboard; admins/owners get a full back-office view with consolidated financial reports.
 
> **Course project:** CSC 3215 – Web Technologies · Summer 2025-26 · Group 1, Section O · American International University-Bangladesh
 
---
 
## 📑 Table of Contents
 
- [About the Project](#-about-the-project)
- [Problem Statement](#-problem-statement)
- [Features by Role](#-features-by-role)
- [Tech Stack](#-tech-stack)
- [Database Design (ER Diagram)](#-database-design-er-diagram)
- [Use Case Diagram](#-use-case-diagram)
- [UI Preview](#-ui-preview)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
- [Design System](#-design-system)
- [Roadmap](#-roadmap)
- [Team](#-team)
 
---
 
## 📖 About the Project
 
Small laundry-and-rental shops largely run on paper — order books, loose receipts, and a shopkeeper's memory of which rental items are out. That's fragile: records get lost or miscounted, there's no check against double-booking a rental item, and there's no simple way to see combined income across both service lines.
 
**Smart Laundry & Rentals** solves this with a single web app, accessible from any browser, where:
- **Customers** place laundry orders (item + wash type + optional ironing), pay via COD or mobile financial services, and book rental items for a date range.
- **Staff** see only the jobs assigned to them and move each one through a fixed status workflow.
- **Admins** verify payments, assign staff, manage rental inventory, and view consolidated income reports.
- **Owners** have full admin access plus the ability to manage admin accounts and business-wide settings.
 
## ❗ Problem Statement
 
- Paper-based order books/receipts are easily lost, damaged, or miscounted.
- No automated check prevents the same rental item from being double-booked.
- No consolidated view of income across laundry orders and rentals.
- Customers can't check order status or item availability without visiting/calling the shop.
- A desktop-only tool doesn't fix this — it still ties everything to one machine.
 
## ✅ Features by Role
 
### All Users
- Register, log in / log out
- Change or reset password (via security question)
- View / edit / delete profile
- Personalized dashboard on login
 
### 👤 Customer
- Select laundry items, quantity, wash type (Normal/Dry), and optional ironing — total calculated automatically
- Schedule pickup date; pay via Cash on Delivery or online (bKash/Nagad)
- Browse categorized rental inventory and book by date range — cost & deposit calculated automatically
- Track complete laundry & rental history with live status
 
### 🧑‍🔧 Staff
- View only the laundry orders / rental deliveries assigned to them
- Update order & rental status step-by-step through the fixed workflow
- Collect Cash-on-Delivery payments and rental security deposits
- Mark rental returns with deposit refund
 
### 🛠️ Admin
- Verify or decline online payments before an order proceeds
- Assign staff to laundry orders and rental deliveries
- Manage rental inventory, including cancelling a reservation with automatic restock
- Manage customer/staff accounts and view consolidated financial reports
 
### 👑 Owner
- Full access to all Admin capabilities
- View combined, business-wide laundry + rental performance
- Create and manage Admin accounts
- Configure business settings (pricing rules, service types)
 
## 🧰 Tech Stack
 
| Layer | Technology |
|---|---|
| Front end | HTML, CSS, JavaScript |
| Back end | PHP (modular MVC — per-role Controllers & Models) |
| Database | MySQL (relational) |
| Config | `config/db.php` |
 
The app follows a classic client-server, three-tier architecture: every role — customer at home, staff on a shop terminal/phone, or the owner checking numbers remotely — uses the same thin browser client, while all business rules and data live centrally on the server.
 
## 🗄️ Database Design (ER Diagram)
 
The schema uses one shared `User` table (Customer/Staff/Admin/Owner under one `Role` column) and two independent flows: `LaundryOrder`/`OrderItem` for laundry jobs, and `RentalBooking` for rentals. `LaundryItem` and `RentalItem` are catalogue/reference tables.
 
![ER Diagram](docs/er-diagram.jpg)
 
| Entity | Purpose / Key Fields |
|---|---|
| **User** | `UserID` (PK), Username, Password (hashed), Name, Phone, Address, SecurityQuestion/Answer, Role |
| **LaundryItem** | `ItemID` (PK), ItemName, BasePrice |
| **LaundryOrder** | `OrderID` (PK), CustomerID/StaffID/VerifiedBy (FK → User), PickupDate, ServiceType, IroningOption, Status, TotalPrice, PaymentMethod, TransactionID, PaymentAccount, CreatedAt |
| **OrderItem** | `OrderItemID` (PK), OrderID/ItemID (FK), Quantity, Subtotal |
| **RentalItem** | `RentalItemID` (PK), Name, Category, Description, AvailableQuantity, PricePerDay, DepositAmount |
| **RentalBooking** | `RentalID` (PK), CustomerID/StaffID (FK → User), RentalItemID (FK), RentalDate, ReturnDate, TotalCost, Deposit, Status, DeliveryAddress, CreatedAt |
 
## 🧭 Use Case Diagram
 
![Use Case Diagram](docs/usecase-diagram.jpg)
 
`«include»` = a sub-step that always happens (e.g. placing an order always includes payment). `«extend»` = an optional variation (e.g. verifying an online payment only applies when paid online).
 
## 🎨 UI Preview
 
**Login · Customer Home · Place Laundry Order**
![Auth and order screens](docs/ui-auth-order.jpg)
 
**Payment · Admin Dashboard · Financial Report**
![Payment and admin screens](docs/ui-payment-admin.jpg)
 
**Rental Inventory · Order Detail · Staff Dashboard**
![Rental and staff screens](docs/ui-rental-staff.jpg)
 
**Book Rental Item** — cost & deposit calculated automatically
<img src="docs/ui-book-rental.jpg" width="260"/>
 
## 📂 Project Structure
 
```
smart-laundry/
├── admin/       # Admin Controllers, Models, Views
├── customer/    # Customer Controllers, Models, Views
├── owner/       # Shop Owner Controllers, Models, Views
├── staff/       # Staff Controllers, Models, Views
├── config/      # Database configuration (db.php)
├── assets/      # css/style.css, js/main.js, images
├── index.php    # Main homepage
└── info.md      # Design & system specification
```
 
> **Status:** the repository currently contains the initial MVC skeleton and design specification. Controllers/Models/Views for each role are being built out against the schema and use-case model above.
 
## 🚀 Getting Started
 
1. **Clone the repository**
   ```bash
   git clone https://github.com/farhansm01/smart-laundry.git
   cd smart-laundry
   ```
2. **Set up the database** — create a MySQL database and update the credentials in `config/db.php`.
3. **Serve the app** — place the folder in your local server's web root (e.g. XAMPP's `htdocs/`) or run PHP's built-in server:
   ```bash
   php -S localhost:8000
   ```
4. Open `http://localhost:8000` in your browser.
 
## 🎨 Design System
 
| Token | Value |
|---|---|
| Primary background | `#ffffff` |
| Page background | `#f8fafc` |
| Primary accent (Water/Clean Blue) | `#0284c7` / hover `#0369a1` |
| Secondary accent (Mint Fresh) | `#0d9488` |
| Light accent tint | `#e0f2fe` |
| Text main / muted | `#0f172a` / `#64748b` |
| Border | `#e2e8f0` |
| Font | `Outfit` (Google Fonts), fallback: system-ui, -apple-system, Segoe UI, Roboto |
 
## 🗺️ Roadmap
 
- [ ] Build out Controllers/Models/Views for all four roles
- [ ] Wire up automatic rental-inventory restock on cancellation
- [ ] Integrate a real-time payment gateway (beyond COD / manual bKash-Nagad verification)
- [ ] Automated testing & deployment pipeline
 
## 👥 Team
 
| SL. | Student ID | Name | Role |
|---|---|---|---|
| 1 | 23-52808-2 | Farhan Sadique Mohee | Group Leader |
| 2 | 23-52596-2 | S. M. Farham | Member |
| 3 | 23-52375-2 | Tamjid Jim | Member |
| 4 | 23-52315-2 | Nandita Banik | Member |
 
*CSC 3215: Web Technologies — American International University-Bangladesh*
