@extends('backend.layouts.app')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Category</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="cat_name">Category Name</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Name" value="{{ old('cat_name') }}">
                            @error('cat_name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cat_url">Category URL</label>
                            <input type="text" id="cat_url" class="form-control" name="cat_url" placeholder="URL" value="{{ old('cat_name') }}">
                            @error('cat_url')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Categories</h4>
                    </div>
                    <div class="card-content">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>URL</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $cat)
                                            <tr>
                                                <td class="text-bold-500">{{ $cat->id }}</td>
                                                <td class="text-bold-500">{{ $cat->cat_name }}</td>
                                                <td>{{ $cat->cat_url }}</td>
                                                <td>
                                                    <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update">
                                                        <i class="bi bi-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-category-form-{{ $cat->id }}').submit()"><i class="bi bi-trash"></i></button>
                                                    <form id="delete-category-form-{{ $cat->id }}" class="d-inline-flex" action="{{ route('categories.destroy',$cat->id) }}" method="post" style="display:none;">
                                                        @csrf 
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection