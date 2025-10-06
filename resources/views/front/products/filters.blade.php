<?php use App\Models\ProductsFilter; ?>
<div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-1">
                            <label class="custom-control-label" for="price-1">₹0 - ₹500</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">₹501 - ₹1000</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">₹1001 - ₹2000</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">₹2001 - ₹5000</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">₹5001 - ₹10000</label>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Color</h5>
                    @php
                        $getColors = ProductsFilter::getColors($catIds);
                        $selectedColors = [];
                        if (request()->has('color')) {
                            $selectedColors = explode('~', request()->get('color'));
                        }
                    @endphp
                    <div>
                        @foreach ($getColors as $key => $color)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-2">
                                <input type="checkbox" name="color" id="color{{ $key }}" value="{{$color}}" class="custom-control-input filterAjax" {{in_array($color, $selectedColors) ? 'checked' : ''}}>
                                <label for="color{{$key}}" class="custom-control-label">{{ucfirst($color)}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Size</h5>
                    @php
                        $getSizes = ProductsFilter::getSizes($catIds);
                        $selectedSizes = request()->has('size') ? explode('~', request()->get('size')) : [];
                    @endphp
                    <div>
                        @foreach ($getSizes as $key => $size)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-2">
                        <input type="checkbox" name="size" id="size{{$key}}" value="{{$size}}" class="custom-control-input filterAjax"
                        {{ in_array($size, $selectedSizes) ? 'checked' : ''}}>
                        <label for="size{{$key}}" class="custom-control-label">{{ strtoupper($size)}}</label>
                    </div>
                @endforeach
                </div>
                </div>
                <!-- Size End -->

                <!-- Brand Filter Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Brand</h5>
                    @php
                        $getBrands = ProductsFilter::getBrands($catIds);
                        $selectedBrands = [];
                        if (request()->has('brand')) {
                            $selectedBrands = explode('~', request()->get('brand'));
                        }
                    @endphp
                    <div>
                        @foreach ($getBrands as $key => $brand)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-2">
                        <input type="checkbox" name="brand" id="brand{{$key}}" value="{{$brand['name']}}" class="custom-control-input filterAjax"
                        {{ in_array($brand['name'], $selectedBrands) ? 'checked' : ''}}>
                        <label for="brand{{$key}}" class="custom-control-label">{{ strtoupper($brand['name'])}}</label>
                    </div>
                @endforeach
                </div>
                </div>
                <!-- Brand Filter End -->
            </div>