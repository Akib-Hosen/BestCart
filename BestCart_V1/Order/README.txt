BESTCART MVC (NO .htaccess)

✅ Converted pages:
- cart -> CartController
- checkout -> CheckoutController
- order_success -> OrderController::success
- invoice -> OrderController::invoice
- order_history -> OrderController::history

✅ Uses your MySQL database: database/webtech.sql
✅ Keeps the same UI/CSS (inline styles kept)

------------------------------------------------------------
1) Import Database (phpMyAdmin)
------------------------------------------------------------
1. Open phpMyAdmin
2. Create a database named: webtech
3. Click the database -> Import
4. Choose: database/webtech.sql
5. Click Go

(If you already have webtech DB, just import the SQL.)

------------------------------------------------------------
2) Put Project in XAMPP / WAMP
------------------------------------------------------------
Copy the folder 'bestcart_mvc' into:
- XAMPP: C:\xampp\htdocs\bestcart_mvc
- WAMP : C:\wamp64\www\bestcart_mvc

------------------------------------------------------------
3) Configure DB Connection
------------------------------------------------------------
Open:
app/config/database.php

Set:
host, user, pass, port
Example:
'host' => '127.0.0.1',
'user' => 'root',
'pass' => '',
'dbname' => 'webtech',

------------------------------------------------------------
4) Run the Project (NO .htaccess)
------------------------------------------------------------
Open in browser:

http://localhost/bestcart_mvc/public/index.php

Routes work like this (query string):
- Cart:     index.php?r=cart/index
- Add:      index.php?r=cart/add&id=1
- Remove:   index.php?r=cart/remove&id=1
- Update:   POST to index.php?r=cart/updateqty
- Checkout: index.php?r=checkout/index
- Success:  index.php?r=order/success&id=ORDER_ID
- Invoice:  index.php?r=order/invoice&id=ORDER_ID
- History:  index.php?r=order/history

------------------------------------------------------------
5) Notes
------------------------------------------------------------
- Products are loaded from DB table: products
- Cart is session-based
- Checkout inserts into DB table: orders
- orders.order_items stores JSON of items
- orders.billing_address stores JSON of billing form fields
