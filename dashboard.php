<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once 'db.php';

// Check if a record is selected for update
$edit_data = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_query = $conn->prepare("SELECT id, firstname, lastname FROM students WHERE id = ?");
    $edit_query->bind_param("i", $edit_id);
    $edit_query->execute();
    $edit_data = $edit_query->get_result()->fetch_assoc();
}

// Fetch total students and list
$total_result = $conn->query("SELECT COUNT(*) AS total FROM students");
$total_count = $total_result ? $total_result->fetch_assoc()['total'] : 0;
$records = $conn->query("SELECT id, firstname, lastname FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academic Workspace | Student Management</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header class="nav-header">
    <div class="nav-brand">
      <span>📚 Academic Desk</span>
      <span class="nav-badge">v2.0</span>
    </div>
    <div class="nav-user">
      <span class="user-tag"><?= htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']); ?></span>
      <a href="logout.php" class="btn-logout">Exit Portal</a>
    </div>
  </header>

  <div class="layout-container">

    <div class="stats-row">
      <div class="card-stat">
        <span>Registered Students</span>
        <strong><?= (int)$total_count; ?></strong>
      </div>
      <div class="card-stat">
        <span>Active Instance</span>
        <strong style="font-size: 16px; color: #0284c7; margin-top: 10px;">phpcrudbolalin</strong>
      </div>
      <div class="card-stat">
        <span>Server Pipeline</span>
        <strong style="font-size: 16px; color: var(--accent); margin-top: 10px;">● Operational</strong>
      </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success">Transaction finished successfully.</div>
    <?php elseif (isset($_GET['error'])): ?>
      <div class="alert alert-error">Unable to complete the requested action.</div>
    <?php endif; ?>

    <div class="content-grid">
      <!-- Side form panel for Create / Edit -->
      <section class="form-panel">
        <div class="panel-title">
          <span><?= $edit_data ? 'Update Profile' : 'Register Student'; ?></span>
          <?php if ($edit_data): ?>
            <a href="dashboard.php" style="font-size: 12px; color: var(--text-muted); text-decoration: none;">✕ Cancel</a>
          <?php endif; ?>
        </div>

        <form action="action.php" method="POST">
          <input type="hidden" name="action_type" value="<?= $edit_data ? 'update' : 'create'; ?>">
          <?php if ($edit_data): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($edit_data['id']); ?>">
          <?php endif; ?>

          <div class="form-group">
            <label for="firstname">Given Name</label>
            <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($edit_data['firstname'] ?? ''); ?>" required placeholder="e.g. Maria">
          </div>

          <div class="form-group">
            <label for="lastname">Family Name</label>
            <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($edit_data['lastname'] ?? ''); ?>" required placeholder="e.g. Clara">
          </div>

          <button type="submit" class="btn-primary">
            <?= $edit_data ? 'Save Changes' : 'Enroll Student'; ?>
          </button>
        </form>
      </section>

      <!-- Main Directory Table -->
      <section class="table-panel">
        <div class="panel-title">
          <span>Roster Directory</span>
        </div>

        <table>
          <thead>
            <tr>
              <th style="width: 70px;">ID</th>
              <th>Student Name</th>
              <th style="text-align: right; width: 140px;">Manage</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($records && $records->num_rows > 0): ?>
              <?php while ($row = $records->fetch_assoc()): ?>
                <tr>
                  <td><span class="row-badge">#<?= str_pad($row['id'], 3, '0', STR_PAD_LEFT); ?></span></td>
                  <td><strong><?= htmlspecialchars($row['lastname'] . ', ' . $row['firstname']); ?></strong></td>
                  <td>
                    <div class="table-actions">
                      <a href="dashboard.php?edit=<?= $row['id']; ?>" class="btn-action-edit">Edit</a>
                      <a href="action.php?delete=<?= $row['id']; ?>" class="btn-action-del" onclick="return confirm('Remove student record permanent?');">Remove</a>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 30px;">No students enrolled yet. Add the first one using the form.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>
    </div>

  </div>

</body>
</html>