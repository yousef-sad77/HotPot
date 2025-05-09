<div class="dash-con container mt-5 mb-auto">
  <h2 class="mb-4 text-center">Welcome back, Admin 🌸</h2>

  <!-- Tabs Navigation -->
  <ul class="nav nav-tabs mb-3" id="adminTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="meals-tab" data-bs-toggle="tab" data-bs-target="#meals" type="button"
        role="tab" aria-controls="meals" aria-selected="true">
        Meals
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab"
        aria-controls="users" aria-selected="false">
        Users
      </button>
    </li>
  </ul>

  <!-- Tabs Content -->
  <div class="tab-content" id="adminTabContent">

    <!-- Meals Tab -->
    <div class="tab-pane fade show active" id="meals" role="tabpanel" aria-labelledby="meals-tab">
      <div class="card shadow col">
        <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white">
          <h5 class="mb-0">Meals List</h5>
          <button class="btn btn-sm btn-success" id="addMealBtn">Add Meal</button>
        </div>
        <div class="card-body p-0">
          <table class="table table-bordered table-hover text-center m-0 align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Meal</th>
                <th>Description</th>
                <th>Price ($)</th>
                <th>Amount</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="mealTable">
              <?php
              require_once('./MVC/module/db_connect.php');

              $sql = "SELECT * FROM products";
              $result = $conn->query($sql);
              $counter = 1;

              if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                  ?>
                  <tr>
                    <td><?= $counter++ ?></td>
                    <td contenteditable="true"><?= htmlspecialchars($row['product_name']) ?></td>
                    <td contenteditable="true"><?= htmlspecialchars($row['description']) ?></td>
                    <td contenteditable="true"><?= number_format($row['price'], 2) ?></td>
                    <td contenteditable="true">10</td> <!-- Placeholder for amount -->
                    <td>
                      <img src="<?= htmlspecialchars($row['image']) ?>" style="width:50px;" class="rounded" alt="Meal" />
                    </td>
                    <td>
                      <button class="btn btn-sm btn-warning update-btn" data-id="<?= $row['id'] ?>">Update</button>
                      <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">Delete</button>
                    </td>
                  </tr>
                  <?php
                endwhile;
              else:
                ?>
                <tr>
                  <td colspan="7">No meals found.</td>
                </tr>
              <?php endif; ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>

    <!-- Users Tab -->
    <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
      <div class="card shadow col">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0">Users List</h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-bordered table-hover text-center m-0 align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="userTable">
              <?php

              // Include necessary files for the session and database connection
              
              // Fetch user data from the database
              $sql = "SELECT id, username, email, role FROM users";
              $result = $conn->query($sql);

              // Check if there are any users in the database
              if ($result->num_rows > 0) {
                // Loop through each user and display in table rows
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>" . htmlspecialchars($row['id']) . "</td>
                          <td contenteditable='true' class='editable' data-field='username'>" . htmlspecialchars($row['username']) . "</td>
                          <td contenteditable='true' class='editable' data-field='email'>" . htmlspecialchars($row['email']) . "</td>
                          <td contenteditable='true' class='editable' data-field='role'>" . htmlspecialchars($row['role']) . "</td>
                          <td>
                            <button class='btn btn-sm btn-warning update-btn' data-id='" . htmlspecialchars($row['id']) . "'>Update</button>
                            <button class='btn btn-sm btn-danger delete-btn' data-id='" . $row['id'] . "'>Delete</button>
                          </td>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
      <div id="liveToast" class="toast align-items-center text-white bg-success border-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body" id="toastMessage">
            Success!
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
    </div>
  </div>
</div>