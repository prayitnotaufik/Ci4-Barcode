<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <title>Export PDF</title>

    <style>
        *,
        *:before,
        *:after {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: #384047;
        }

        table {
            max-width: 960px;
            margin: 10px auto;
        }

        caption {
            font-size: 1.6em;
            font-weight: 400;
            padding: 10px 0;
        }

        thead th {
            font-weight: 400;
            background: #8a97a0;
            color: #FFF;
        }

        tr {
            background: #f4f7f8;
            border-bottom: 1px solid #FFF;
            margin-bottom: 5px;
        }

        tr:nth-child(even) {
            background: #e8eeef;
        }

        th,
        td {
            text-align: left;
            padding: 20px;
            font-weight: 300;
        }

        tfoot tr {
            background: none;
        }

        tfoot td {
            padding: 10px 2px;
            font-size: 0.8em;
            font-style: italic;
            color: #8a97a0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Data Produk PT AICA INDRIA</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Barcode</th>
                </tr>
            </thead>
            <tbody>
                <?php

                use Picqer\Barcode\BarcodeGeneratorHTML;

                $i = 1 ?>
                <?php foreach ($produk as $p) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $p['kode']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td>Rp.<?= $p['harga']; ?>,-</td>
                        <td>
                            <?php
                            $barcode = new BarcodeGeneratorHTML();
                            echo $barcode->getBarcode($p['kode'], $barcode::TYPE_CODE_128);
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>