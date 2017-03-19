@if(count($products))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price(Gh&#162;)</th>
            <th>Categories</th>
            <th>In Stock</th>
            <th style="width: 140px">Actions</th>
        </tr>
    </thead>

    <tbody>
     @foreach($products as $product)
        <?php
            $alertClass = '';

            if ($product->in_stock < 5) {
                $alertClass = 'danger';
            } else if ($product->in_stock < 15) {
                $alertClass = 'warning';
            }
        ?>

         <tr class="{{ $alertClass }}">
             <td>{{ $product->name }}</td>
             <td>{{ $product->unit_price }}</td>
             <td>
         	    <?php $classifications = $product->classifications; ?>
                @if(count($classifications))
             	    @foreach($classifications as $classification)
             	        {{ $classification->name }} <br />
             	    @endforeach
                @else
                    None
                @endif
             </td>
             <td>{{ $product->in_stock }}</td>
             <td>
             	<button class="btn btn-success btn-sm restock" data-toggle="modal" data-target="#restock-product" data-id="{{ $product->id }}"><i class="fa fa-refresh"></i></button>
             	<button class="btn btn-info btn-sm update-product" data-id="{{ $product->id }}"><i class="fa fa-pencil"></i></button>
             	<button class="btn btn-danger btn-sm delete-product" data-id="{{ $product->id }}"><i class="fa fa-trash-o"></i></button>
             </td>
         </tr>
     @endforeach
     </tbody>
 </table>
 @else
 <div class="well">
     <p>No products added yet</p>
 </div>
 @endif