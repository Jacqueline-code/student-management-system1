# Student Management System

A Laravel web app for managing students, lecturers, courses and course registrations.
Built for Advanced Web Application Development (BUC3131), MUBS, 2026/2027.

## Installation and Database Setup

Requirements: PHP 8.3 or newer, Composer, and MySQL (for example XAMPP).

1. Clone the project and open its folder:
   ```
   git clone https://github.com/Jacqueline-code/student-management-system1.git
   cd student-management-system1
   ```
2. Install packages:
   ```
   composer install
   ```
3. Create the environment file and key:
   ```
   copy .env.example .env
   php artisan key:generate
   ```
4. Start MySQL and create an empty database named `student_ms`.
5. In `.env`, set:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=student_ms
   DB_USERNAME=root
   DB_PASSWORD=
   ```
6. Create the tables and add the sample data:
   ```
   php artisan migrate
   php artisan db:seed --class=UserSeeder
   php artisan db:seed --class=RegistrationSampleSeeder
   ```
7. Start the app and open http://127.0.0.1:8000/login:
   ```
   php artisan serve
   ```

Do not run `php artisan migrate:fresh` on a database that holds other data.

## User Roles and Sample Logins

| Role | Email | Password |
|---|---|---|
| Administrator | admin@campus.test | Admin@12345 |
| Lecturer | lecturer@campus.test | Lecturer@12345 |
| Student | student@campus.test | Student@12345 |

These accounts are for local testing only.

- **Administrator:** manages students, courses, lecturers and all registrations.
- **Lecturer:** views assigned courses and the students registered for them.
- **Student:** views open courses, registers for a course and views their own registrations.
- screenshots<img width="959" height="539" alt="leacturer features" src="https://github.com/user-attachments/assets/7d65f319-296c-43e2-b8c0-0ab17b355e5a" />
<img width="959" height="539" alt="class list" src="https://github.com/user-attachments/assets/7b063097-73ef-4573-aa34-bc717ec176ae" />
<img width="959" height="539" alt="browsw registrations" src="https://github.com/user-attachments/assets/fd92cf31-e74a-4be1-99c5-6055f5d5c3d8" />
<img width="959" height="539" alt="admin previledges" src="https://github.com/user-attachments/assets/a02be78b-4682-4e44-af41-29683aa1d28d" />
<img width="959" height="539" alt="admin dashboard" src="https://github.com/user-attachments/assets/6daaf518-9c07-49b6-867c-11f129354293" />
<img width="959" height="539" alt="aceess" src="https://github.com/user-attachments/assets/279e581c-26a2-4856-8898-3f4b1d87d39f" />
<img width="959" height="539" alt="student view courses" src="https://github.com/user-attachments/assets/4af7f156-3ecf-4b06-9dd4-375033f8f338" />
<img width="955" height="531" alt="student records" src="https://github.com/user-attachments/assets/54cf2dcc-343f-4ffd-ab18-55acef9fef55" />
<img width="959" height="539" alt="student dashborad" src="https://github.com/user-attachments/assets/aad9d8c8-cb85-4a03-a216-f35ea89a7849" />
<img width="959" height="539" alt="sign in" src="https://github.com/user-attachments/assets/188cc352-bdde-4f46-9f71-1c48d399477a" />
<img width="959" height="539" alt="lecturer dashboard" src="https://github.com/user-attachments/assets/d8c1a9e5-f747-478e-8a7c-84cab69c7222" />
