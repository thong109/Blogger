@extends('layouts.client')
@section('title', $postDetail['name'])
@section('content')
    <div class="jl_block_content">
        <div class="jlc-container">
            <div class="jlc-row">
                @include('shared.client._sidebar')
                <div class="jlc-col-md-8 jl_main_achv jl_achv_tpl_list">
                    <div class="jl_breadcrumbs">
                        <span class="jl_item_bread">
                            <div class="jl_breadcrumbs"> <span class="jl_item_bread">
                                    <a href="{{ route('Home') }}">
                                        Trang chủ </a>
                                </span>
                                <span>/</span>
                                <span class="jl_item_bread">
                                    <a href="{{ route('Home', ['category' => $postDetail->categories->slug]) }}">{{ $postDetail->categories->name }}
                                    </a>
                                </span>
                                <span>/</span>
                                <span class="jl_item_bread">
                                    {{ $postDetail['name'] }} </span>
                            </div>
                        </span>
                    </div>
                    <div class="jl_clear_at block-section jl-main-block jl_wrapper_cat" data-page_current=1 data-page_max=1
                        data-posts_per_page=10 data-order=date_post data-section_style=jl_cat_list data-categories=17>
                        <div class="jl_clear_at">
                            <div class="jl_main_list_cw jl_wrap_eb jl_clear_at jl_lm_list">
                                <div class="jl_fli_wrap jl-roww jl_contain jl-col-row" style="--jlrow-gap:15px">
                                    <div class="jl-wc-img">
                                        <div class="wc-single-featured">
                                            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                                data-columns="4"
                                                style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;">
                                                <figure class="woocommerce-product-gallery__wrapper">
                                                    <img width="100%" height="903" src="{{ $postDetail['image'] }}"
                                                        class="wp-post-imagejl-lazyload ls-is-cached lazyloaded"
                                                        alt="">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jl-wc-dec">
                                        <div class="summary entry-summary">
                                            <div class="woocommerce-product-rating">
                                                <h3 class="entry-title h4" style="margin-bottom: 15px">
                                                    {{ $postDetail['name'] }}</h3>
                                            </div>
                                            <div class="woocommerce-product-details__short-description">
                                                <div class="woocommerce-product-details__short-description"
                                                    style="word-wrap: break-word;">
                                                    {!! $postDetail->content !!}
                                                </div>
                                            </div>
                                            <div class="product_meta">
                                                <span class="posted_in">
                                                    Danh mục: <a
                                                        href="{{ route('Home', ['category' => $postDetail->categories->slug]) }}"
                                                        rel="tag">{{ $postDetail->categories->name }}</a>
                                                </span>
                                                <span class="tagged_as">
                                                    Từ khoá:
                                                    @foreach ($postDetail->tags as $tag)
                                                        <a href="{{ route('Home', ['tag' => $tag->keyword]) }}"
                                                            rel="tag">{{ $tag->keyword }}</a>
                                                    @endforeach
                                                </span>
                                            </div>
                                            <div class="jlc-row main_content jl_woo_content">
                                                <div class="jlc-col-md-12">
                                                    <div class="single-product-wrap clearfix">
                                                        <div class="woocommerce-notices-wrapper"></div>
                                                        <div id="product-96"
                                                            class="product type-product post-96 status-publish first instock product_cat-albums product_cat-music product_tag-best has-post-thumbnail downloadable shipping-taxable purchasable product-type-simple">
                                                            <div class="jl-wc-wrap">
                                                            </div>
                                                            <section id="expertise">
                                                                <div class="container">
                                                                    <div class="section__wrapper">
                                                                        <div class="section__info">
                                                                            <input type="radio" id="commercial"
                                                                                value="1" name="tractor"
                                                                                checked="checked" />
                                                                            <input type="radio" id="residential"
                                                                                value="2" name="tractor" />
                                                                            <input type="radio" id="industrial"
                                                                                value="3" name="tractor" />
                                                                            <nav class="p-3">
                                                                                <label for="commercial"><i
                                                                                        class="fas fa-blog icon"></i>&nbsp;Bình
                                                                                    luận (<span class="fb-comments-count"
                                                                                        data-href="{{ route('PostDetail', ['slug' => $postDetail['slug']]) }}"></span>)</label>
                                                                                <label for="residential"><i
                                                                                        class="fas fa-comments icon"></i>&nbsp;Bài
                                                                                    viết liên quan</label>
                                                                            </nav>
                                                                            <div class="info__box uno">
                                                                                <div id="reviews"
                                                                                    class="woocommerce-Reviews">
                                                                                    <div id="comments">
                                                                                        <div class="fb-comments"
                                                                                            data-href="{{ route('PostDetail', ['slug' => $postDetail['slug']]) }}"
                                                                                            data-width="100%"
                                                                                            data-height="100%"
                                                                                            style="height: auto !important"
                                                                                            data-numposts="5"></div>
                                                                                    </div>
                                                                                    <div class="clear"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="info__box dos">
                                                                                <div class="products-outer">
                                                                                    <div class="products wc-col-4">
                                                                                        @foreach ($relatedPost as $blog)
                                                                                            <div
                                                                                                class="jl-wc-col product type-product post-93 status-publish first instock product_cat-music product_cat-singles has-post-thumbnail downloadable shipping-taxable purchasable product-type-simple">
                                                                                                <div class="p-feat">
                                                                                                    <div
                                                                                                        class="product-thumb">
                                                                                                        <a href="{{ route('PostDetail', ['slug' => $blog->slug]) }}"
                                                                                                            class="woocommerce-loop-product-link">
                                                                                                            <img width="380"
                                                                                                                height="380"
                                                                                                                src="{{ $blog->image }}"
                                                                                                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnailjl-lazyload ls-is-cached lazyloaded"
                                                                                                                alt=""
                                                                                                                decoding="async"
                                                                                                                loading="lazy"
                                                                                                                data-src="{{ $blog->image }}"></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="product-loop-content clearfix">
                                                                                                    <h2 style="margin-bottom:0"
                                                                                                        class="woocommerce-loop-product__title h4">
                                                                                                        <a href="{{ route('PostDetail', ['slug' => $blog->slug]) }}"
                                                                                                            class="woocommerce-loop-product-link p-url">{{ $blog->name }}</a>
                                                                                                    </h2>
                                                                                                    <span
                                                                                                        class="jl_post_meta">
                                                                                                        <span
                                                                                                            class="post-date">{{ $blog->created_at->format('d M Y') }}</span>
                                                                                                        <span
                                                                                                            class="post-date">View:
                                                                                                            {{ count($blog->viewed()->get()) }}</span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
