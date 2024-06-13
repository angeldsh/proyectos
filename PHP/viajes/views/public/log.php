<!DOCTYPE html>
<html lang="en">

<?php require_once 'views/layouts/head_admin.php'; ?>

<body>
<?php require_once 'views/layouts/header_admin.php';

?>


<div class="container bg-wite">
    <table class="table table-striped">
        <thead>
        <th>Logs</th>
        </thead>
        <tbody>
        <?php foreach ($data['logs'] as $log) { ?>
            <tr>
                <td><?= $log['log']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once 'views/layouts/footer_main.php'; ?>
</body>

</html>
