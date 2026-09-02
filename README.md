# 📚 City Public Library System

A dual‑component project that combines a **static library information portal** and a **relational database schema** for a seat booking & attendance management system.

- **Front‑end** (`index.php`) – an interactive, single‑page PHP application displaying library sections, an SVG floor map, events, and contact details.
- **Database** (`schema.sql`) – a MySQL backend designed for managing users, libraries, seats, bookings, attendance, and reviews.

> ⚠️ **Note:** The front‑end is a self‑contained demo and does **not** use the database. The schema is a separate module intended to power a fully functional seat reservation system.

---

## ✨ Features

### 🖥️ Front‑End (index.php)
- 🗺️ **Interactive 3‑floor map** with clickable rooms (SVG).
- 🔍 **Sections browser** with category, floor, and keyword filters.
- 📅 **Events & announcements** with type filtering (event, update, closure).
- 📞 **Contact page** with a working form (simulated submission) and FAQ.
- 📱 **Fully responsive** – adapts to mobile, tablet, and desktop.
- 🎨 **Modern UI** with a sticky navbar, hero section, stats, and modals for room details.

### 🗄️ Database Schema (schema.sql)
- 👥 **Users** – students and admins with authentication fields.
- 🏢 **Libraries** – location, opening hours, seat count, and contact info.
- 💺 **Seats** – individual seats with type (regular/premium/computer/group), status, and pricing.
- 📅 **Bookings** – reservations linked to users, seats, and libraries.
- 📋 **Attendance** – tracks user check‑in/out per day.
- ⭐ **Reviews** – ratings and comments for libraries.
- 🛠️ **Sample data** – pre‑populated with example libraries (Chennai), seats, users, and reviews.

