@extends('frontend.layouts.app')

@section('content')
    <section class="s-content">
        <!-- page header
        ================================================== -->
        <div class="s-pageheader">
            <div class="row">
                <div class="column large-12">
                    <h1 class="page-title">
                        <span class="page-title__small-type">Category</span>
                        {{ $category->cat_name }}
                    </h1>
                </div>
            </div>
        </div> <!-- end s-pageheader-->
        

        <!-- masonry
        ================================================== -->
        <div class="s-bricks s-bricks--half-top-padding">

            <div class="masonry">
                <x-frontend.article :posts="$posts"/>
            </div> <!-- end masonry -->

            {{ $posts->links('vendor.pagination.custom') }}

        </div> <!-- end s-bricks -->

    </section>
@endsection