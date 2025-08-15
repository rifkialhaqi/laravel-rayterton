@extends('master')

@section('title')
    <title>Edit Products</title>
@endsection

@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Edit Products</h1>
        </section>
        <section class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Products</h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('product.update', $product->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <table class="table table-bordered">
                            <tr>
                                <td>SKU</td>
                                <td><input type="text" class="form-control" name="sku" autocomplete="off"
                                        value="{{ $product->sku }}"></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td><input type="text" class="form-control" name="name" autocomplete="off"
                                        value="{{ $product->name }}"></td>
                            </tr>
                            <tr>
                                <td>Kategori ID</td>
                                <td>
                                    <select name="category_id" class="form-control" value="{{ $product->category_id }}">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><input type="text" class="form-control" name="price" autocomplete="off"
                                        value="{{ $product->price }}"></td>
                            </tr>
                            <tr>
                                <td>stock</td>
                                <td><input type="text" class="form-control" name="stock"
                                        value="{{ $product->stock }}"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><button class="btn btn-primary" type="submit">Save</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </section>
    </section>
@endsection
