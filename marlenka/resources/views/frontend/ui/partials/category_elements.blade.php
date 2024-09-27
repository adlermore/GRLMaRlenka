<div class="card-columns">
    @foreach ($categories->childrenCategories as $key => $category)
        <div class="card shadow-none border-0">
            <ul class="list-unstyled mb-3">
                <li class="fs-14 fw-700 mb-3">
                    <a class="text-reset hov-text-primary" href="{{ route('products.category', $category->slug) }}">
                        {{ $category->getTranslation('name') }}
                    </a>
                </li>
            </ul>
        </div>
    @endforeach
</div>
