---

## 9. How to Get Started in This Project (`anemony`)

1. **Initialize Laravel:**
   ```bash
   composer create-project laravel/laravel .
   ```
2. **Install Core & AI Packages:**
   ```bash
   composer require filament/filament:"^3.2" -W
   composer require spatie/schema-org
   composer require barryvdh/laravel-dompdf
   composer require laravel/sanctum
   composer require guzzlehttp/guzzle
   ```
3. **Set Up AI Services & Migrations:**
   * Configure Google Gemini API keys in `.env`.
   * Create database tables for Tenants, Archetypes, Catalog, and Orders.
