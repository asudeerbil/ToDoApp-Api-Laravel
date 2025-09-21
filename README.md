# ToDoApp API (Laravel)

A production-style **RESTful To-Do API** built with **Laravel**.  
It showcases clean layering with **Controllers → Services/Policies → Eloquent (ORM)**, secure **Token-based Authentication (Laravel Sanctum)**, robust **validation**, and developer-friendly docs/testing.  
Designed for real-world usage: **CRUD endpoints**, **search/filter/sort**, **pagination**, **error handling**, and **rate limiting**.

---

## Features

- **Auth with Laravel Sanctum**
  - Register/Login/Logout, Personal Access Tokens.
  - Protects all `/api/*` task routes with `auth:sanctum`.

- **Tasks CRUD**
  - `tasks` resource with create/read/update/delete.
  - Optional **soft-delete** & restore (if enabled).

- **Search, Filter, Sort, Paginate**
  - Query params: `q` (title/description), `status` (`todo|in_progress|done`), `priority` (`low|medium|high`), `due_before`, `due_after`.
  - `sort` (e.g. `-created_at`, `priority`) and `page` for pagination.

- **Validation & Policies**
  - Form Request validation for all writes.
  - Policies restrict access (users can only manage their own tasks).

- **Error Handling & API Responses**
  - Consistent JSON error format (422 validation, 401/403 auth, 404 not found).

- **Testing & Tooling**
  - **PHPUnit** feature tests for auth and task endpoints.
  - Optional **Postman Collection** for manual testing.

---

## Tech Stack

- **Laravel 10/11** — Routing, Controllers, Middleware, Validation, Policies
- **Eloquent ORM** — Models, Relationships, Query Builder, Soft Deletes (optional)
- **Laravel Sanctum** — Token-based API authentication
- **MySQL/SQLite** — Migrations & Seeders, Indexes & Constraints
- **Composer / npm & Vite** — Dependencies & assets (if you expose a minimal UI)
- **PHPUnit** — Feature & unit tests
- **Postman / Artisan tinker** — Manual testing

---
