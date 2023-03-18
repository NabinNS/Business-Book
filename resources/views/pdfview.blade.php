<!DOCTYPE html>
<html lang="en">

<head>
    <title>Practise</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width = device-width, initial-scale = 1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style type="text/css">
        table td,
        table th {
            border: 1px solid black;
        }
    </style>



<body>

    <div class="container">


        <br />
        <a href="{{ route('pdfview', ['download' => 'pdf']) }}">Download PDF</a>


        <table>
            <tr>
             
                <th>Title</th>
                <th>Description</th>
                <th>Description</th>
                <th>Description</th>
                <th>Description</th>
            </tr>
            @foreach ($items as $item)
                <tr>
                
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->receipt_no }}</td>
                    <td>{{ $item->particulars }}</td>
                    <td>{{ $item->debit }}</td>
                    <td>{{ $item->credit }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>


</html>
