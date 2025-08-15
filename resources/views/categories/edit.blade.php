@extends('master')

@section('title')
    <title>Edit Categories</title>
@endsection

@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Edit Categories</h1>
        </section>
        <section class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Categories</h4>
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
                    <form action="{{ route('category.update', $category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <table class="table table-bordered">
                            <tr>
                                <td>Nama</td>
                                <td><input type="text" class="form-control" name="name" autocomplete="off" value="{{ $category->name}}"></td>
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
