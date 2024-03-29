@php
    $categories = \App\Models\Category::orderBy('category_name', 'asc')->get();
@endphp
<nav class="main_nav">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="main_nav_content d-flex flex-row">

                    <!-- Categories Menu -->

                    <div class="cat_menu_container">
                        <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                            <div class="cat_burger"><span></span><span></span><span></span></div>
                            <div class="cat_menu_text">categories</div>
                        </div>

                        <ul class="cat_menu">
                            @foreach ($categories as $category)
                                <li class="hassubs">
                                    <a href="{{ route('categorywise.product', $category->id) }}">
                                        <img src="{{ asset($category->category_icon) }}" height="18"
                                            width="18">&nbsp;{{ $category->category_name }}<i
                                            class="fas fa-chevron-right"></i>
                                    </a>
                                    <ul>
                                        @php
                                            $subcategories = \App\Models\Subcategory::where('category_id', $category->id)->get();
                                        @endphp

                                        @foreach ($subcategories as $subcategory)
                                            <li class="hassubs">
                                                <a href="{{ route('subcategorywise.product', $subcategory->id) }}">{{ $subcategory->subcategory_name }}<i
                                                        class="fas fa-chevron-right"></i></a>
                                                <ul>
                                                    @php
                                                        $childcategories = \App\Models\Childcategory::where('subcategory_id', $subcategory->id)->get();
                                                    @endphp
                                                    @foreach ($childcategories as $childcategory)
                                                        <li><a
                                                                href="{{ route('childcategorywise.product', $childcategory->id) }}">{{ $childcategory->childcategory_name }}<i
                                                                    class="fas fa-chevron-right"></i></a></li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Main Nav Menu -->

                    <div class="main_nav_menu ml-auto">
                        <ul class="standard_dropdown main_nav_dropdown">
                            <li><a href="{{ url('/') }}">Home<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="#">Campaign<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="#">Helpline<i class="fas fa-chevron-down"></i></a></li>
                        </ul>
                    </div>

                    <!-- Menu Trigger -->

                    <div class="menu_trigger_container ml-auto">
                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                            <div class="menu_burger">
                                <div class="menu_trigger_text">menu</div>
                                <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>
