@if(count($orders))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Total(GHS)</th>
            <th>Items</th>
            <th>Status</th>
            <th style="width: 100px">Actions</th>
        </tr>
    </thead>

    <tbody>
     @foreach($orders as $order)
        <tr>
             <td>{{ $order->viewable_id }}</td>
             <td>{{ $order->total }}</td>
             <td>
                 @if(count($order->details))
                     @foreach($order->details as $detail)
                     {{ $detail->product->name }}<br />
                     @endforeach
                @else
                No items specified
                @endif
             </td>
             <td>{{ $order->status == 'PENDING_SALE' ? 'Pending Sale' : 'Processed' }}</td>
             <td>
                <!-- Action buttons for cashiers -->
                @if(Auth::user()->isCashier())
                <button class="btn btn-success btn-sm process-order {{ $order->status == 'PROCESSED' ? 'disabled' : '' }}" 

                @if($order->status == 'PENDING_SALE')
                data-toggle="modal" data-target="#add-sale" 
                @endif

                data-id="{{ $order->viewable_id }}"><i class="fa fa-sign-out"></i></button>
                <button class="btn btn-warning btn-sm print-receipt {{ $order->status == 'PENDING_SALE' ? 'disabled' : '' }}" data-id="{{ $order->id }}"><i class="fa fa-print"></i></button>
                @endif

                <!-- Action buttons for pharmacists -->
                @if(Auth::user()->isPharmacist())
             	<button class="btn btn-info btn-sm update-order  {{ $order->status == 'PROCESSED' ? 'disabled' : '' }}" 

                @if($order->status == 'PENDING_SALE')
                data-toggle="modal" data-target="#order-details" 
                @endif

                data-id="{{ $order->viewable_id }}"><i class="fa fa-pencil"></i></button>

             	<button class="btn btn-danger btn-sm delete-order {{ $order->status == 'PROCESSED' ? 'disabled' : '' }}" data-id="{{ $order->id }}"><i class="fa fa-trash-o"></i></button>
                @endif
             </td>
         </tr>
     @endforeach
     </tbody>
 </table>
 @else
 <div class="well">
     <p>No orders placed yet</p>
 </div>
 @endif