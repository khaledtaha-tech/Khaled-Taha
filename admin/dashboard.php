<?php
require_once __DIR__ . '/../app/Helpers/functions.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$store_file = __DIR__ . '/../data/store.json';
$inquiries_file = __DIR__ . '/../data/inquiries.json';

$store_data = file_exists($store_file) ? json_decode(file_get_contents($store_file), true) : ['software' => []];
$inquiries = file_exists($inquiries_file) ? json_decode(file_get_contents($inquiries_file), true) : [];

$msg = '';

// Add New Tool
if (isset($_POST['add_tool'])) {
    $new_tool = [
        'id' => trim($_POST['tool_id']),
        'tag_en' => trim($_POST['tag_en']),
        'title_en' => trim($_POST['title_en']),
        'desc_en' => trim($_POST['desc_en']),
        'price' => trim($_POST['price']),
        'version' => trim($_POST['version'])
    ];
    
    $store_data['software'][] = $new_tool;
    file_put_contents($store_file, json_encode($store_data, JSON_PRETTY_PRINT));
    $msg = "New tool added successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Dashboard - Khaled Taha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="p-4 bg-dark text-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
            <h2>Online Control Panel</h2>
            <div>
                <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-custom-outline me-2"><i class="fa-solid fa-globe"></i> View Site</a>
                <a href="logout.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-success py-2 mb-4"><?php echo e($msg); ?></div>
        <?php endif; ?>

        <!-- Messages Inbox -->
        <div class="card-custom mb-5">
            <h4 class="text-white fw-bold mb-3"><i class="fa-solid fa-inbox text-primary me-2"></i> Client Inquiries Inbox</h4>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Sender</th>
                            <th>Company</th>
                            <th>Type</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($inquiries)): ?>
                            <tr><td colspan="5" class="text-muted text-center py-3">No messages received yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($inquiries as $inq): ?>
                            <tr>
                                <td class="small text-muted"><?php echo e($inq['date']); ?></td>
                                <td class="fw-bold"><?php echo e($inq['name']); ?><br><small class="text-muted"><?php echo e($inq['email']); ?></small></td>
                                <td><?php echo e($inq['company']); ?></td>
                                <td><span class="badge bg-info"><?php echo e($inq['inquiry_type']); ?></span></td>
                                <td class="small"><?php echo e($inq['message']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Tool Form & Tools List -->
        <div class="card-custom">
            <h4 class="text-white fw-bold mb-3"><i class="fa-solid fa-plus text-primary me-2"></i> Add New Software Tool</h4>
            <form method="POST" class="row g-3 mb-4">
                <div class="col-md-2"><input type="text" name="tool_id" class="form-control form-control-custom" placeholder="ID (e.g. SW-104)" required></div>
                <div class="col-md-3"><input type="text" name="title_en" class="form-control form-control-custom" placeholder="Tool Title" required></div>
                <div class="col-md-2"><input type="text" name="tag_en" class="form-control form-control-custom" placeholder="Tag (e.g. Planning)" required></div>
                <div class="col-md-2"><input type="text" name="price" class="form-control form-control-custom" placeholder="Price ($50.00)" required></div>
                <div class="col-md-2"><input type="text" name="version" class="form-control form-control-custom" placeholder="Version (v1.0)" required></div>
                <div class="col-md-12"><textarea name="desc_en" class="form-control form-control-custom" rows="2" placeholder="Description..." required></textarea></div>
                <div class="col-md-12"><button type="submit" name="add_tool" class="btn btn-custom-primary">Save Tool</button></div>
            </form>
        </div>
    </div>
</body>
</html>
