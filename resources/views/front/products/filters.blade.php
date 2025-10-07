<?php use App\Models\ProductsFilter; ?>
<div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Price</h5>
                    @php
                        $prices = ['0-1000', '1000-2000', '2000-5000', '5000-10000', '10000-100000'];
                        $selectedPrices = [];
                        if (request()->has('prices')) {
                            $selectedPrices = explode('~', request()->get('price'));
                        }
                    @endphp
                    <div>
                        @foreach ($prices as $key => $price)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-2">
                                <input type="checkbox" name="price" id="price{{ $key }}" value="{{$price}}" class="custom-control-input filterAjax" {{in_array($color, $selectedColors) ? 'checked' : ''}}>
                                <label for="price{{$key}}" class="custom-control-label">{{ucfirst($price)}}</label>
                            </div>
                        @endforeach
                    </div>
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