# PureBlooms Demo Cheat Sheet
**For: OM Final Presentation**
**Site: https://37ab-136-239-226-85.ngrok-free.app** (changes per ngrok session — regenerate QR with `python3 regenerate_qr.py`)

---

## DEMO ACCOUNTS (all passwords: demo123)

| Role     | Email                    | Password | Persona           |
|----------|--------------------------|----------|-------------------|
| Admin    | david@pureblooms.com     | demo123  | P1 - David (PM)   |
| Admin    | ruth@pureblooms.com      | demo123  | P2 - Ruth Joy (PM)|
| Admin    | aaron@pureblooms.com     | demo123  | P7 - Aaron Jake   |
| Admin    | novel@pureblooms.com     | demo123  | P8 - Novel        |
| Seller   | johnpaul@pureblooms.com  | demo123  | P5 - John Paul    |
| Seller   | von@pureblooms.com       | demo123  | P6 - Von Eiron    |
| Customer | brix@customer.com        | demo123  | P3 - Brix         |
| Customer | ydel@customer.com        | demo123  | P4 - Ydel Letice  |
| Customer | maria.santos@email.com   | demo123  | Extra customer    |
| Customer | carlos.mendoza@email.com | demo123  | Extra customer    |
| Customer | ana.rodriguez@email.com  | demo123  | Extra customer    |

**Legacy admin:** admin@pureblooms.com / admin123 (from AdminUserSeeder)

---

## SEeded DATA SUMMARY
- 8 categories (Hand Bouquets, Vase Arrangements, Box Flowers, etc.)
- 21 products (price range P1,200 - P6,500)
- 12 addons (gift wrapping, cards, chocolates, candles, teddy bears, etc.)
- 29 settings (shop info, delivery fees, payment, SEO, notifications)
- 11 users (4 admin, 2 seller, 5 customer)
- 8 demo orders covering ALL statuses

### Demo Orders (order numbers: DEMO-0001 to DEMO-0008)
| Order       | Customer | Status     | Payment | Items                              |
|-------------|----------|------------|---------|------------------------------------|
| DEMO-0001   | Brix     | Pending    | COD     | Red Rose Bouquet + wrapping + card |
| DEMO-0002   | Ydel     | Processing | GCash   | Pastel Garden Bouquet + card       |
| DEMO-0003   | Maria    | Shipped    | GCash   | x2 Sunflower Bouquet + wrapping    |
| DEMO-0004   | Carlos   | Delivered  | COD     | White Lily Bouquet + chocolates    |
| DEMO-0005   | Ana      | Delivered  | GCash   | Velvet Box Roses + card + teddy    |
| DEMO-0006   | Brix     | Cancelled  | GCash   | Preserved Eternity Box (failed)    |
| DEMO-0007   | Maria    | Pending    | COD     | x10 Mason Jar Wildflowers corporate|
| DEMO-0008   | Ydel     | Processing | GCash   | Bridal + 4 Bridesmaid bouquets     |

---

## STEP-BY-STEP DEMO FLOW (follows the script acts)

### ACT 2: CUSTOMER EXPERIENCE (P3 Brix, P4 Ydel)
**Login as:** brix@customer.com / demo123

1. **Homepage** (/)
   - Scroll featured products grid slowly
   - Point out: clean layout, categories sidebar, price tags

2. **Product Detail** (click any product, e.g. "Classic Red Rose Bouquet")
   - Show: image, description, price, stock status
   - Click "Add to Cart"

3. **Shopping Cart** (/customer/cart)
   - Show item added, quantity controls
   - OR skip straight to "Buy Now" on a product

4. **Checkout** (/customer/checkout)
   - Show add-ons section: Gift Wrapping, Message Card, etc.
   - Select an add-on (e.g. Premium Gift Wrapping P150)
   - Fill shipping form: 123 Sample Street, Tagudin, Ilocos Sur, 2728
   - Select payment: Cash on Delivery
   - Click "Place Order"

5. **Order Success Page** (/customer/checkout/success/{id})
   - Point out: unique order tracking number
   - Mention: automated confirmation email sent (check Mailpit at :8025)

6. **Order Tracking** (/customer/orders/{id}/track)
   - Show status timeline: Pending -> Processing -> Shipped -> Delivered
   - Emphasize: transparent, no need to DM seller

**Alternative:** Login as ydel@customer.com to show existing orders (DEMO-0002, DEMO-0008)

---

### ACT 3: SELLER EXPERIENCE (P5 John Paul, P6 Von Eiron)
**Login as:** johnpaul@pureblooms.com / demo123 (or david@pureblooms.com for full admin)

1. **Admin Dashboard** (/admin/dashboard)
   - Point to KPI cards: Total Revenue, Total Orders, Pending Orders, Low Stock Alerts
   - Explain: these are real-time KPIs from seeded data

2. **Order Management** (/admin/orders)
   - Show order pipeline with all 8 demo orders
   - Filter by status (Pending, Processing, etc.)
   - Click DEMO-0001 (Pending) -> change status to "Processing" -> "Shipped"
   - Show the customer-facing tracking updates in real-time

3. **Reports** (/admin/reports)
   - Sales Report (/admin/reports/sales): monthly revenue trends
   - Inventory Report (/admin/reports/inventory): stock levels, total inventory value
   - Customer Report (/admin/reports/customers): CRM data, order frequencies

4. **Settings** (/admin/settings)
   - Show: shop name, delivery fees (P150 standard, P300 express)
   - Show: payment toggles (COD enabled, GCash enabled)
   - Show: Maintenance Mode toggle (Planning function of OM)

---

### ACT 4: DEVELOPER PERSPECTIVE (P7 Aaron Jake, P8 Novel)
**No login needed - this is architectural discussion**

Talking points with code references:
- DB Transactions: app/Http/Controllers/CheckoutController.php (checkout wrapped in DB::transaction)
- Server-side price validation: addon prices validated against DB, not client input
- RBAC middleware: app/Http/Middleware/Admin.php (role check)
- Password throttling: route middleware('throttle:3,60') on password update
- Cart token: unique token prevents double-click duplicate orders
- Settings cache: shop settings cached to reduce DB queries
- Maintenance middleware: app/Http/Middleware/MaintenanceMode.php

---

## PRE-DEMO CHECKLIST

1. [ ] Docker containers running: `docker compose up -d`
2. [ ] Database seeded: `docker compose exec laravel.test php artisan migrate:fresh --seed`
3. [ ] Vite built (for stable demo): `docker compose exec laravel.test npm run build`
4. [ ] ngrok tunnel running: `ngrok http 80`
5. [ ] .env APP_URL updated to ngrok URL
6. [ ] QR code regenerated: `python3 regenerate_qr.py`
7. [ ] Test login: david@pureblooms.com / demo123
8. [ ] Test storefront loads at ngrok URL
9. [ ] Mailpit accessible at :8025 for email demo
10. [ ] Presentation slides open (slides.html in browser, fullscreen F11)

## NGROK URL CHANGE PROCEDURE
When ngrok restarts and gives a new URL:

```bash
# 1. Get new URL from ngrok dashboard or terminal
# 2. Update .env
cd "/home/user/Downloads/Pure Blooms"
# Edit .env: APP_URL=https://NEW-URL.ngrok-free.app

# 3. Regenerate QR code
cd org-management-presentation
python3 regenerate_qr.py

# 4. Copy new data URI into slides.html (replace the old data:image/png;base64,...)
# OR just use demo-qr.png as a standalone image on a printed handout

# 5. Clear Laravel config cache
docker compose exec laravel.test php artisan optimize:clear
```

---

## QUICK REFERENCE: ROUTES

| Page                    | URL                          | Access     |
|-------------------------|------------------------------|------------|
| Storefront              | /                            | Public     |
| Login                   | /login                       | Guest      |
| Customer Dashboard      | /customer/dashboard          | Customer   |
| Cart                    | /customer/cart               | Customer   |
| Checkout                | /customer/checkout           | Customer   |
| Order Tracking          | /customer/orders/{id}/track  | Customer   |
| Admin Dashboard         | /admin/dashboard             | Admin      |
| Admin Orders            | /admin/orders                | Admin      |
| Admin Products          | /admin/products              | Admin      |
| Admin Reports           | /admin/reports               | Admin      |
| Admin Settings          | /admin/settings              | Admin      |
| Mailpit (email preview) | :8025                        | Local only |
