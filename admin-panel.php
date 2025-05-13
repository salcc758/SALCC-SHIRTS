<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.html');
    exit;
}

$conn = new mysqli("localhost", "root", "", "salcc_shirts");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM shirts");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <style>
    body { font-family: Arial; padding: 40px; background: #f0f0f0; }
    table { width: 90%; margin: auto; border-collapse: collapse; background: white; }
    th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
    input, select { padding: 5px; }
    button { padding: 6px 12px; background: #0f766e; color: white; border: none; cursor: pointer; }
    form.add-form {
      margin-top: 30px;
      background: white;
      padding: 20px;
      width: 90%;
      margin: 30px auto;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    form.add-form label {
      display: block;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Admin – Manage Shirt Inventory</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Size</th>
      <th>Color</th>
      <th>Quantity</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <form action="update-stock.php" method="post">
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['size']) ?></td>
          <td><?= htmlspecialchars($row['color']) ?></td>
          <td>
            <input type="number" name="quantity" value="<?= $row['quantity'] ?>" min="0" required />
            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
          </td>
          <td>
            <?php if ($row['quantity'] > 0): ?>
              In stock (<?= $row['quantity'] ?> left)
            <?php else: ?>
              Out of stock
            <?php endif; ?>
          </td>
          <td><button type="submit">Update</button></td>
        </form>
      </tr>
    <?php endwhile; ?>
  </table>

  <form class="add-form" action="add-shirt.php" method="post">
    <h3>Add New Shirt</h3>
    <label>
      Size:
      <select name="size" required>
        <option value="">Select Size</option>
        <option value="S">Small</option>
        <option value="M">Medium</option>
        <option value="L">Large</option>
        <option value="XL">X-Large</option>
      </select>
    </label>
    <label>
      Color:
      <input type="text" name="color" placeholder="e.g. Purple" required />
    </label>
    <label>
      Quantity:
      <input type="number" name="quantity" min="0" required />
    </label>
    <button type="submit">Add Shirt</button>
  </form>
</body>
</html>
