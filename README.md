# SBMN Welfare Association Management

MVP source package for Laravel API + React dashboard.

## Modules
- Dashboard
- Members
- Maintenance payments
- Expenses
- Fixed assets
- Financial reports
- Role-ready user model (Admin/Treasurer/Viewer)
- Public site: notice board, events calendar, committee directory (see `site/`)

## Public site (`site/`)
Static marketing/notice-board page for residents. `site/index.html` calls the same
Laravel API (`notices`, `events`, `committee-members` resources) so anything posted
is stored in the shared database and visible to every visitor, not just the browser
that posted it. Update `API_BASE` at the top of the page's `<script>` (or set
`window.SBMN_API_BASE` before the script runs) if the API isn't on
`http://127.0.0.1:8001/api`. Serve it with any static file server, e.g.
`cd site && python3 -m http.server 8080`.

## Backend setup
The runnable Laravel app lives directly in `backend/` (already scaffolded, MVP source
already copied in). To start from scratch elsewhere:
1. Create a new Laravel project: `composer create-project laravel/laravel backend`
2. Copy the provided `backend/app`, `backend/database`, and `backend/routes/api.php` into it.
3. Register the API routes in `bootstrap/app.php` (`api: __DIR__.'/../routes/api.php'`).
4. Configure `.env` database.
5. Run: `cd backend && php artisan migrate --seed`
6. Run: `php artisan serve --port=8001` (port 8000 may be taken by another local project; keep `APP_URL` in `.env` and `API_BASE` in `site/index.html` matching whatever port you actually use)

## Frontend setup
1. `cd frontend`
2. `npm install`
3. Copy `.env.example` to `.env`
4. `npm run dev`

## Default API URL
`http://127.0.0.1:8001/api`

## Important
This is an MVP starter. Add production authentication, authorization policies, backups, audit logs, tests, and payment gateway credentials before public deployment.
