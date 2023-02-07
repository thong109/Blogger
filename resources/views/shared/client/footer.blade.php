<footer id="footer-container" class="jl_foot_wrap">
    <div class="footer-columns">
        <div class="jlc-container">
            <div class="jlc-row">
            </div>
        </div>
    </div>
    <div class="jl_ft_mini jl_ft_min1">
        <div class="jlc-container">
            <div class="jlc-row bottom_footer_menu_text">
                <div class="jlc-col-md-12">
                    <div class="jl_ft_cw">
                        <ul id="jl-menu-footer-menu" class="jl-menu-footer">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11690">
                                <a title="" href="#">About Us</a>
                            </li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11691">
                                <a title="						" href="#">Private policy</a>
                            </li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11692">
                                <a title="						" href="#">Forums</a>
                            </li>
                        </ul>
                        <div class="cp_txt">© Copyright 2022 Jellywp. All rights reserved powered by <a
                                href="../../../index.html" target="_blank">Jellywp.com</a></div>
                        <ul class="d-flex">
                            @foreach ($TAGS as $tag)
                                <li class="tag"><a
                                        href="{{ route('Home', ['tag' => $tag->keyword]) }}">{{ $tag->keyword }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
