<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/Helpers/functions.php';
require_once __DIR__ . '/../app/Helpers/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$msg = '';
$active_tab = $_GET['tab'] ?? 'inquiries';

// Save / Update Software Tool
if (isset($_POST['save_tool'])) {
    $tool_id = trim($_POST['tool_id']);
    $tag_en = trim($_POST['tag_en']);
    $title_en = trim($_POST['title_en']);
    $desc_en = trim($_POST['desc_en']);
    $price = trim($_POST['price']);
    $version = trim($_POST['version']);

    $sql = "INSERT INTO software (id, tag_en, title_en, desc_en, price, version) VALUES (?, ?, ?, ?, ?, ?)
            ON CONFLICT(id) DO UPDATE SET tag_en=excluded.tag_en, title_en=excluded.title_en, desc_en=excluded.desc_en, price=excluded.price, version=excluded.version;";
    turso_query($sql, [$tool_id, $tag_en, $title_en, $desc_en, $price, $version]);
    header('Location: dashboard.php?tab=software&status=saved');
    exit;
}

// Delete Software Tool
if (isset($_GET['delete_tool'])) {
    $delete_id = $_GET['delete_tool'];
    turso_query("DELETE FROM software WHERE id = ?", [$delete_id]);
    header('Location: dashboard.php?tab=software&status=deleted');
    exit;
}

// Save / Update Experience
if (isset($_POST['save_exp'])) {
    $exp_id = trim($_POST['exp_id']);
    $period = trim($_POST['period']);
    $title = trim($_POST['title']);
    $desc = trim($_POST['desc']);

    $sql = "INSERT INTO experiences (id, period, title, \"desc\") VALUES (?, ?, ?, ?)
            ON CONFLICT(id) DO UPDATE SET period=excluded.period, title=excluded.title, \"desc\"=excluded.\"desc\";";
    turso_query($sql, [$exp_id, $period, $title, $desc]);
    header('Location: dashboard.php?tab=experiences&status=saved');
    exit;
}

// Delete Experience
if (isset($_GET['delete_exp'])) {
    $delete_id = $_GET['delete_exp'];
    turso_query("DELETE FROM experiences WHERE id = ?", [$delete_id]);
    header('Location: dashboard.php?tab=experiences&status=deleted');
    exit;
}

// Fetch Data directly from Turso Cloud
$inquiries = get_turso_rows("SELECT * FROM inquiries ORDER BY id DESC;");
$software_items = get_turso_rows("SELECT * FROM software;");
$experiences_items = get_turso_rows("SELECT * FROM experiences;");

// WhatsApp Order Logs
$wa_orders_file = __DIR__ . '/../data/whatsapp_orders.json';
$wa_orders = file_exists($wa_orders_file) ? json_decode(file_get_contents($wa_orders_file), true) : [];

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'saved') {
        $msg = 'Item saved successfully to Turso Cloud!';
    } elseif ($_GET['status'] === 'deleted') {
        $msg = 'Item deleted successfully!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Khaled Taha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="p-4 bg-dark text-white">
    <div class="container-fluid" style="max-width: 1200px;">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
            <div>
                <h2 class="fw-bold mb-0 text-white">Control Panel Dashboard</h2>
                <span class="text-muted small">Manage portfolio content and view inquiries</span>
            </div>
            <div>
                <a href="../index.php" target="_blank" class="btn btn-custom-outline me-2"><i class="fa-solid fa-globe me-1"></i> View Site</a>
                <a href="logout.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</a>
            </div>
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-success py-2 mb-4"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <ul class="nav nav-pills border-bottom border-secondary pb-3 mb-4 gap-2" id="dashboardTabs">
            <li class="nav-item">
                <a href="?tab=inquiries" class="nav-link text-white <?php echo $active_tab === 'inquiries' ? 'active bg-primary fw-bold' : 'btn-custom-outline'; ?>">
                    <i class="fa-solid fa-envelope me-2"></i> Client Inquiries (<?php echo count($inquiries); ?>)
                </a>
            </li>
            <li class="nav-item">
                <a href="?tab=whatsapp" class="nav-link text-white <?php echo $active_tab === 'whatsapp' ? 'active bg-primary fw-bold' : 'btn-custom-outline'; ?>">
                    <i class="fab fa-whatsapp me-2 text-success"></i> WhatsApp Orders (<?php echo count($wa_orders); ?>)
                </a>
            </li>
            <li class="nav-item">
                <a href="?tab=software" class="nav-link text-white <?php echo $active_tab === 'software' ? 'active bg-primary fw-bold' : 'btn-custom-outline'; ?>">
                    <i class="fa-solid fa-box me-2"></i> Software Store Items (<?php echo count($software_items); ?>)
                </a>
            </li>
            <li class="nav-item">
                <a href="?tab=experiences" class="nav-link text-white <?php echo $active_tab === 'experiences' ? 'active bg-primary fw-bold' : 'btn-custom-outline'; ?>">
                    <i class="fa-solid fa-briefcase me-2"></i> Work Experience (<?php echo count($experiences_items); ?>)
                </a>
            </li>
        </ul>

        <div>
            <?php if ($active_tab === 'inquiries'): ?>
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
                                        <td class="small text-muted"><?php echo htmlspecialchars($inq['date'] ?? ''); ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($inq['name'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($inq['company'] ?? ''); ?></td>
                                        <td><a href="mailto:<?php echo htmlspecialchars($inq['email'] ?? ''); ?>" class="text-info"><?php echo htmlspecialchars($inq['email'] ?? ''); ?></a></td>
                                        <td><span class="badge bg-info"><?php echo htmlspecialchars($inq['inquiry_type'] ?? ''); ?></span></td>
                                        <td class="small"><?php echo htmlspecialchars($inq['message'] ?? ''); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($active_tab === 'whatsapp'): ?>
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
                                        <td class="small text-muted"><?php echo htmlspecialchars($ord['date'] ?? ''); ?></td>
                                        <td><span class="badge bg-secondary"><?php echo htmlspecialchars($ord['product_id'] ?? ''); ?></span></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($ord['product_name'] ?? ''); ?></td>
                                        <td class="text-success fw-bold"><?php echo htmlspecialchars($ord['price'] ?? ''); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($active_tab === 'software'): ?>
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
                                <?php foreach ($software_items as $item): ?>
                                <tr>
                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($item['id'] ?? ''); ?></span></td>
                                    <td class="fw-bold"><?php echo htmlspecialchars($item['title_en'] ?? ''); ?></td>
                                    <td><span class="badge bg-primary"><?php echo htmlspecialchars($item['tag_en'] ?? ''); ?></span></td>
                                    <td class="text-success fw-bold"><?php echo htmlspecialchars($item['price'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($item['version'] ?? ''); ?></td>
                                    <td>
                                        <a href="?tab=software&delete_tool=<?php echo urlencode($item['id'] ?? ''); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this tool?');"><i class="fa-solid fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($active_tab === 'experiences'): ?>
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
                                <?php foreach ($experiences_items as $exp): ?>
                                <tr>
                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($exp['id'] ?? ''); ?></span></td>
                                    <td class="small text-muted"><?php echo htmlspecialchars($exp['period'] ?? ''); ?></td>
                                    <td class="fw-bold"><?php echo htmlspecialchars($exp['title'] ?? ''); ?></td>
                                    <td class="small"><?php echo htmlspecialchars($exp['desc'] ?? ''); ?></td>
                                    <td>
                                        <a href="?tab=experiences&delete_exp=<?php echo urlencode($exp['id'] ?? ''); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');"><i class="fa-solid fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
