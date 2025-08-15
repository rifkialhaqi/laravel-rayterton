@extends('master')

@section('title')
    <title>Edit Purchase Order</title>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Purchase Order</h1>
    </div>
    <div class="section-body">
        <form action="{{ route('PO.update', $po->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>No PO</label>
                <input type="text" name="number" class="form-control" value="{{ $po->number }}" required>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ $po->date }}" required>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <input type="text" name="supplier" class="form-control" value="{{ $po->supplier }}" required>
            </div>
            <hr>
            <h5>Item Barang</h5>
            <div id="items">
                @foreach ($po->items as $i => $item)
                <div class="row mb-2">
                    <div class="col-md-5">
                        <select name="items[{{ $i }}][product_id]" class="form-control" required>
                            <option value="">Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" 
                                    data-price="{{ $product->price }}"
                                    {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="items[{{ $i }}][quantity]" class="form-control" value="{{ $item->quantity }}" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="items[{{ $i }}][price]" class="form-control price-input" value="{{ $item->price }}" required>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" id="addItem" class="btn btn-secondary btn-sm">Tambah Item</button>
            <br><br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    let itemIndex = {{ count($po->items) }};
    document.getElementById('addItem').onclick = function() {
        let itemsDiv = document.getElementById('items');
        let html = `
        <div class="row mb-2">
            <div class="col-md-5">
                <select name="items[${itemIndex}][product_id]" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Qty" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${itemIndex}][price]" class="form-control price-input" placeholder="Harga" required>
            </div>
        </div>
        `;
        itemsDiv.insertAdjacentHTML('beforeend', html);
        itemIndex++;
    }
    $(document).on('change', '.form-control[name*="[product_id]"]', function() {
        var price = $(this).find(':selected').data('price');
        $(this).closest('.row').find('.price-input').val(price);
    });
</script>
@endpush