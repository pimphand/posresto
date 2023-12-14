<!DOCTYPE html>
<html>

<head>
    <title>Struk Kasir</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 58mm;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000;
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px 10px;
            text-align: left;
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

        .head {
            margin: 0;
            padding: 2px;
        }

        /* .timestamp {
      margin-top: 10px;
      text-align: center;
    } */
    </style>
    <script>
        function printReceipt() {
      window.print(); // Menggunakan fungsi bawaan browser untuk mencetak halaman
    }
    window.onload = function() {
      printReceipt(); // Memanggil fungsi printReceipt() saat halaman selesai dimuat
      setTimeout("self.close()",10);
    };
    </script>
</head>

<body>
    <div class="container">
        <h2>My Toko</h2>
        <hr>
        <p class="head">No. Nota : PNJ-1041</p>
        <p class="head">Customer : Customer Umum</p>
        <p class="head timestamp">31 Agustus 2023 | Jam: 13:00</p>
        <table>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            <tr>
                <td>Air Mineral</td>
                <td>1</td>
                <td>Rp. 3.000</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class="total">Subtotal:</td>
                <td colspan="2" class="total">Rp. 3.000</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class="total">Total:</td>
                <td colspan="2" class="total">Rp. 3.000</td>
            </tr>
        </table>
    </div>
</body>

</html>