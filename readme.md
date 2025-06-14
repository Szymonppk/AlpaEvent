# 🎉 AlpaEvent

**AlpaEvent** is a web-based event management app that helps users create events, organize rooms, collaborate with friends, and share resources like photos and sticky notes.

---
### 👥 User System
- Secure login & registration (password hashing with `bcrypt`)
- Profile editing (username, email, password)
- Account deletion with confirmation
- Friend search and connection system

### 📅 Events & Rooms
- Create events with name, type, date, location, and description
- Assign users to rooms connected to events
- View event information per room
- Room-specific modules like chat, gallery, event plan and sticky notes

### 🗒️ Sticky Notes
- Add & edit quick notes in each room
- Asynchronous (AJAX-based) save/load
- Notes are persisted in the database

### 🖼️ Gallery
- Upload and preview room-related photos
- Responsive grid gallery with full-screen preview

### 🧾 Future Modules
- Event Settlements (expense tracking)
- Task/plan management with prioritization strategies
- Realtime chat system (WebSockets)

---

## 🛠 Tech Stack

| Layer     | Tech                          |
|-----------|-------------------------------|
| Backend   | PHP 8 (Custom MVC structure)  |
| Frontend  | HTML, CSS, JavaScript (vanilla) |
| Database  | PostgreSQL (Dockerized)       |
| Tools     | Composer, Docker, dotenv      |
| Auth      | PHP native sessions, bcrypt   |

---

## 📁 Project Structure

ALPAEVENT/
│
├── docker/ # Docker configs
│ ├── db/ # PostgreSQL setup
│ ├── nginx/ # Nginx config
│ └── php/ # PHP Dockerfile
│
├── public/ # Public assets
│ ├── scripts/ # JavaScript files
│ ├── styles/ # CSS files
│ └── views/ # HTML templates (optional)
│
├── src/
│ ├── controllers/ # Controller classes (e.g. SecurityController, RoomController)
│ ├── database/ # DB connection
│ ├── models/ # Entity classes 
│ └── repository/ # DAO classes (UserDAO, RoomDAO, etc.)
│
├── uploads/ # User-uploaded files (e.g. images)
│
├── .gitignore
|── alpa_backup_final.sql
├── composer.json
├── docker-compose.yaml
├── index.php # App entry point
├── Router.php # Basic routing handler
├── secret.env # Environment variables (DB config etc.)
└── readme.md # 

Database
![ERD Diagram](./AppPhotos/FinalAlpaEventERD.png)
