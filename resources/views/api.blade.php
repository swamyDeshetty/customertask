<!-- Include the DataTables library and CSS -->
<!-- ... -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>


<table id="newsTable">
    <thead>
        <tr>
            <th>Source</th>
            <th>Author</th>
            <th>Title</th>
            <th>Description</th>
            <th>URL</th>
            <th>Image</th>
            <th>Published At</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{{ $cell }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Initialize the DataTables plugin -->
<script>
    $(document).ready(function() {
        $('#newsTable').DataTable();
    });
</script>
