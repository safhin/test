@extends('backend.layouts.app')

@section('content')
    <div class="page-content">
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-md-12">
                    <div class="card">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($posts) > 0)
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td class="text-bold-500">{{ $post->id }}</td>
                                                    <td class="text-bold-500">{{ $post->title }}</td>
                                                    <td width="450px">{!! $post->description !!}</td>
                                                    <td class="text-bold-500">{{ $post->tag->tag_name }}</td>
                                                    <td class="text-bold-500">{{ $post->category->cat_name }}</td>
                                                    <td><img class="post_img" src="{{ asset($post->image) }}" alt=""></td>
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
    </div>
@endsection