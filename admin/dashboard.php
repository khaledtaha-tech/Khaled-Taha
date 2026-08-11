<?php
require_once __DIR__ . '/../app/Helpers/functions.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$store_file = __DIR__ . '/../data/store.json';
$inquiries_file = __DIR__ . '/../data/inquiries.json';
$wa_orders_file = __DIR__ . '/../data/whatsapp_orders.json';

$store_data = file_exists($store_file) ? json_decode(file_get_contents($store_file), true) : ['software' => [], 'experiences' => []];
$inquiries = file_exists($inquiries_file) ? json_decode(file_get_contents($inquiries_file), true) : [];
$wa_orders = file_exists($wa_orders_file) ? json_decode(file_get_contents($wa_orders_file), true) : [];

$msg = '';

// Add / Update Software Tool
if (isset($_POST['save_tool'])) {
    $tool_id = trim($_POST['tool_id']);
    $existing_index = -1;

    foreach ($store_data['software'] as $index => $item) {
        if ($item['id'] === $tool_id) {
            $existing_index = $index;
            break;
        }
    }

    $tool_data = [
        'id' => $tool_id,
        'tag_en' => trim($_POST['tag_en']),
        'title_en' => trim($_POST['title_en']),
        'desc_en' => trim($_POST['desc_en']),
        'price' => trim($_POST['price']),
        'version' => trim($_POST['version'])
    ];

    if ($existing_index >= 0) {
        $store_data['software'][$existing_index] = $tool_data;
        $msg = "Software item updated successfully!";
    } else {
        $store_data['software'][] = $tool_data;
        $msg = "New software item added successfully!";
    }
    file_put_contents($store_file, json_encode($store_data, JSON_PRETTY_PRINT));
}

// Delete Software Tool
if (isset($_GET['delete_tool'])) {
    $delete_id = $_GET['delete_tool'];
    $store_data['software'] = array_values(array_filter($store_data['software'], function($item) use ($delete_id) {
        return $item['id'] !== $delete_id;
    }));
    file_put_contents($store_file, json_encode($store_data, JSON_PRETTY_PRINT));
    header('Location: dashboard.php?tab=software');
    exit;
}

// Add / Update Experience
if (isset($_POST['save_exp'])) {
    $exp_id = trim($_POST['exp_id']);
    $existing_index = -1;

    foreach ($store_data['experiences'] as $index => $item) {
        if ($item['id'] === $exp_id) {
            $existing_index = $index;
            break;
        }
    }

    $exp_data = [
        'id' => $exp_id,
        'period' => trim($_POST['period']),
        'title' => trim($_POST['title']),
        'desc' => trim($_POST['desc'])
    ];

    if ($existing_index >= 0) {
        $store_data['experiences'][$existing_index] = $exp_data;
        $msg = "Experience entry updated successfully!";
    } else {
        $store_data['experiences'][] = $exp_data;
        $msg = "New experience entry added successfully!";
    }
    file_put_contents($store_file, json_encode($store_data, JSON_PRETTY_PRINT));
}

// Delete Experience
if (isset($_GET['delete_exp'])) {
    $delete_id = $_GET['delete_exp'];
    $store_data['experiences'] = array_values(array_filter($store_data['experiences'], function($item) use ($delete_id) {
        return $item['id'] !== $delete_id;
    }));
    file_put_contents($store_file, json_encode($store_data, JSON_PRETTY_PRINT));
    header('Location: dashboard.php?tab=experiences');
    exit;
}

$active_tab = $_GET['tab'] ?? 'inquiries';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Khaled Taha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="p-4 bg-dark text-white">
    <div class="container">
        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
            <div>
                <h2 class="fw-bold mb-0">Control Panel Dashboard</h2>
                <span class="text-muted small">Manage portfolio content and view inquiries</span>
            </div>
            <div>
                <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-custom-outline me-2"><i class="fa-solid fa-globe me-1"></i> View Site</a>
                <a href="logout.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</a>
            </div>
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-success py-2 mb-4"><?php echo e($msg); ?></div>
        <?php endif; ?>

        <!-- Nav Navigation Bar -->
        <ul class="nav nav-tabs border-secondary mb-4" id="dashboardTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link text-white <?php echo $active_tab === 'inquiries' ? 'active bg-primary fw-bold' : ''; ?>" id="inquiries-tab" data-bs-toggle="tab" data-bs-target="#inquiries-panel" type="button">
                    <i class="fa-solid fa-envelope me-2"></i> Client Inquiries (<?php echo count($inquiries); ?>)
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-white <?php echo $active_tab === 'whatsapp' ? 'active bg-primary fw-bold' : ''; ?>" id="whatsapp-tab" data-bs-toggle="tab" data-bs-target="#whatsapp-panel" type="button">
                    <i class="fab fa-whatsapp me-2 text-success"></i> WhatsApp Orders (<?php echo count($wa_orders); ?>)
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-white <?php echo $active_tab === 'software' ? 'active bg-primary fw-bold' : ''; ?>" id="software-tab" data-bs-toggle="tab" data-bs-target="#software-panel" type="button">
                    <i class="fa-solid fa-box me-2"></i> Software Store Items
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-white <?php echo $active_tab === 'experiences' ? 'active bg-primary fw-bold' : ''; ?>" id="experiences-tab" data-bs-toggle="tab" data-bs-target="#experiences-panel" type="button">
                    <i class="fa-solid fa-briefcase me-2"></i> Work Experience
                </button>
            </li>
        </ul>

        <div class="tab-content" id="dashboardTabContent">
            <!-- Tab 1: Client Inquiries Inbox -->
            <div class="tab-pane fade <?php echo $active_tab === 'inquiries' ? 'show active' : ''; ?>" id="inquiries-panel">
                <div class="card-custom">
                    <h4 class="text-white fw-bold mb-3"><i class="fa-solid fa-inbox text-primary me-2"></i> Form Inquiries Inbox</h4>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Sender Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Inquiry Type</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($inquiries)): ?>
                                    <tr><td colspan="6" class="text-muted text-center py-4">No messages received yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($inquiries as $inq): ?>
                                    <tr>
                                        <td class="small text-muted"><?php echo e($inq['date']); ?></td>
                                        <td class="fw-bold"><?php echo e($inq['name']); ?></td>
                                        <td><?php echo e($inq['company']); ?></td>
                                        <td><a href="mailto:<?php echo e($inq['email']); ?>" class="text-info"><?php echo e($inq['email']); ?></a></td>
                                        <td><span class="badge bg-info"><?php echo e($inq['inquiry_type']); ?></span></td>
                                        <td class="small"><?php echo e($inq['message']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab 2: WhatsApp Order Logs -->
            <div class="tab-pane fade <?php echo $active_tab === 'whatsapp' ? 'show active' : ''; ?>" id="whatsapp-panel">
                <div class="card-custom">
                    <h4 class="text-white fw-bold mb-3"><i class="fab fa-whatsapp text-success me-2"></i> WhatsApp Direct Orders Log</h4>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($wa_orders)): ?>
                                    <tr><td colspan="4" class="text-muted text-center py-4">No WhatsApp orders recorded yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($wa_orders as $ord): ?>
                                    <tr>
                                        <td class="small text-muted"><?php echo e($ord['date']); ?></td>
                                        <td><span class="badge bg-secondary"><?php echo e($ord['product_id']); ?></span></td>
                                        <td class="fw-bold"><?php echo e($ord['product_name']); ?></td>
                                        <td class="text-success fw-bold"><?php echo e($ord['price']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Software Store Items (CRUD) -->
            <div class="tab-pane fade <?php echo $active_tab === 'software' ? 'show active' : ''; ?>" id="software-panel">
                <div class="card-custom mb-4">
                    <h4 class="text-white fw-bold mb-3"><i class="fa-solid fa-plus-circle text-primary me-2"></i> Add / Edit Software Tool</h4>
                    <form method="POST" class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label-custom">Tool ID</label>
                            <input type="text" name="tool_id" class="form-control form-control-custom" placeholder="SW-101" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Tool Title</label>
                            <input type="text" name="title_en" class="form-control form-control-custom" placeholder="Tool Name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom">Tag Category</label>
                            <input type="text" name="tag_en" class="form-control form-control-custom" placeholder="Extrusion / Planning" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label-custom">Price</label>
                            <input type="text" name="price" class="form-control form-control-custom" placeholder="$49.00" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label-custom">Version</label>
                            <input type="text" name="version" class="form-control form-control-custom" placeholder="v2.1" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-custom">Description</label>
                            <textarea name="desc_en" class="form-control form-control-custom" rows="2" placeholder="Description of the tool..." required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="save_tool" class="btn btn-custom-primary">Save Product</button>
                        </div>
                    </form>
                </div>

                <div class="card-custom">
                    <h4 class="text-white fw-bold mb-3">Current Software Items</h4>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Tag</th>
                                    <th>Price</th>
                                    <th>Version</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($store_data['software'] as $item): ?>
                                <tr>
                                    <td><span class="badge bg-secondary"><?php echo e($item['id']); ?></span></td>
                                    <td class="fw-bold"><?php echo e($item['title_en']); ?></td>
                                    <td><span class="badge bg-primary"><?php echo e($item['tag_en']); ?></span></td>
                                    <td class="text-success fw-bold"><?php echo e($item['price']); ?></td>
                                    <td><?php echo e($item['version']); ?></td>
                                    <td>
                                        <a href="?delete_tool=<?php echo urlencode($item['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this tool?');"><i class="fa-solid fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab 4: Work Experience (CRUD) -->
            <div class="tab-pane fade <?php echo $active_tab === 'experiences' ? 'show active' : ''; ?>" id="experiences-panel">
                <div class="card-custom mb-4">
                    <h4 class="text-white fw-bold mb-3"><i class="fa-solid fa-plus-circle text-primary me-2"></i> Add / Edit Experience</h4>
                    <form method="POST" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label-custom">ID</label>
                            <input type="text" name="exp_id" class="form-control form-control-custom" placeholder="EXP-1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Period Date</label>
                            <input type="text" name="period" class="form-control form-control-custom" placeholder="Jan 2025 - Present" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label-custom">Job Title & Company</label>
                            <input type="text" name="title" class="form-control form-control-custom" placeholder="Manufacturing Manager - Company Name" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-custom">Description</label>
                            <textarea name="desc" class="form-control form-control-custom" rows="2" placeholder="Experience description..." required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="save_exp" class="btn btn-custom-primary">Save Experience</button>
                        </div>
                    </form>
                </div>

                <div class="card-custom">
                    <h4 class="text-white fw-bold mb-3">Current Experience List</h4>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Period</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($store_data['experiences'] as $exp): ?>
                                <tr>
                                    <td><span class="badge bg-secondary"><?php echo e($exp['id']); ?></span></td>
                                    <td class="small text-muted"><?php echo e($exp['period']); ?></td>
                                    <td class="fw-bold"><?php echo e($exp['title']); ?></td>
                                    <td class="small"><?php echo e($exp['desc']); ?></td>
                                    <td>
                                        <a href="?delete_exp=<?php echo urlencode($exp['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');"><i class="fa-solid fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
