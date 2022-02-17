@extends('layouts.dashboard')

@section('content')
    <!-- Content Area -->
    <div class="home_content">
        @if (session('success'))
        <div class="error-boxes alert alert-success" id="success_messages1">
            {{ session('success') }}
        </div>
    @endif
    @error('product_id')<div class="error-boxes alert alert-danger" id="success_messages1">{{ $message }}</div>@enderror
        {{-- sale contenct --}}
        <div class="cart-boxes">
            <div class="left-cart box">
                <div class="title d-flex justify-content-between">
                    รายการสินค้า
                    <div><input type="text" class="form-control" placeholder="ค้นหาสินค้า" id="searchbox"></div>
                </div>
                <hr>
                <div class="pd-details">
                    <div class="product">
                        <div class="row row-cols-5 g-3">
                            @foreach ($products as $product)
                                <div class="col add input_money" data-role="product">
                                    <div class="card">
                                        <input type="hidden" class="item" value="{{ $product->id }}">
                                        <img src=" {{ $product->pd_image }}" draggable="false"
                                            class="card-img-top productimg" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center productname">{{ $product->pd_name }}</h5>
                                            <div class="card-text fw-bold text-center">
                                                <span class="price">{{ $product->pd_price }}</span>
                                                บาท
                                            </div>
                                            <p class="card-text text-center"><small class="text-muted">จำนวนคงเหลือ {{ $product->pd_amount }} ชิ้น</small></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
            </div>

            {{-- right-side --}}
            <div class="cart-sales box">
                <form action="{{ route('saveCart') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="title d-flex justify-content-between">
                    ตะกร้าสินค้า
                    <button type="button" class="btn btn-sm btn-danger" id="clear">ยกเลิก</button>
                </div>
                <hr>
                <div class="list-order">
                    <table class="table table-bordered" id="table-list">
                        <thead>
                            <tr>
                                <th class="text-center">รูป</th>
                                <th class="text-center">รายการ</th>
                                <th class="text-center">จำนวน</th>
                                <th class="text-center">ราคารวม</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="orderlist">

                        </tbody>
                    </table>
                </div>
                <hr>
                {{-- คำนวณเงิน --}}

                <input type="hidden" name="total_item" value=""><input type="hidden" name="total_price" value="">
                <input type="hidden" name="change" value="">
                <ul class="list-unstyled">
                    <li class="d-flex bd-highlight">
                        {{-- รายการทั้งหมด --}}
                        <big class="p-2 flex-grow-1 bd-highlight">รายการทั้งหมด</big>
                        <div class="card-text p-2 bd-highlight"><b><span id="totalitem"
                                    class="card-text p-2 bd-highlight">0</span></b></div>
                        <div class="card-text p-2 bd-highlight"><span>ชิ้น</span></div>
                    </li>
                    <li class="d-flex bd-highlight">
                        {{-- ค่าใช้จ่ายทั้งหมด --}}
                        <big class="p-2 flex-grow-1 bd-highlight">ค่าใช้จ่ายทั้งหมด</big>
                        <div class="card-text p-2 bd-highlight"><b><span id="totalcost">0</span></b></div>
                        <div class="card-text p-2 bd-highlight"><span>บาท</span></div>
                    </li>
                </ul>

                <hr>

                <ul class="list-unstyled">
                    <li class="d-flex bd-highlight">
                        {{-- เงินที่รับมา --}}
                        <big class="p-2 flex-grow-1 bd-highlight">เงินที่ได้รับ</big>
                        <div class="card-text p-2 bd-highlight"><input type="number" id="money" name="money_received"
                                class="input_money form-control form-control-sm"  placeholder="0" style="text-align: right;" required>
                        </div>
                        <div class="card-text p-2 bd-highlight">บาท</div>
                    </li>
                    <li class="d-flex bd-highlight">
                        {{-- เงินทอน --}}
                        <big class="p-2 flex-grow-1 bd-highlight">เงินทอน</big>
                        <div class="card-text p-2 bd-highlight"><b><span id="change">0</span></b></div>
                        <div class="card-text p-2 bd-highlight">บาท</div>
                    </li>
                    <hr>
                    <div class="d-grid gap-2 col-4 mx-auto">
                        <button class="btn btn-primary" id="submit" type="submit">ชำระเงิน</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>
    <!-- End Content -->

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#searchbox").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $('div[data-role="product"]').filter(function() {
                    $(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)
                });
            });
        });



        $("body").on("click", ".add", function() {
            $('tbody').append(tr);
            var imgitem = $(this).find('.productimg').attr('src');
            var item = $(this).find('.item').val();
            var tablelist = $('#table-list').find('.tr' + item).val();
            var price = $(this).find('.price').html();
            var total = 0;
            var totalcost = $('#totalcost').html();
            var productname = $(this).find('.productname').html();
            var str = "";
            str += "<tr><input type='hidden' class='tr" + item + "' value='" + item +
                "'><input type='hidden' name='product_id[]' value='" + item + "'><input type='hidden' class='qty" +
                item + "' name='product_qty[]' value='1'><input type='hidden'  name='product_price[]' value='" +
                price + "'><input type='hidden' class='price_item" + item +
                "' name='product_item_price[]' value='" + price + "'>";


            str += "<td class='text-center'><img src='" + imgitem + "'style='width:30%' class='rounded'></td>";
            str += "<td class='text-center'>" + productname + "</td>";
            str +=
                "<td class='text-center'><button type='button' class='btn btn-sm addperitem input_money'><i class='bx bx-plus-circle'></i></button><span class='amount" +
                item +
                " amount_num' style='margin-left:5px; margin-right:5px;'>1</span><button type='button' class='input_money btn btn-sm removeperitem'><i class='bx bx-minus-circle'></i></button></td>"; //<button class='btn btn-success btn-sm addperitem'>+</button><button class='btn btn-danger btn-sm removeperitem'>-</button>
            str += "<td class='price" + item + " text-center'>" + price + "</td>";
            str +=
                "<td class='text-center'> <button class='btn btn-sm cancel btn-danger' type='button'>ลบ</button> </td>";
            str += "</tr>";
            var tr = $('#orderlist').find('tr');
            var amountplus = tr.find('.amount' + item).html();
            var priceplus = tr.find('.price' + item).html();
            if (tablelist == item) {
                var qty = $('#orderlist').find('.amount' + item).html(parseFloat(amountplus) + 1);
                $('#orderlist').find('.qty' + item).attr('value', parseFloat(amountplus) + 1);
                var sum = parseFloat(priceplus) + parseFloat(price);
                tr.find('.price' + item).html(sum);
                $('#orderlist').find('.price_item' + item).attr('value', sum);
            } else {
                $('#orderlist').append(str);
            }
            var itemlist = $('#orderlist').find('.amount_num').html();
            var sum = parseFloat(price) + parseFloat(totalcost);
            total += sum;
            var sum_amount = 0;
            sum_amount += parseFloat($('#totalitem').html()) + 1;
            $('#totalitem').html(sum_amount);
            $('#totalcost').html(total);
            $('input[name="total_item"]').attr('value', sum_amount);
            $('input[name="total_price"]').attr('value', total);
            input_money();


            //ลบสินค้าหลังสุด
        }).on("click", ".cancel", function() {
            $(this).parent().parent().remove();
            var amount_num = $(this).closest("tr").find('.amount_num').html();
            var tr = $(this).closest("tr");
            var item = tr.find('input[name="product_id[]"]').val();
            var totalitem = $('#totalitem').html();
            var price = $(this).closest("tr").find('.price' + item).html();
            var total = 0;
            var totalcost = $('#totalcost').html();
            var total = totalcost - parseFloat(price);
            $('#totalitem').html(parseFloat(totalitem) - parseFloat(amount_num));
            $('#totalcost').html(total);
            input_money();

            // ปุ่ม Clear
        }).on("click", "#clear", function() {
            if (confirm("ต้องการลบสินค้าในตระกร้าทั้งหมด")) {
                location.reload();
            }
            //คลิกเพิ่ม+
        }).on("click", ".addperitem", function() {
            var tr = $(this).closest("tr");
            var amount = tr.find(".amount_num").html();
            tr.find(".amount_num").html(parseFloat(amount) + 1);
            var item = tr.find('input[name="product_id[]"]').val();
            var price = tr.find('input[name="product_price[]"]').val();
            var total = 0;
            var totalcost = $('#totalcost').html();
            var sum = parseFloat(price) + parseFloat(totalcost);
            total += sum;
            var sum_amount = 0;
            sum_amount += parseFloat($('#totalitem').html()) + 1;
            tr.find('input[name="product_qty[]"]').attr('value', parseFloat(amount) + 1);
            $('#totalitem').html(sum_amount);
            $('#totalcost').html(total);
            $('input[name="total_item"]').attr('value', sum_amount);
            $('input[name="total_price"]').attr('value', total);
            var sum_price = parseFloat(tr.find(".price" + item).html()) + parseFloat(tr.find(
                'input[name="product_price[]"]').val());
            tr.find('.price' + item).html(sum_price);
            tr.find('input[name="product_item_price[]"]').attr('value', sum_price);
            input_money();

            //คลิกลบ-
        }).on("click", ".removeperitem", function() {
            var tr = $(this).closest("tr");
            var amount = tr.find(".amount_num").html();
            tr.find(".amount_num").html(parseFloat(amount) - 1);
            var item = tr.find('input[name="product_id[]"]').val();
            var price = tr.find(".price" + item).html();
            var price_per_item = tr.find('input[name="product_price[]"]').val();
            var total = 0;
            var totalcost = $('#totalcost').html();
            var sum = parseFloat(totalcost) - parseFloat(price_per_item);
            total += sum;
            var sum_amount = 0;
            sum_amount += parseFloat($('#totalitem').html()) - 1;
            tr.find('input[name="product_qty[]"]').attr('value', parseFloat(amount) - 1);
            $('#totalitem').html(sum_amount);
            $('#totalcost').html(total);
            $('input[name="total_item"]').attr('value', sum_amount);
            $('input[name="total_price"]').attr('value', total);
            var sum_price = parseFloat(price) - parseFloat(price_per_item);
            tr.find('.price' + item).html(sum_price);
            tr.find('input[name="product_item_price[]"]').attr('value', sum_price);
            input_money();
            if (tr.find(".amount_num").html() <= 0) {
                tr.remove();
            }

        }).on("keyup change click", ".input_money", function() {
            input_money();

        });
        function input_money() {
            var change = parseFloat($('#money').val()) - parseFloat($('#totalcost').html())-0;
            if(change <0){
                change="โปรดป้อนจำนวนเงินให้ถูกต้อง";
                $("#change").html(change);
            }
            $("#change").html(change);
            $('input[name="change"]').attr('value',change);

        }

        $("body").click(function() {
                $("#success_messages1").css("display", "none");
            });





        // function plus_price_item() {
        //    var tr = $('#orderlist').closest('tr');
        //    var price = tr.find('.price').html();
        //    var amount = tr.find('.amount_num').html();
        //    var sum = parseFloat(price) * parseFloat(amount);
        //    tr.find('.price').html(sum);
        //    console.log(sum,price,amount);
        // }
    </script>
@endsection
@endsection
