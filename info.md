# 🧺 Smart Laundry Project - Design & System Specifications

## 🎨 Color Theme & Design System

* **Primary Background**: `#ffffff` (Pure White)
* **Secondary / Page Background**: `#f8fafc` (Soft Light Slate)
* **Card & Container Background**: `#ffffff` (Pure White with subtle border `#e2e8f0` and soft shadow `rgba(0,0,0,0.05)`)
* **Primary Accent (Water/Clean Blue)**: `#0284c7` (Sky Blue 600)
* **Primary Hover / Dark Blue**: `#0369a1` (Sky Blue 700)
* **Secondary Accent (Mint Fresh)**: `#0d9488` (Teal 600)
* **Light Accent Tint (Bubbles / Water)**: `#e0f2fe` (Sky 100)
* **Text Main (Dark Gray/Navy)**: `#0f172a` (Slate 900)
* **Text Muted (Medium Gray)**: `#64748b` (Slate 500)
* **Borders**: `#e2e8f0` (Slate 200)

---

## 🔤 Typography & Fonts

* **Primary Font Family**: `'Outfit'`, sans-serif (Google Fonts)
* **Fallback Fonts**: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif
* **Font Weights Used**:
  * Light: 300
  * Regular: 400
  * Medium: 500
  * Semi-Bold: 600
  * Bold: 700

---

## 👥 User Roles Matrix

1. **Customer**: Book laundry services, choose wash preferences, track order status.
2. **Shop Owner**: Manage shop info, set prices for wash/dry/ironing, track earnings.
3. **Staff**: Update laundry processing stages (washing, drying, folding, ready).
4. **Admin**: Monitor entire platform, manage user accounts, approve shop listings.

---

## 📂 Modular MVC Directory Layout

* `admin/` - Admin Controllers, Models, Views
* `customer/` - Customer Controllers, Models, Views
* `owner/` - Shop Owner Controllers, Models, Views
* `staff/` - Staff Controllers, Models, Views
* `config/` - Database Configuration (`db.php`)
* `assets/` - Styling (`css/style.css`), JavaScript (`js/main.js`), images
* `index.php` - Main White-Themed Laundry Homepage
