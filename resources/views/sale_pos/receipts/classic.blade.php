<!DOCTYPE html>
<html>
@php
$size = \App\System::where('key','size_paper')->first();
if ($size) {
$sizes = json_decode($size->value);
}

$wifi = \App\System::where('key', 'wifi')->first();
$instagram = \App\System::where('key', 'instagram')->first();
@endphp

<head>
	<meta name="viewport" content="width=57mm, initial-scale=1">

	<title>Struk Kasir</title>
	<style>
		.body {
			font-family: Arial, sans-serif;
			font-size: 10px;
			margin: 0;
			padding: 2px;
		}

		.container {
			top: 0;
			right: 0;
			margin: 0;
			padding: 5px;
			background-color: #f5f5f5;
			max-width: 100%;
			/* Adjusted width for thermal paper */
		}

		h2 {
			text-align: center;
			margin: 0;
			padding: 0;
			font-size: 12px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 0;
			text-align: left;
			padding: 1px;
		}

		th {
			border-bottom: 1px solid #000;
			font-weight: bold;
		}

		.total {
			font-weight: bold;
			text-align: right;
		}

		.text-center {
			text-align: center;
		}

		.resto {
			margin-top: 10px;
			padding: 3;
			text-align: center;
		}

		.garis {
			padding: 3;
			text-align: center;
		}

		.container.keterangan-order {
			margin: 10px 0;
			padding: 3px;
			text-align: left;
		}

		.col-5,
		.col-2 {
			flex: 1;
		}

		.col-5 {
			margin-right: 5px;
		}
	</style>
	<!-- <script>
        function printReceipt() {
            window.print();
        }
        window.onload = function () {
            printReceipt();
            setTimeout("self.close()", 10);
        };
    </script> -->
</head>
{{-- @php
function $subtotal_str) {

return (int)preg_replace("/[^0-9]/", "", str_replace(".00", "", $subtotal_str));
}
@endphp --}}

<body>
	<div class="container body" style="max-width:{{ isset($sizes->panjang) ? (int)$sizes->panjang : 57 }}mm">
		<h2>{{ env('APP_NAME') }}</h2>
		<div class="resto">
			<p class="">@if(!empty($receipt_details->display_name))
				{{$receipt_details->display_name}}
				@endif<br>
				@if(!empty($receipt_details->city))
				{!! $receipt_details->city !!},
				@endif
				@if(!empty($receipt_details->state))
				{!! $receipt_details->state !!}
				@endif
				<br>
				@if(!empty($receipt_details->mobile))
				{!! $receipt_details->mobile !!}
				@endif
			</p>
			===================================
		</div>
		<table>
			<tr>
				<td>No Nota</td>
				<td>:</td>
				<td>{{$receipt_details->invoice_no}}</td>
			</tr>
			<tr>
				<td>Waktu</td>
				<td>:</td>
				<td>{{$receipt_details->invoice_date}}</td>
			</tr>
			{{-- <tr>
				<td>Order</td>
				<td>:</td>
				<td>Kasir 1</td>
			</tr> --}}
			<tr>
				<td>Kasir</td>
				<td>:</td>
				<td>{{ auth()->user()->first_name }}</td>
			</tr>
			@if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
			<tr>
				<td>Jenis Order</td>
				<td>:</td>
				<td>{{$receipt_details->table}}</td>
			</tr>
			@endif

			<tr>
				<td>Nama Order</td>
				<td>:</td>
				<td>{{ $receipt_details->customer_name }}</td>
			</tr>
		</table>
		<div class="garis" style="font: size 12;">
			-------------------------------------------------------------
		</div>
		<table>
			@foreach($receipt_details->lines as $line)
			<tr>
				<td class="align-left" width="10%">
					{{(int)$line['quantity']}}
				</td>
				<td class="align-left" width="60%">{{$line['name']}} {{$line['product_variation']}}
					{{$line['variation']}}</td>
				<td class="align-right" width="30%">
					{{$line['line_total']}}
				</td>
			</tr>

			@endforeach
		</table>
		<div>
			-------------------------------------------------------------
		</div>
		<table>
			<tr>
				<td class="align-left">Subtotal {{ count($receipt_details->lines ?? []) }} Produk</td>
				<td></td>
				<td colspan="2" class="align-right">{{$receipt_details->subtotal}}</td>
			</tr>
			<tr>
				<td class="align-left">Diskon (-)</td>
				<td></td>
				<td colspan="2" class="align-right">{{$receipt_details->discount}}</td>
			</tr>
			<tr>
				<td class="align-left">Total Tagihan </td>
				<td></td>
				<td colspan="2" class="align-right">{{$receipt_details->total}}</td>
			</tr>
		</table>
		<div class="garis">
			-------------------------------------------------------------
		</div>
		<table>
			<tr>
				<td class="align-left">Tunai</td>
				<td></td>
				<td colspan="2" class="align-right">Rp {{$receipt_details->total_paid}}</td>
			</tr>
			<tr>
				<td class="align-left">Total Bayar </td>
				<td></td>
				<td colspan="2" class="align-right">Rp {{$receipt_details->total_paid}}</td>
			</tr>
			{{-- <tr>
				<td class="align-left">Kembalian </td>
				<td></td>
				<td colspan="2" class="align-right">2.000</td>
			</tr> --}}
		</table>
		<div class="garis">
			===================================
		</div>

		@if ($wifi)
		<table>
			<tr>
				<td>Password : {{ $wifi->value }} </td>
			</tr>
		</table>
		<br>
		@endif

		@if ($instagram)
		<table>
			<tr>
				<td>Instagram : {{ $instagram->value }} </td>
			</tr>
		</table>
		<br>
		@endif

		{{-- <br>
		<table>
			<tr>
				<td class="align-center">Terbayar</td>
			</tr>
		</table> --}}

	</div>
</body>

</html>