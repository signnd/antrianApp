<!DOCTYPE html>
<html>
<head>
    <title>Print Antrian Farmasi</title>
    <style>
        html {
            font-family: Calibri, sans-serif;
        }

        @media print {
            .print-container {
                width: 65mm;
                height: 45mm;
                text-align: center;
                margin: 0;
                padding: 0;
                margin-inline: 10px;
            }
        }

            h3 {
                line-height: 0.5;
            }

            .print-container .heading {
                font-size: 15px;
                line-height: 0.5;
                margin-bottom: 0%;
            }

            .print-container .queueNumber {
                font-size:90px;
                font-weight: bold;
                margin: 0;
            }
            .print-container .createdAt {
                font-size: 15px;
                margin: 0;
            }

    </style>
</head>
<body>
    <div class="print-container">
        <h3>Antrian Farmasi</h3>
        <p class="heading">Nomor Antrian: </p>
        <p class="queueNumber">{{ $queue->number }}</p>
        <p class="createdAt">{{ $queue->created_at }}</p>
    </div>
</body>
</html>
