<?php
class CheckoutController extends Controller
{
    private function calcTotal(array $items): int
    {
        $t = 0;
        foreach ($items as $it) $t += ((int)$it['price']) * ((int)$it['qty']);
        return $t;
    }

    public function indexAction(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        $cartItems = array_values($cart);

        $productTotal = $this->calcTotal($cartItems);
        $deliveryCharge = ($productTotal > 0) ? 80 : 0;
        $grandTotal = $productTotal + $deliveryCharge;

        $errors = ['name'=>'','email'=>'','phone'=>'','address'=>'','city'=>'','postal'=>''];
        $values = ['name'=>'','email'=>'','phone'=>'','address'=>'','city'=>'','postal'=>''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $values['name'] = trim($_POST['name'] ?? '');
            $values['email'] = trim($_POST['email'] ?? '');
            $values['phone'] = trim($_POST['phone'] ?? '');
            $values['address'] = trim($_POST['address'] ?? '');
            $values['city'] = trim($_POST['city'] ?? '');
            $values['postal'] = trim($_POST['postal'] ?? '');

            $ok = true;

            if (strlen($values['name']) < 3) { $errors['name'] = 'Name must be at least 3 characters.'; $ok = false; }
            if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) { $errors['email'] = 'Invalid email format.'; $ok = false; }
            if (!preg_match('/^\d{11}$/', $values['phone'])) { $errors['phone'] = 'Phone number must be exactly 11 digits.'; $ok = false; }

            if ($productTotal <= 0) {
                $_SESSION['flash_error'] = 'Cart is empty. Please add items first.';
                redirect('cart/index');
            }

            // Stock check
            foreach ($cartItems as $it) {
                $stock = Product::stock((int)$it['id']);
                if ($stock > 0 && (int)$it['qty'] > $stock) {
                    $_SESSION['flash_error'] = "Only {$stock} item(s) available for {$it['title']}."; 
                    redirect('cart/index');
                }
            }

            if ($ok) {
                $billing = $values;
                $billingJson = json_encode($values, JSON_UNESCAPED_UNICODE);
                $shippingJson = $billingJson; // same fields for now
                $itemsJson = json_encode($cartItems, JSON_UNESCAPED_UNICODE);

                $orderDbId = Order::create([
                    'customer_name' => $values['name'],
                    'total_amount' => $grandTotal,
                    'status' => 'Pending',
                    'shipping_address' => $shippingJson ?: '{}',
                    'billing_address' => $billingJson ?: '{}',
                    'order_items' => $itemsJson ?: '[]',
                    'email' => $values['email'],
                ]);

                // Clear cart
                $_SESSION['cart'] = [];

                redirect('order/success', ['id' => $orderDbId]);
            }
        }

        $this->render('checkout/index', [
            'cartItems' => $cartItems,
            'productTotal' => $productTotal,
            'deliveryCharge' => $deliveryCharge,
            'grandTotal' => $grandTotal,
            'errors' => $errors,
            'values' => $values,
        ]);
    }
}
