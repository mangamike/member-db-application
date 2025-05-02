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
git clone https://github.com/mangamike/member-db-application.git
```

### 2️⃣ Copy '.env' file and Build and Start the Docker containers:
```bash
cp .env.example .env
```
```bash
docker compose up --build
```

---
✅ This starts:

- PHP + Laravel app on `http://localhost:8000`
- MySQL database
---

### 3️⃣ Run migrations:

In another terminal:

```bash
docker exec -it laravel_app php artisan migrate
```

✅ Creates the `customers` table in the MySQL database.

---

## 🗄️ Database Restoration

To import the database (dump.sql) in PHPMyadmin:  
go to [http://localhost:8080](http://localhost:8080) in your browser.  
Log in using the laravel user credentials (these can be found in the .env file).  
select the 'laravel' database  
In the Import page, click Choose File  
Select your dump.sql file  
Leave the format as SQL  
Click Go at the bottom  
hooray! you now have data in your db!  let's go  

---

## 💻 Access the app:

```bash
npm run build
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

✅ You should see the Laravel homepage or app UI.

---

## ✅ Done!

You’re ready to test the app locally and start looking at customers, editing them, deleting them, and adding them to your heart's delight!
Issues or Questions? Feel free to contact me.
