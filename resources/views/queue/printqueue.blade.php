<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print Antrian Test</title>
</head>
<script>
    function printQueue() {
    fetch("{{ route('queue.printqueue') }}")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Printed successfully');
            } else {
                console.error('Printing failed', data.error);
            }
            window.location.href = "{{ route('queue.index') }}";
        })
        .catch(error => console.error('Error:', error));
}
</script>
<body>
    <p>Hello World</p>
</body>
</html>
