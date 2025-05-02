# DW Customer Database Application

This is a Laravel 12 + Vue 3 + Tailwind CSS CRUD application for managing of customer records, built inside Docker for easy setup.  Customers can be created, edited, deleted, and listed. Each customer is assigned a unique ID, and their preferred delivery days are tracked as well as what type of business the person belongs to.

---

## 🚀 Features

✅ Laravel 12 backend  
✅ Vue 3 frontend (with Vue Router)  
✅ Tailwind CSS 
✅ Full CRUD: Create, Read, Update, Delete  
✅ Validation on frontend  
✅ Dockerized MySQL + Laravel + PHP  
✅ Easy to run with Docker Compose

---

## 🛠️ Requirements

- [Docker](https://www.docker.com/) 
- [Docker Compose](https://docs.docker.com/compose/) installed
- Node.js & npm (only if making frontend changes)

---

## 📦 Installation

### 1️⃣ Clone the repository:

```bash
git clone https://github.com/yourusername/dw-customer-app.git
cd dw-customer-app
```

### 2️⃣ Copy `.env` file:

```bash
cp .env.example .env
```

---

### 3️⃣ Build and start Docker containers:

```bash
docker compose up --build
```

✅ This starts:

- PHP + Laravel app on `http://localhost:8000`
- MySQL database
---

### 4️⃣ Run migrations:

In another terminal:

```bash
docker exec -it laravel_app php artisan migrate
```

✅ Creates the `customers` table in the MySQL database.

---

## 🗄️ Database Restoration

To import the database (to Docker):

```bash
docker exec -i mysql_db mysql -u root -prootpassword laravel < dump.sql
```

Replace `rootpassword` with your actual MySQL root password (from `docker-compose.yml`).

---

## 💻 Access the app:

Open [http://localhost:8000](http://localhost:8000) in your browser.

✅ You should see the Laravel homepage or app UI.

---

## ✅ Done!

You’re ready to test the app locally and start looking at customers, editing them, deleting them, and adding them to your heart's delight!
Issues or Questions? Feel free to contact me.
