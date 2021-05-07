@extends('backend.layouts.app')

@section('content')


    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Posts</h4>
                    </div>
                    <div class="card-content">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITLE</th>
                                        <th>DESCRPTION</th>
                                        <th>TAG</th>
                                        <th>CATEGORY</th>
                                        <th>IMAGE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($posts) > 0)
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td class="text-bold-500">{{ $post->id }}</td>
                                                <td width="300px" class="text-bold-500">{{ $post->title }}</td>
                                                <td width="300px">{!! Str::words($post->description, 10, '...') !!}</td>
                                                <td class="text-bold-500">{{ $post->tag->tag_name }}</td>
                                                <td class="text-bold-500">{{ $post->category->cat_name }}</td>
                                                <td><img class="post_img" src="{{ asset($post->image) }}" alt=""></td>
                                                <td widith="150px"> 
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="action-btn btn btn-primary btn-sm d-inline-flex" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="action-btn btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-category-form-{{ $post->id }}').submit()"><i class="bi bi-trash"></i></button>
                                                    <form id="delete-category-form-{{ $post->id }}" action="{{ route('posts.destroy',$post->id) }}" method="post" style="display:none;">
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