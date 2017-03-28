<!-- content-wrap -->
<section id="content-wrap" class="content-wrap">
    <div class="wrap">
        <div class="inner">
            <div class="slide-wrap">
            <div class="main-slide parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url() ?>public/frontend/images/homepage-slide.jpg"></div>
                <!-- <img class="img-responsive" src="images/homepage-slide.jpg" alt="Home Page Slide"> -->
                <div class="slide-content">
                    <div class="container">
                        <h1>Latest News <small>A new guide to commercial property in LA <a href="<?php echo base_url().'blog'; ?>">View More</a></small></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- inner -->
    </div>
    <!-- wrap -->

    <div class="container">
        <div class="section-header">
            <h1 class="weight-800 italic">Explore Our Properties</h1>
            <h3 class="weight-600 italic">Commercial & Residential properties across Greater Los Angeles</h3>
        </div>
        <!-- section-header -->

    </div>
    <!-- container -->

    <div class="map-wrap container">
        <div id="map" class="map"></div>
        <div class="map-content">
            <form class="property-search-form" name="form_name_home" id="form_name_home" action="#">
            <h2 class="form-header">Filter Results</h2>
            <div class="form-group">
                <label for="label-bold">Offer Type</label>
                <ul class="remove-margin checkbox list-inline">
                    <li>
                        <label>
                            <input type="checkbox" onclick="listing_search()" name="offer_type[]" value="Lease"> Lease
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" onclick="listing_search()" name="offer_type[]" value="Sale"> Sale
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" onclick="listing_search()" name="offer_type[]" value="Sublease"> Sublease
                        </label>
                    </li>
                </ul>
            </div>
            <!-- form-group -->
            <div class="form-group">
                <label for="label-bold">Property Type</label>
                <ul class="remove-margin checkbox list-inline">
                    <li>
                        <label>
                            <input type="checkbox" onclick="listing_search()" name="property_type[]" value="Commercial"> Commercial
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" onclick="listing_search()" name="property_type[]" value="Industrial"> Industrial
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox" onclick="listing_search()" name="property_type[]" value="Residential"> Residential
                        </label>
                    </li>
                </ul>
            </div>
            <!-- form-group -->

            <div class="form-inline">
                <span class="label-bold">Price</span>
                <label class="w50" for="min-val">Min $</label>
                <select class="form-control" onchange="listing_search()" name="min_price" id="min-val">
                    <option value="" selected>Min Price</option>
                    <option value="$20000">$ 20,000</option>
                    <option value="$30000">$ 30,000</option>
                    <option value="$40000">$ 40,000</option>
                    <option value="$50000">$ 50,000</option>
                </select>
                            <!-- min price -->
                <label for="max-val">to</label>
                <select class="form-control" onchange="listing_search()" name="max_price" id="max-val">
                    <option value="" selected>Max Price</option>
                    <option value="$20000">$ 20,000</option>
                    <option value="$30000">$ 30,000</option>
                    <option value="$40000">$ 40,000</option>
                    <option value="$50000">$ 50,000</option>
                </select>
                <!-- max price -->
            </div>
            <div class="form-inline">
                <span class="label-bold">Size</span>
                <label class="w50" for="min-val">Sq ft</label>
                <select class="form-control" onchange="listing_search()" name="property_area_min" id="min-val">
                    <option value="" selected>Min Size</option>
                    <option value="val-2">20,000 sq ft</option>
                    <option value="val-3">30,000 sq ft</option>
                    <option value="val-4">40,000 sq ft</option>
                    <option value="val-5">50,000 sq ft</option>
                </select>
                            <!-- min price -->
                <label for="max-val">to</label>
                <select class="form-control" onchange="listing_search()" name="property_area_max" id="max-val">
                    <option value="" selected>Max Size</option>
                    <option value="val-2">20,000 sq ft</option>
                    <option value="val-3">30,000 sq ft</option>
                    <option value="val-4">40,000 sq ft</option>
                    <option value="val-5">50,000 sq ft</option>
                </select>
                <!-- max price -->
            </div>

            <div class="form-button">
                <a href="<?php echo base_url().'our-listings'; ?>" class="btn-block btn btn-default">Browse as List</a>
            </div>
            <!-- form-button -->

            </form>
        </div>
        </div>
    
    <!-- maps-wrap -->
    
</section>
