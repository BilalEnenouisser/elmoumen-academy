<<<<<<< HEAD
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
=======
<div data-state="active" data-orientation="horizontal" role="tabpanel" aria-labelledby="radix-:r10:-trigger-preview" id="radix-:r10:-content-preview" tabindex="0" class="mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" style=""><div class="border border-border rounded-lg bg-background p-6 shadow-sm"><div class="prose prose-sm md:prose-base lg:prose-lg max-w-none prose-headings:font-bold prose-a:text-blue-600" style="user-select: none;"><div id="top" class="">

<div align="center" class="text-center">
<h1>ELMOUMEN-ACADEMY</h1>
<p><em>Empowering Minds, Igniting Future Success Daily</em></p>

<img alt="last-commit" src="https://img.shields.io/github/last-commit/BilalEnenouisser/elmoumen-academy?style=flat&amp;logo=git&amp;logoColor=white&amp;color=0080ff" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="repo-top-language" src="https://img.shields.io/github/languages/top/BilalEnenouisser/elmoumen-academy?style=flat&amp;color=0080ff" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="repo-language-count" src="https://img.shields.io/github/languages/count/BilalEnenouisser/elmoumen-academy?style=flat&amp;color=0080ff" class="inline-block mx-1" style="margin: 0px 2px;">
<p><em>Built with the tools and technologies:</em></p>
<img alt="JSON" src="https://img.shields.io/badge/JSON-000000.svg?style=flat&amp;logo=JSON&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="Markdown" src="https://img.shields.io/badge/Markdown-000000.svg?style=flat&amp;logo=Markdown&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="npm" src="https://img.shields.io/badge/npm-CB3837.svg?style=flat&amp;logo=npm&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="Autoprefixer" src="https://img.shields.io/badge/Autoprefixer-DD3735.svg?style=flat&amp;logo=Autoprefixer&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="PostCSS" src="https://img.shields.io/badge/PostCSS-DD3A0A.svg?style=flat&amp;logo=PostCSS&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="Composer" src="https://img.shields.io/badge/Composer-885630.svg?style=flat&amp;logo=Composer&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<br>
<img alt="JavaScript" src="https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=flat&amp;logo=JavaScript&amp;logoColor=black" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="XML" src="https://img.shields.io/badge/XML-005FAD.svg?style=flat&amp;logo=XML&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="PHP" src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&amp;logo=PHP&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="Vite" src="https://img.shields.io/badge/Vite-646CFF.svg?style=flat&amp;logo=Vite&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
<img alt="Axios" src="https://img.shields.io/badge/Axios-5A29E4.svg?style=flat&amp;logo=Axios&amp;logoColor=white" class="inline-block mx-1" style="margin: 0px 2px;">
</div>
<br>
<hr>
<h2>Table of Contents</h2>
<ul class="list-disc pl-4 my-0">
<li class="my-0"><a href="#overview">Overview</a></li>
<li class="my-0"><a href="#getting-started">Getting Started</a>
<ul class="list-disc pl-4 my-0">
<li class="my-0"><a href="#prerequisites">Prerequisites</a></li>
<li class="my-0"><a href="#installation">Installation</a></li>
<li class="my-0"><a href="#usage">Usage</a></li>
<li class="my-0"><a href="#testing">Testing</a></li>
</ul>
</li>
</ul>
<hr>
<h2>Overview</h2>
<p>elmoumen-academy is a comprehensive open-source platform built on Laravel, designed to facilitate the development of scalable and feature-rich educational websites. It offers a modular architecture, extensive models, controllers, and Blade templates, enabling rapid deployment and efficient content management.</p>
<p><strong>Why elmoumen-academy?</strong></p>
<p>This project aims to simplify building educational web applications with a focus on content organization and user engagement. The core features include:</p>
<ul class="list-disc pl-4 my-0">
<li class="my-0">🎨 <strong>🧩 Modular Architecture:</strong> Organized MVC components for scalable development.</li>
<li class="my-0">🚀 <strong>🔧 Pre-configured Environment:</strong> Includes seeders, migrations, and configuration files for quick setup.</li>
<li class="my-0">📚 <strong>🖥️ Rich UI Components:</strong> Blade templates and layout files for a consistent user experience.</li>
<li class="my-0">📊 <strong>📈 Analytics &amp; Content Management:</strong> Built-in tools for tracking engagement and managing educational resources.</li>
<li class="my-0">🔒 <strong>🔑 Role-Based Access &amp; Security:</strong> Middleware and permission configurations for secure operations.</li>
</ul>
<hr>
<h2>Getting Started</h2>
<h3>Prerequisites</h3>
<p>This project requires the following dependencies:</p>
<ul class="list-disc pl-4 my-0">
<li class="my-0"><strong>Programming Language:</strong> PHP</li>
<li class="my-0"><strong>Package Manager:</strong> Npm, Composer</li>
</ul>
<h3>Installation</h3>
<p>Build elmoumen-academy from the source and install dependencies:</p>
<ol>
<li class="my-0">
<p><strong>Clone the repository:</strong></p>
<pre><code class="language-sh">❯ git clone https://github.com/BilalEnenouisser/elmoumen-academy
</code></pre>
</li>
<li class="my-0">
<p><strong>Navigate to the project directory:</strong></p>
<pre><code class="language-sh">❯ cd elmoumen-academy
</code></pre>
</li>
<li class="my-0">
<p><strong>Install the dependencies:</strong></p>
</li>
</ol>
<p><strong>Using <a href="https://www.npmjs.com/">npm</a>:</strong></p>
<pre><code class="language-sh">❯ npm install
</code></pre>
<p><strong>Using <a href="https://www.php.net/">composer</a>:</strong></p>
<pre><code class="language-sh">❯ composer install
</code></pre>
<h3>Usage</h3>
<p>Run the project with:</p>
<p><strong>Using <a href="https://www.npmjs.com/">npm</a>:</strong></p>
<pre><code class="language-sh">npm start
</code></pre>
<p><strong>Using <a href="https://www.php.net/">composer</a>:</strong></p>
<pre><code class="language-sh">php {entrypoint}
</code></pre>
<h3>Testing</h3>
<p>Elmoumen-academy uses the {<strong>test_framework</strong>} test framework. Run the test suite with:</p>
<p><strong>Using <a href="https://www.npmjs.com/">npm</a>:</strong></p>
<pre><code class="language-sh">npm test
</code></pre>
<p><strong>Using <a href="https://www.php.net/">composer</a>:</strong></p>
<pre><code class="language-sh">vendor/bin/phpunit
</code></pre>
<hr>
<div align="left" class=""><a href="#top">⬆ Return</a></div>
<hr></div></div></div></div>
>>>>>>> f7a520cd754dd564803dd9811855549aca13b1ad
