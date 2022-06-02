@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah data {{ $item->title }}</h1>
      </div>

      <!-- Content Row -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('product.update', $item->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Paket event</label>
                        <select name="category_id" required class="form-control">
                            <option value="{{ $item->category_id }}">Jangan Ubah</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $item->title }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" name="location" placeholder="Location" value="{{ $item->location }}">
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" rows="10" class="d-block w-100 form-control">{{ $item->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ $item->price }}">
                    </div>
                    @if($category->id =='6')
                    <div class="form-group">erPrice</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
                    </div>
                                @else
                               <td>div class="form-group">ee</label>
                        <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
                    </div></td>
                            
                               
                                @endif
                    <button type="submit" class="btn btn-primary btn-block">
                        Ubah
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
