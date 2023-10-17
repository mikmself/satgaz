<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$data_order['title']}}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="{{$data_order['bg_body']}}">
<div class="container mx-auto p-4">
    <div class="{{$data_order['bg_card']}} max-w-lg mx-auto bg-white rounded-lg shadow-md">
        <div class="py-6 px-8 text-center">
            <h1 class="text-2xl font-semibold {{$data_order['text_style']}} mb-2">{{$data_order['text_header']}}</h1>
            <p class="text-sm {{$data_order['text_style']}}">
                {{$data_order['text_desc']}}
            </p>
        </div>
        <div class="py-4 px-8">
            <p class="text-lg {{$data_order['text_style']}} text-bold">Payment Details :</p>
            <div class="text-sm {{$data_order['text_style']}} mt-2">
                <table>
                    <tr>
                        <td>Transaction ID</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{$data_order['order_id']}}</td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{$data_order['customer_name']}}</td>
                    </tr>
                    <tr>
                        <td>Total Payment</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{$data_order['total_payment']}}</td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td class="pl-2 pr-2"> : </td>
                        <td>{{$data_order['order_date']}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="py-4 px-8 text-center">
            <p class="text-sm {{$data_order['text_style']}}">{{$data_order['text_closing']}}</p>
        </div>
    </div>
</div>
</body>
</html>
