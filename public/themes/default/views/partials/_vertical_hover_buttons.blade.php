<a class="button product-link itemQuickView" href="{{ route('quickView.product', $item->slug) }}" data-toggle="tooltip" data-placement="top" title="{{ trans('app.quick_view') }}">
  <i class="fal fa-search-plus"></i>
</a>

@if (is_incevio_package_loaded('comparison'))
  <a class="button product-link add-to-product-compare" data-link="{{ route('comparable.add', $item->id) }}" data-toggle="tooltip" data-placement="top" title="{{ trans('comparison::lang.add_to_compare') }}">
    <i class="far fa-repeat-alt"></i>
  </a>
@endif

@if (is_incevio_package_loaded('wishlist'))
  <a href="javascript:void(0)" data-link="{{ route('wishlist.add', $item) }}" class="button add-to-wishlist" data-toggle="tooltip" data-placement="top" title="{{ trans('wishlist::lang.add_to_wishlist') }}">
    <i class="fal fa-heart"></i>
  </a>
@endif

{{-- <a href="#" class="button">
    <i class="fal fa-repeat"></i>
</a> --}}
<a href="javascript:void(0)" data-link="{{ route('cart.addItem', $item->slug) }}" class="button button--cart sc-add-to-cart">
  <i class="fal fa-shopping-cart"></i>
  {{ trans('theme.add_to_cart') }}
</a>
