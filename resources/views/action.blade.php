<!-- action.blade.php -->
@if($order->status == 'pending')
    <button class="btn btn-success btn-sm update-status" data-order-id="{{ $order->id }}">Mark as Completed</button>
@endif
