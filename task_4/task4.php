<?php
$filename = "mock_deals.json";
$file = fopen($filename, "r");
if ($file):
    $data = json_decode(fread($file, filesize($filename)));
    fclose($file); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Task 4</title>
        <style>
            table, td {
                border: 1px solid #000;
            }

            table {
                border-collapse: collapse;
            }

            td {
                padding: 5px;
            }
        </style>
        <script src="script.js"></script>
    </head>
    <body>
        <button onclick="filter_table('WON')">Show WON</button>
        <button onclick="filter_table('LOSE')">Show LOSE</button>
        <button onclick="show_all()">Clear filter</button>

        <table id="table">
            <tr>
                <td>ID</td>
                <td>Title</td>
                <td>Status</td>
                <td>Amount</td>
            </tr>
            <?php foreach ($data as $deal): ?>
                <tr data-status="<?= $deal->status ?>">
                    <td><?= $deal->id ?></td>
                    <td><?= $deal->title ?></td>
                    <td><?= $deal->status ?></td>
                    <td><?= $deal->amount ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
<?php
else:
    echo "Error opening file";
endif; ?>