<?php
require 'db/config.php';
require 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/sidebar.php';
?>

<section class="wrapper">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Service Consumption Report
            </div>

            <!-- Filter Form -->
            <div class="row" style="padding: 15px; margin-left:10px;">
                
                <form id="filterForm" class="form-inline">
                    <div class="form-group">
                        <label for="from_date">From:</label>
                        <input type="date" name="from_date" id="from_date" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin-left:10px;">
                        <label for="to_date">To:</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success" style="margin-left: 10px;">Load Report</button>
                </form>
            </div>

            <!-- Table (Initially Hidden) -->
            <div class="table-responsive" id="reportWrapper" style="display: none;">
                <table id="reportTable" class="table table-striped table-bordered">
                    <thead>
                        <tr id="tableHead"></tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<!-- JS & CSS Includes -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<!-- AJAX & DataTable Setup -->
<script>
$(document).ready(function () {
    var table;

    $('#filterForm').on('submit', function (e) {
        e.preventDefault();

        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        if (table) {
            table.destroy();
        }

        $('#reportTable thead tr#tableHead').empty();
        $('#reportTable tbody').empty();
        $('#reportWrapper').hide();

        $.ajax({
            url: "ajax/fetch_report_data.php",
            type: "POST",
            data: {
                from_date: from_date,
                to_date: to_date
            },
            dataType: "json",
            success: function (response) {
                if (!response.data || response.data.length === 0) {
                    alert("No data found for the selected date range.");
                    return;
                }

                $('#reportWrapper').show();

                // Build header row
                $('#reportTable thead tr#tableHead').append('<th>S.No.</th>');
                $.each(response.headers, function (i, h) {
                    $('#reportTable thead tr#tableHead').append('<th>' + h + '</th>');
                });

                // Define DataTable columns
                var columns = [{
                    title: "S.No.",
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }];

                columns = columns.concat(response.headers.map(function (h) {
                    return { title: h, data: h }; // <- this binds the data properly
                }));

                // Convert array rows to objects (needed for 'data: h')
                var structuredData = response.data.map(function (row) {
                    var rowObj = {};
                    response.headers.forEach(function (h, i) {
                        rowObj[h] = row[i];
                    });
                    return rowObj;
                });

                // Initialize DataTable
                table = $('#reportTable').DataTable({
                    data: structuredData,
                    columns: columns
                });
            },
            error: function () {
                alert("An error occurred while fetching the data.");
            }
        });
    });
});
</script>


<?php include 'includes/footer.php'; ?>