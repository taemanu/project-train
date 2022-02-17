@extends('layouts.dashboard')

@section('content')
<!-- Content Area -->
    <div class="home_content">
        <div class="overview-boxes">
            <div class="box">
                <div class="left-side">
                    <div class="box_toppic">Orderlist</div>
                    <div class="number">99,999</div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from testerday</span>
                    </div>
                </div>
                <i class='bx bxs-cart-alt cart' ></i>
            </div>
            <div class="box">
                <div class="left-side">
                    <div class="box_toppic">Total Sales</div>
                    <div class="number">99,999</div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from testerday</span>
                    </div>
                </div>
                <i class='bx bxs-cart-add cart two' ></i>
            </div>
            <div class="box">
                <div class="left-side">
                    <div class="box_toppic">Total Sales</div>
                    <div class="number">99,999</div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from testerday</span>
                    </div>
                </div>
                <i class='bx bxs-cart-add cart three' ></i>
            </div>
            <div class="box">
                <div class="left-side">
                    <div class="box_toppic">Total Sales</div>
                    <div class="number">99,999</div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from testerday</span>
                    </div>
                </div>
                <i class='bx bxs-cart-add cart four' ></i>
            </div>
        </div>

         {{-- sale contenct --}}
            <div class="sales-boxes">
                <div class="recent-sale box">
                    <div class="title">Recet Sales</div>
                    <div class="sales-details">
                        <ul class="details">
                            <li class="topic">Date</li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                            <li><a href="#">02 jan 2021</a></li>
                        </ul>
                        <ul class="details">
                            <li class="topic">Order</li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                            <li><a href="#">Orderlist</a></li>
                        </ul>
                        <ul class="details">
                            <li class="topic">Sale</li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                            <li><a href="#">Employee</a></li>
                        </ul>
                        <ul class="details">
                            <li class="topic">Total</li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                            <li><a href="#">$9999</a></li>
                        </ul>
                    </div>
                </div>

            {{-- right-side --}}
                <div class="top-sales box">
                    <div class="title">Top Selling Product</div>

                    <ul>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="https://shop-image.readyplanet.com/tCSfgx6Ze7ByH4e5ihLoPjHI4o8=/63cce9e2db094564b17a758a4f35c195" alt="">
                                <span class="product_name">Product 1</span>
                            </a>
                                <span class="price">$99.99</span>
                        </li>
                    </ul>
                </div>
            </div>

    </div>
</div>
<!-- End Content -->
@endsection


