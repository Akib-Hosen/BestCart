<?php
class OrderController extends Controller
{
    public function successAction(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $order = $id > 0 ? Order::find($id) : null;
        $this->render('order/success', ['order' => $order]);
    }

    public function historyAction(): void
    {
        $orders = Order::all(50);
        $this->render('order/history', ['orders' => $orders]);
    }

    public function invoiceAction(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $order = $id > 0 ? Order::find($id) : null;
        $items = [];
        if ($order && !empty($order['order_items'])) {
            $decoded = json_decode($order['order_items'], true);
            if (is_array($decoded)) $items = $decoded;
        }
        $this->render('order/invoice', ['order' => $order, 'items' => $items]);
    }
}
