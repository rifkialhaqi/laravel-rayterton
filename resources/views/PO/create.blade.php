@extends('master')

@section('title')
    <title>Tambah Purchase Order</title>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Purchase Order</h1>
        </div>
        <div class="section-body">
            <form action="{{ route('PO.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>No PO</label>
                    <input type="text" name="number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" name="supplier" class="form-control" required>
                </div>
                <hr>
                <h5>Item Barang</h5>
                <div id="items">
                    <div class="row mb-2">
                        <div class="col-md-5">
                            <select name="items[0][product_id]" class="form-control product-select" required>
                                <option value="">Pilih Produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="items[0][quantity]" class="form-control" placeholder="Qty" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="items[0][price]" class="form-control price-input"
                                placeholder="Harga" required>
                        </div>
                    </div>
                </div>
                <button type="button" id="addItem" class="btn btn-secondary btn-sm">Tambah Item</button>
                <br><br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let itemIndex = 1;
        document.getElementById('addItem').onclick = function() {
            let itemsDiv = document.getElementById('items');
            let html = `
        <div class="row mb-2">
            <div class="col-md-5">
                <select name="items[${itemIndex}][product_id]" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Qty" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${itemIndex}][price]" class="form-control" placeholder="Harga" required>
            </div>
        </div>
        `;
            itemsDiv.insertAdjacentHTML('beforeend', html);
            itemIndex++;
        }
        $(document).on('change', '.product-select', function() {
            var price = $(this).find(':selected').data('price');
            $(this).closest('.row').find('.price-input').val(price);
        });
    </script>
@endpush
