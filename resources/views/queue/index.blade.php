<!DOCTYPE html>
<html>
<head>
    <title>Antrian Farmasi</title>
    <!-- styling halaman utama -->
    <style>
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px;
        background-color: #007bff;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn:hover {
        background-color: #0056b3;
    }
    </style>

    <!-- QZ Tray untuk komunikasi dengan printer -->
    <script src="{{ asset('js/qz-tray.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        function printQueue(queueId) {
            qz.websocket.connect().then(() => {
                return qz.printers.find("Microsoft Print to PDF");
            }).then((found) => {
                var config = qz.configs.create(found, {
                    size: {width: 50, height: 50}, units: 'mm',
                    margins: 2
                });
                var data = [{
                    type: 'pixel',
                    format: 'html',
                    flavor: 'file',
                    data: "{{ url('queue/print') }}/" + queueId
                }];
                return qz.print(config, data);
            }).catch((e) => {
                alert(e);
            }).finally(() => {
                return qz.websocket.disconnect();
            });
        }

        // saat tombol ambil antrian diklik, langsung ke route 'queue.generate'
        // dan mencetak nomor antrian yang dihasilkan pada route 'queue.print'
        // (kalau bisa browser tidak perlu mengarah ke halaman queue.print saat cetak, 
        // tetapi langsung refresh halaman index untuk menampilkan nomor antrean terakhir)
        $(document).ready(function() {
            $('.btn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('queue.generate') }}",
                    method: 'GET',
                    success: function(response) {
                        printQueue(response.queueId);
                        window.location.href = "{{ route('queue.index') }}";
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.status + ' ' + xhr.statusText);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Antrian Farmasi</h1>
    <p>{{ $currentDateTime->format('d-m-Y H:i') }}</p>
    <p>Nomor Antrian: {{ $queue->number ?? 'Belum ada antrian' }}</p>
    <a href="#" class="btn">AMBIL ANTRIAN</a>
</body>
</html>
