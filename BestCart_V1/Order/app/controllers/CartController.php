<?php
class CartController extends Controller
{
    private function ensureCart(): void
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // [productId => ['id','title','price','qty','img']]
        }
    }

    public function indexAction(): void
    {
        $this->ensureCart();

        $flashError = $_SESSION['flash_error'] ?? '';
        unset($_SESSION['flash_error']);

        $cartItems = array_values($_SESSION['cart']);
        $total = 0;
        foreach ($cartItems as $it) {
            $total += ((int)$it['price']) * ((int)$it['qty']);
        }

        // Catalog from DB (products table)
        $catalog = Product::all(20);

        $this->render('cart/index', [
            'flashError' => $flashError,
            'cartItems' => $cartItems,
            'total' => $total,
            'catalog' => $catalog,
        ]);
    }

    public function addAction(): void
    {
        $this->ensureCart();
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) redirect('cart/index');

        $p = Product::find($id);
        if (!$p) {
            $_SESSION['flash_error'] = 'Product not found.';
            redirect('cart/index');
        }

        // Stock check
        $stock = (int)$p['quantity'];
        $existingQty = isset($_SESSION['cart'][$id]) ? (int)$_SESSION['cart'][$id]['qty'] : 0;
        if ($stock > 0 && ($existingQty + 1) > $stock) {
            $_SESSION['flash_error'] = 'Only ' . $stock . ' item(s) available for ' . $p['name'] . '.';
            redirect('cart/index');
        }

        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'id' => (int)$p['id'],
                'title' => $p['name'],
                'price' => (float)$p['price'],
                'qty' => 1,
                'img' => $p['image'] ?: 'default.png',
            ];
        } else {
            $_SESSION['cart'][$id]['qty'] += 1;
        }

        redirect('cart/index');
    }

    public function removeAction(): void
    {
        $this->ensureCart();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            unset($_SESSION['cart'][$id]);
        }
        redirect('cart/index');
    }

    public function updateqtyAction(): void
    {
        $this->ensureCart();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('cart/index');

        $pid = (int)($_POST['id'] ?? 0);
        $qty = (int)($_POST['qty'] ?? 1);

        if ($pid > 0 && isset($_SESSION['cart'][$pid])) {
            if ($qty < 1) $qty = 1;
            if ($qty > 99) $qty = 99;

            $stock = Product::stock($pid);
            if ($stock > 0 && $qty > $stock) {
                $qty = $stock;
                $_SESSION['flash_error'] = "Only {$qty} item(s) available for {$_SESSION['cart'][$pid]['title']}."; 
            }
            $_SESSION['cart'][$pid]['qty'] = $qty;
        }
        redirect('cart/index');
    }
}
