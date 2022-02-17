<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @LaravelDompdfThaiFont
    <title>Document</title>
    <style>
        body {
            font-family: 'THSarabunNew';
            margin-top: -50px;
            font-size: 18px;
        }

        table{
            margin-left: auto;
            margin-right: auto;
        }

        .head {
            text-align: center;
        }

        #section {
            border-collapse: collapse;
            width: 100%;
            font-size: 18px;
            margin-top: -30px;

        }

        tr td.detail {
            text-align: right;
        }

        /* ================================================ */

        .data {
            border-collapse: collapse;
            width: 100%;
        }

        .data td,th {
            border: 1px solid;

        }

        .data .bd {
            border-left: 1px solid rgb(255, 255, 255);
            border-bottom: 1px solid rgb(255, 255, 255);
        }

        .data td{
            height: 45px;
            vertical-align: center;
        }
        .data th{
            height: 45px;
            vertical-align: center;
            background-color:#E2E3E5;
        }

    </style>
</head>

<body>
    <div class="head">
        <h1>ใบเสร็จรับเงิน</h1>
    </div>

    <table id="section">
        <tr>
            <td><b>ร้าน อุปกรณ์การเกษตร</b></td>
            <td class="detail"><b>เลขที่ใบเสร็จ : </b>{{ $showorder->code }}</td>
        </tr>
        <tr>
            <td>99/9 หมู่ 9 ตำบล xxxxx</td>
            <td class="detail"><b>ผู้ทำรายการ :
                </b>{{ $showorder->nameuser->first_name . ' ' . $showorder->nameuser->last_name }}</h5>
            </td>
        </tr>
        <tr>
            <td>อำเภอ เมือง จังหวัด เชียงใหม่ 50100</td>
            <td class="detail"><b>วันที่ :
                </b>{{ \Carbon\Carbon::parse($showorder->date)->format('d/m/Y G:i:s') }}</td>
        </tr>
        <tr>
            <td>โทร 090-xxx-xxxx</td>
            <td class="detail"><b>จำนวนรายการ : </b>{{ number_format($count) }} รายการ</td>
        </tr>
    </table>
    <hr>

    <table class="data">
        <thead>
            <tr>
                <th style='text-align:center; ' scope="col">ลำดับ</th>
                <th style='text-align:center;' scoOpe="col">รายการ</th>
                <th style='text-align:center;' scope="col">จำนวน</th>
                <th style='text-align:center;' scope="col">หน่วยละ</th>
                <th style='text-align:center;' scope="col">ราคาทั้งหมด</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 1)

            @foreach ($order_details as $item)
                <tr>
                    <td style='text-align:center'>{{ $i++ }}</td>
                    <td style='text-align:center'>{{ $item->pd_name }}</td>
                    <td style='text-align:center'>{{ number_format($item->amount) }}</td>
                    <td style='text-align:center'>{{ number_format($item->pd_price) }}</td>
                    <td style='text-align:center'>{{ number_format($item->price) }}</td>
                </tr>
            @endforeach
            <tr>
                <td rowspan="4" colspan="3" class="bd"></td>
                <td style='text-align:center; border-top:2px solid rgb(0, 0, 0); background-color:#E2E3E5;'> <b>จำนวน</b> </td>
                <td style='text-align:center; border-top:2px solid rgb(0, 0, 0);'>
                    <b>{{ number_format($sumamount) }}</b> ชิ้น </td>
            </tr>
            <tr>
                <td style='text-align:center; background-color:#E2E3E5;'> <b>ยอดรวมทั้งหมด</b> </td>
                <td style='text-align:center'> <b>{{ number_format($sumprice) }}</b> บาท </td>
            </tr>
            <tr>
                <td style='text-align:center; background-color:#E2E3E5;'> <b>จำนวนเงินที่ได้รับ</b> </td>
                <td style='text-align:center'> <b>{{ number_format($item->money_received) }}</b> บาท </td>
            </tr>
            <tr>
                <td style='text-align:center; background-color:#E2E3E5;'> <b>เงินทอน</b> </td>
                <td style='text-align:center'> <b>{{ number_format($item->change) }}</b> บาท </td>
            </tr>
        </tbody>
    </table>


</body>

</html>
