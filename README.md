# Elmoumen Academy

Modern Laravel 10 platform for managing academic content: levels, years (années), filières, subjects, videos, PDFs, teachers, sessions, testimonials, and more.

---

## Overview

Elmoumen Academy is a full-featured educational portal built with Laravel 10 and Tailwind CSS. It provides an admin back-office to manage the academic structure (Levels, Years, Fields), learning content (Subjects, Study Materials, Videos, PDFs), and the public-facing pages for students and visitors. Role-based access control is powered by Spatie Permissions.

Key highlights:

- Admin “Structure” screen to create/manage Levels, Années (Years), Filières (Fields), and Subjects.
- Teacher workflow for uploading and organizing course materials (videos, PDFs), with click/download tracking.
- Public catalog pages for browsing levels/years, subjects, testimonials, and videos.
- Analytics service and activity/session tracking for teachers and users.

## Tech Stack

- Backend: PHP 8.1+, Laravel Framework ^10
- Auth: Laravel Breeze + Sanctum
- RBAC: spatie/laravel-permission ^6
- Frontend tooling: Vite, Tailwind CSS, PostCSS
- Testing: PHPUnit 10

## Core Features

- Academic structure management
	- Levels (e.g., Collège, Lycée, etc.)
	- Years (Années) per Level with optional cover image
	- Fields (Filières) for Lycée years
	- Subjects bound to Level/Year/(Field)
- Learning content
	- Study materials grouped into blocks (videos, PDFs)
	- Video/PDF click and download tracking
	- Categories for videos
- Teacher portal
	- Material creation, editing, and organization
	- Teacher sessions and activity tracking
- Marketing and UX
	- Testimonials, marquee, WhatsApp contacts, landing pages
	- Page view analytics

## Project Structure

Notable directories and what they contain:

- `app/Models`
	- `Level`, `Year`, `Field`, `Subject` — academic structure
	- `StudyMaterial`, `MaterialBlock`, `MaterialVideo`, `MaterialPdf`, and clicks/downloads — learning content
	- `Video`, `VideoCategory`, `Book`, `BookCategory` — media and resources
	- `Teacher`, `TeacherSession`, `TeacherActivity`, `UserSession` — engagement and sessions
	- `Testimonial`, `Marquee`, `PageView`, `Message`, `WhatsAppNumber` — UX, communications, and analytics
- `app/Http/Controllers`
	- Public pages, admin resources (e.g., `Admin/YearController`), teacher area
- `app/Services/AnalyticsService.php`
	- Encapsulated analytics-related logic
- `resources/views`
	- Tailwind-powered Blade views for public, admin, teacher interfaces
- `routes`
	- Key entry points: `web.php`, `auth.php`, `api.php` and the Admin/Teacher routes

## Data Model (at a glance)

- Level has many Years
- Year belongs to Level; has many Subjects and Study Materials
- Field belongs to a Level, often associated with Lycée Years
- Subject belongs to a Level and a Year, and optionally to a Field
- Study Materials group PDFs and Videos via Material Blocks

## Media & Storage

- Year images are stored on the public storage disk at `storage/years/...` (served via the `/storage` URL).
- Legacy entries that used `public/images/years/...` continue to display and are cleaned up on updates/deletes.
- Other assets (videos, PDFs) are managed via their respective models and blocks.

## Key Screens & URLs

- Admin Structure: `/admin/structure`
	- Create/edit Levels, Années (Years), Fields, and Subjects
- Courses catalog: `/courses/*` (e.g., `level`, `lycee`)
- Teacher dashboard and materials: `/teacher/*`
- Videos by category: `/videos/category/*`

## Configuration Notes

- Set `APP_URL` appropriately for correct asset and storage URLs.
- The default `public` filesystem disk serves files from `storage/app/public` via the `/storage` path.
- RBAC is provided by `spatie/laravel-permission`; define roles/permissions according to your needs.

## Testing

- PHPUnit test scaffolding is available in `tests/` with `phpunit.xml` configured.

## Security

- Authentication uses Laravel Breeze and Sanctum.
- Validate and sanitize all uploaded files (this project validates image uploads for years).

## Contributing

Contributions are welcome. Please open an issue or pull request describing your change and rationale.

## License

See the repository’s LICENSE file (if provided) for licensing details.
