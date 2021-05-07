<div class="bricks-wrapper h-group" style="position: relative; height: 2373px;">

    <div class="grid-sizer"></div>

    <div class="lines">
        <span></span>
        <span></span>
        <span></span>
    </div>
    @foreach ($posts as $post)
        
        <article class="brick entry aos-init aos-animate" data-aos="fade-up" style="position: absolute; left: 0%; top: 0px;">

            <div class="entry__thumb">
                <a href="single-standard.html" class="thumb-link">
                    <img src="{{ $post->image }}" alt="">
                </a>
            </div> <!-- end entry__thumb -->

            <div class="entry__text">
                <div class="entry__header">
                    <h1 class="entry__title"><a href="{{ route('post',$post->slug) }}">{{ $post->title }}</a></h1>
                    
                    <div class="entry__meta">
                        <span class="byline" "="">By:
                            <span class="author">
                                <a href="https://www.dreamhost.com/r.cgi?287326">StyleShout</a>
                        </span>
                    </span>
                    <span class="byline" "="">Category:
                        <span class="cat-links">
                            <a href="https://www.dreamhost.com/r.cgi?287326">{{ $post->category->cat_name }}</a>
                        </span>
                    </span>
                    <span class="byline" "="">Tags:
                        <span class="cat-links">
                            <a href="https://www.dreamhost.com/r.cgi?287326">{{ $post->tag->tag_name }}</a>
                        </span>
                    </span>
                    </div>
                </div>
                <div class="entry__excerpt">
                    <p>
                        {!! $post->description !!}
                    </p>
                </div>
                <a class="entry__more-link" href="{{ route('post',$post->slug) }}">Learn More</a>
            </div> <!-- end entry__text -->
        
        </article> <!-- end article -->
    @endforeach

</div> <!-- end brick-wrapper -->