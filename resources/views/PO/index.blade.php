@extends('master')

@section('title')
    <title>Purchase Order</title>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Purchase Orders</h1>
            <a href="{{ route('PO.create') }}" class="btn btn-primary ml-auto">Tambah Purchase Order</a>
        </div>
        <div class="section-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No PO</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Jumlah Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseOrders as $po)
                        <tr>
                            <td>{{ $po->number }}</td>
                            <td>{{ $po->date }}</td>
                            <td>{{ $po->supplier }}</td>
                            <td>{{ $po->items->count() }}</td>
                            <td>
                                <a href="{{ route('PO.show', $po->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('PO.edit', $po->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('PO.destroy', $po->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
