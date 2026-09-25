# 🚀 Anemony — Project Status & Technical Documentation
> **Version:** 1.2.0 • **Last Updated:** 22 September 2026  
> **Status:** Multi-Tenant Core, Storefronts, Super Admin, Merchant Studio & Database Auth Complete ✅

---

## 📌 1. Project Overview (Kya Hai Ye Project?)
**Anemony** ek modern **No-Code Digital Operating System & Multi-Tenant SaaS Platform** hai jo Indian MSMEs (Kirana/Retail Stores, Doctors/Clinics, aur B2B Manufacturing Plants) ko 60 seconds me apna dynamic digital storefront, WhatsApp commerce, aur Google Local SEO enable karta hai.

Platform ek **Decoupled Architecture** par bana hai — jisme ek single unified engine industry ke hisaab se apna user experience, database behavior aur Call-To-Action (CTA) automatically adapt karta hai.

---

## 🛠️ 2. Tech Stack & Infrastructure
- **Framework:** Laravel 12 / 13 (PHP 8.3 / 8.4)
- **Frontend / Reactivity:** Livewire v4 (Full SPA Navigation via `wire:navigate`)
- **CSS / Styling:** Tailwind CSS v4 (`@tailwindcss/vite`)
- **Icons & Typography:** Font Awesome 6.4 (Pro Free icons) + Instrument Sans Font
- **Database:** MySQL (XAMPP on `127.0.0.1:3306`, DB Name: `anemony`)
- **Animations:** AOS (Animate On Scroll) + Cosmic Mesh Gradients
- **Test Suite:** PHPUnit / Pest Feature Tests (11/11 Tests Passing - 100% Success)
- **Version Control:** Git on branch `main` (*Strict rule: Push only on user request*)

---

## 🏗️ 3. Database Architecture (Data Schema)

Humare MySQL database me total **14 tables** migrated aur connected hain:

| Table | Purpose | Key Columns |
| :--- | :--- | :--- |
| **`archetypes`** | Industry rules & CTA behavior | `name`, `code` (`retail`, `service`, `b2b`), `cta_label`, `schema_org_type`, `feature_tags` |
| **`tenants`** | Har merchant/dukaan ka data | `business_name`, `slug`, `archetype_id`, `theme`, `city`, `phone`, `brand_color`, `is_active`, `gst_number`, `seo_meta` |
| **`catalog_items`**| Products, Services, Machinery | `tenant_id`, `title`, `price`, `compare_price`, `category`, `image_url`, `is_available`, `metadata` (MOQ, Duration) |
| **`orders`** | Unified Orders, Bookings & Inquiries | `tenant_id`, `order_number`, `type` (`order`, `booking`, `inquiry`), `customer_name`, `customer_phone`, `total_amount`, `items_payload` (*nullable*), `metadata` |
| **`users`** | Authentication & Roles | `name`, `email`, `password`, `role` (`super_admin`, `merchant`, `customer`), `tenant_id` (*FK to tenants*), `is_active` |
| **`sessions`** | Session storage | `id`, `user_id`, `payload`, `last_activity` |
| **`cache` / `jobs`**| Caching & Background Queues | Performance & cache management |

---

## 🧩 4. Modules Built So Far (Kaha Tak Bana Hai?)

### ✅ Module 1: Main SaaS Landing Page (`/`)
- **Branding:** Sunrise-Rose-Purple Cosmic Swirl Logo & Ambient Glows (`#fb923c` ➔ `#f43f5e` ➔ `#9333ea`).
- **Interactive Solutions:** Tabs for Retail Stores, Clinics/Doctors, and B2B Manufacturing.
- **Live Demo Cards:** 1-Click access to live storefronts with industry badges.
- **Social Proof & Authority:** Google 360 Partner badge, 7,000+ MSME transformation count, testimonials, FAQs.
- **Smart Auth Header:** Logged-in users ko direct unka dashboard dikhata hai, guests ko "Sign In" aur "Super Admin" buttons.
- **WhatsApp Floating Widget:** Instant customer support integration.

---

### ✅ Module 2: Merchant Onboarding Wizard (`/onboarding`)
- **Fast 1-Step Store Launch:** Sirf basic business details (Name, Category, City, Phone) bhari jaati hain.
- **Auto Archetype & Theme Detection:** Selected category ke basis par suitable archetype, theme aur colors automatically assign ho jaate hain.
- **Direct Dashboard Redirect:** Store bante hi merchant seedha apne Merchant Dashboard par pahunchta hai jahan wo Archetype, Themes, aur Colors customize kar sakta hai.

---

### ✅ Module 3: Dynamic Multi-Industry Storefront (`/store/{slug}`)
Ek single dynamic Livewire component ([`StoreHome.php`](file:///D:/laravel/anemony/app/Livewire/StoreHome.php)) jo industry ke hisaab se 3 completely alag websites ka kaam karta hai:
1. **🛒 Retail Mode (e.g. Sharma Kirana):**
   - Real-time shopping cart with slide-over drawer.
   - Quantity increment/decrement, subtotal calculation.
   - 1-Click WhatsApp Checkout (order formatted with delivery address and itemized bill).
2. **🏥 Clinic / Doctor Mode (e.g. Care Dental Clinic):**
   - Doctor qualifications, specializations, consulting hours.
   - "Book Appointment Slot" interactive modal with date, slot selection & patient details.
3. **🏭 B2B Industrial Mode (e.g. Apex Steel Craft):**
   - Minimum Order Quantity (MOQ) displays, technical specifications.
   - "Request a Quote" RFQ modal with company name, custom quantities, and drawings/notes.
4. **💬 Quick Inquiry & Contact Form:**
   - Universal contact message form that saves directly into the database and opens WhatsApp.
   - *Fixed:* `items_payload` nullable support taaki koi bhi bina item wali inquiry crash na ho.
5. **🎨 Decoupled Theme Switcher:**
   - 4 themes built-in: `modern_clean`, `warm_artisan`, `bold_industrial`, `minimal_luxury`.
   - Zero data loss on theme switching.

---

### ✅ Module 4: Merchant Studio & Dashboard (`/store/{slug}/dashboard`)
- **Category Archetype Switcher:** 1-Click archetype switcher (Retail, Healthcare/Clinic, Restaurant, B2B Industrial) with zero data loss.
- **Theme Studio:** 1-Click live theme switcher with instant visual preview (Doctor Clinic, Real Estate, Retail Supermarket, Restaurant, B2B, Salon, Dark Luxury, Minimal Editorial).
- **Brand Accent Palette Customizer:** Color swatches dynamically updating badges, gradients, and CTA highlights.
- **Section Display Toggles:** Hero Trust Pills, Highlights, Reviews, Timings, and Inquiry Form toggles.
- **Catalog Management:** Products/Services add, edit, delete with stock and pricing control.
- **Store Profile & Local SEO:** GST number, business timings, Google Maps coordinates, phone numbers.
- **Orders & Inquiries Inbox:** Store-specific orders and booking requests stream.
- **Multi-Store Switcher:** Dropdown to switch between multiple merchant branches.

---

### ✅ Module 5: Super Admin Command Center (`/admin`)
- **Security:** Protected by role-based auth (`super_admin` only). Guests are automatically redirected to `/login`.
- **Platform KPIs:** Total Tenants, Active vs Suspended stores, Total Catalog Items, Global Orders, Platform GMV (₹).
- **All Stores & Merchants Tab:**
  - Live real-time search by Store Name, Slug, or City.
  - Filter by Archetype (Retail, Service, B2B).
  - "Deploy New Store" modal (instant store provision without full onboarding).
  - "Edit Store" modal (change business name, slug, phone, city, theme, brand color).
  - Quick Toggle Active/Suspended status.
  - Delete Store option.
  - Direct links to Live Website and Merchant Dashboard.
- **Category Archetypes Manager:** Edit global CTA labels and Schema.org SEO types for all 3 industries.
- **Global Orders & Bookings Feed:** Central live stream of all customer orders across all stores.
- **System & AI Settings:** Configure Google Gemini / OpenAI API keys, WhatsApp Gateway selection, MySQL status.
- **Header Profile & Sign Out:** Displays current admin info with instant logout button.

---

### ✅ Module 6: Unified Authentication System (`/login` & `/logout`)
- Built with Livewire v4 ([`Login.php`](file:///D:/laravel/anemony/app/Livewire/Auth/Login.php) & [`login.blade.php`](file:///D:/laravel/anemony/resources/views/livewire/auth/login.blade.php)).
- Password Show/Hide toggle & "Remember Me" session persistence.
- **⚡ 1-Click Quick Demo Fill Buttons:**
  - `👑 Super Admin` (`admin@anemony.in` / `admin123`)
  - `🏪 Merchant` (`sharma@anemony.in` / `password`)
- **Smart Role-Based Redirection:**
  - Super Admin login ➔ Redirects to **`/admin`**
  - Merchant login ➔ Redirects to **`/store/{slug}/dashboard`**
- **Session Logout:** `/logout` route with CSRF and GET/POST support.

---

## 🌐 5. All Working URLs & Routes

| URL | Route Name | Access Level | Description |
| :--- | :--- | :--- | :--- |
| `http://127.0.0.1:8000/` | `home` | Public | Main SaaS Landing Page |
| `http://127.0.0.1:8000/onboarding` | `onboarding` | Public | 60-Second Store Creation Wizard |
| `http://127.0.0.1:8000/login` | `login` | Guest / Public | Unified Cloud Login (Admin + Merchant) |
| `http://127.0.0.1:8000/logout` | `logout` | Auth Users | Invalidate session & redirect to login |
| `http://127.0.0.1:8000/admin` | `admin.dashboard` | **Super Admin** | Platform Command Center |
| `http://127.0.0.1:8000/store/sharma-kirana` | `store.show` | Public | Live Retail Storefront (Kirana) |
| `http://127.0.0.1:8000/store/care-dental-clinic` | `store.show` | Public | Live Healthcare Clinic Storefront |
| `http://127.0.0.1:8000/store/apex-steel-craft` | `store.show` | Public | Live B2B Manufacturing Storefront |
| `http://127.0.0.1:8000/store/sharma-kirana/dashboard` | `store.dashboard` | Merchant / Admin | Store Theme Studio & Catalog Manager |
| `http://127.0.0.1:8000/dashboard` | `dashboard` | Auth / Admin | Shortcut to latest store dashboard |

---

## 🔑 6. Database Default Credentials

```text
👑 Super Admin:
Email: admin@anemony.in
Password: admin123
Role: super_admin

🏪 Merchant (Sharma Kirana):
Email: sharma@anemony.in
Password: password
Role: merchant (Tenant: sharma-kirana)

🏥 Merchant (Care Dental Clinic):
Email: care@anemony.in
Password: password
Role: merchant (Tenant: care-dental-clinic)
```

---

## 🧪 7. Automated Test Suite (11/11 Passed)

Command to run tests:
```bash
php artisan test
```

Test coverage:
1. `test_the_welcome_landing_page_renders_successfully` ✅
2. `test_the_onboarding_page_renders_successfully` ✅
3. `test_the_retail_storefront_renders_with_retail_cta` ✅
4. `test_the_clinic_storefront_renders_with_appointment_cta` ✅
5. `test_the_b2b_storefront_renders_with_quote_cta` ✅
6. `test_the_login_page_renders_successfully` ✅
7. `test_guest_is_redirected_to_login_from_admin_dashboard` ✅
8. `test_the_super_admin_can_access_dashboard` ✅
9. `test_the_merchant_dashboard_renders_successfully` ✅
10. `test_customer_can_submit_inquiry_without_sql_error` ✅
11. `ExampleTest` default sanity checks ✅

---

## 🔮 8. Upcoming Roadmap / Next Possible Steps
1. **Payment Gateway Integration:** Razorpay / Cashfree UPI QR Code integration for direct payment on retail storefronts.
2. **Meta WhatsApp Cloud API:** Real-time automated WhatsApp message delivery using webhooks.
3. **Custom Domain Mapping:** Allowing merchants to map custom domains (e.g. `sharmakirana.in` ➔ `anemony.in/store/sharma-kirana`).
4. **AI Auto-Catalog Writer:** Using the configured Gemini API key to auto-generate product descriptions and SEO tags from a photo or single keyword.
5. **Customer Order Tracking:** Public tracking page for customers using order number (e.g. `/track/ORD-XXXXXX`).

---
> ⚠️ **Git Note:** As per user instruction, no changes have been pushed to Git remote yet (`origin/main` is untouched).
