
document.addEventListener('DOMContentLoaded', function () {
  function showToast(message, isSuccess = true) {
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toastMessage');
    if (!toastEl || !toastBody) {
      console.error("Toast elements not found!");
      return;  // Skip if toast elements don't exist
    }
    toastBody.textContent = message;
    toastEl.classList.remove('bg-success', 'bg-danger');
    toastEl.classList.add(isSuccess ? 'bg-success' : 'bg-danger');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  }

  let mealId = 2; // Starting index for new rows
  document.getElementById('addMealBtn').addEventListener('click', function () {
    const table = document.getElementById('mealTable');

    const row = table.insertRow();
    row.innerHTML = `
    <td>${mealId++}</td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>

    <td>
      <button class="btn btn-sm btn-warning save-btn" onclick="">Save</button>
      <button class="btn btn-sm btn-danger delete-btn" onclick="this.closest('tr').remove()">Delete</button>
      </td>
  `;
    row.cells[1].focus();
    addSaveMealButtonEventListener();
  });
  document.querySelectorAll('#mealTable .update-btn').forEach(button => {
    button.addEventListener('click', function () {
      const row = this.closest('tr');
      const id = this.dataset.id;
      const name = row.cells[1].innerText.trim();
      const description = row.cells[2].innerText.trim();
      const price = row.cells[3].innerText.trim();

      fetch('./MVC/controller/update_meals.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, name, description, price })
      })
        .then(res => {
          if (!res.ok) {
            throw new Error('Network response was not ok');
          }
          return res.json();
        })
        .then(data => {
          if (data.success) {
            showToast("Meal updated successfully!");
          } else {
            showToast("Update failed: " + (data.error || "Unknown error"), false);
          }
        })
        .catch(err => {
          showToast("Something went wrong: " + err.message, false);
        });
    });
  });
  let mealIdToDelete = null;
  document.querySelectorAll('#mealTable .delete-btn').forEach(button => {
    button.addEventListener('click', function () {
      mealIdToDelete = this.dataset.id; // Store the ID of the meal to delete
      // Show the modal
      const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
      modal.show();
    });
  });
  function addSaveMealButtonEventListener() {
    document.querySelectorAll('#mealTable .save-btn').forEach(button => {
      button.addEventListener('click', function () {
        const row = this.closest('tr');
        const name = row.cells[1].innerText.trim();
        const description = row.cells[2].innerText.trim();
        const price = row.cells[3].innerText.trim();
        const amount = row.cells[4].innerText.trim();

        fetch('./MVC/controller/save_meals.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, description, price, amount })
        })
          .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
          })
          .then(data => {
            if (data.success) {
              showToast("Meal saved successfully!");

              // Update the button to be an update button
              this.classList.remove('save-btn', 'btn-success');
              this.classList.add('update-btn', 'btn-warning');
              this.innerText = 'Update';
              this.dataset.id = data.id;
            } else {
              showToast("Save failed: " + (data.error || "Unknown error"), false);
            }
          })
          .catch(err => {
            showToast("Something went wrong: " + err.message, false);
          });
      });
    });
  }

  let userId = 2;
  document.getElementById('addUserBtn').addEventListener('click', function () {
    const table = document.getElementById('userTable');

    const row = table.insertRow();
    row.innerHTML = `
    <td>${userId++}</td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>
    <td contenteditable="true"></td>

    <td>
      <button class="btn btn-sm btn-warning save-btn" onclick="">Save</button>
      <button class="btn btn-sm btn-danger delete-btn" onclick="this.closest('tr').remove()">Delete</button>
      </td>
  `;
    row.cells[1].focus();
    addSaveUserButtonEventListener();

  });
  document.querySelectorAll('#userTable .update-btn').forEach(button => {
    button.addEventListener('click', function () {
      const row = this.closest('tr');
      const id = this.dataset.id;
      const username = row.cells[1].innerText.trim();
      const email = row.cells[2].innerText.trim();
      const role = row.cells[3].innerText.trim();

      fetch('./MVC/controller/update_users.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, username, email, role })
      })
        .then(res => {
          if (!res.ok) throw new Error('Network response was not ok');
          return res.json(); // This line might throw if it's not valid JSON
        })
        .then(data => {
          console.log("Server response:", data); // 🔍 Add this
          if (data.success) {
            showToast("User updated successfully!");
          } else {
            showToast("Update failed: " + (data.error || "Unknown error"), false);
          }
        })
        .catch(err => {
          showToast("Something went wrong: " + err.message, false);
        });
    });
  });
  let userIdToDelete = null;
  document.querySelectorAll('#userTable .delete-btn').forEach(button => {
    button.addEventListener('click', function () {
      userIdToDelete = this.dataset.id; // Store the ID of the meal to delete
      // Show the modal
      const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
      modal.show();
    });
  });
  // function addSaveUserButtonEventListener() {
  //   document.querySelectorAll('#userTable .save-btn').forEach(button => {
  //     button.addEventListener('click', function () {
  //       const row = this.closest('tr');
  //       const username = row.cells[1].innerText.trim();
  //       const email = row.cells[2].innerText.trim();
  //       const role = row.cells[3].innerText.trim();

  //       fetch('./MVC/controller/save_users.php', {
  //         method: 'POST',
  //         headers: { 'Content-Type': 'application/json' },
  //         body: JSON.stringify({ username, email, role,password })  // Send username, email, and role
  //       })
  //         .then(res => {
  //           if (!res.ok) throw new Error('Network response was not ok');
  //           return res.json();
  //         })
  //         .then(data => {
  //           if (data.success) {
  //             showToast("User saved successfully!");

  //             // Update the button to be an update button (optional)
  //             this.classList.remove('save-btn', 'btn-success');
  //             this.classList.add('update-btn', 'btn-warning');
  //             this.innerText = 'Update';
  //             this.dataset.id = data.id;
  //           } else {
  //             showToast("Save failed: " + (data.error || "Unknown error"), false);
  //           }
  //         })
  //         .catch(err => {
  //           showToast("Something went wrong: " + err.message, false);
  //         });
  //     });
  //   });
  // }

  function addSaveUserButtonEventListener() {
    document.querySelectorAll('#userTable .save-btn').forEach(button => {
      button.addEventListener('click', function () {
        const row = this.closest('tr');
        const username = row.cells[1].innerText.trim();
        const email = row.cells[2].innerText.trim();
        const role = row.cells[3].innerText.trim();

        // Store button reference and data temporarily
        const saveBtn = this;

        // Show password modal
        const passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
        passwordModal.show();

        // Set up confirm button listener once
        const confirmBtn = document.getElementById('confirmPasswordBtn');
        confirmBtn.onclick = function () {
          const password = document.getElementById('passwordInput').value.trim();
          if (!password) {
            showToast("Password is required", false);
            return;
          }

          // Hide modal
          passwordModal.hide();

          // Send the request
          fetch('./MVC/controller/save_users.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, email, role, password })
          })
            .then(res => {
              if (!res.ok) throw new Error('Network response was not ok');
              return res.json();
            })
            .then(data => {
              if (data.success) {
                showToast("User saved successfully!");
                saveBtn.classList.remove('save-btn', 'btn-success');
                saveBtn.classList.add('update-btn', 'btn-warning');
                saveBtn.innerText = 'Update';
                saveBtn.dataset.id = data.id;
              } else {
                showToast("Save failed: " + (data.error || "Unknown error"), false);
              }
            })
            .catch(err => {
              showToast("Something went wrong: " + err.message, false);
            });
        };
      });
    });
  }

  document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (mealIdToDelete !== null) {
      // Send delete request for meal
      fetch('./MVC/controller/delete_meal.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: mealIdToDelete })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            modal.hide();

            // Remove the meal row from the table
            document.querySelector(`button[data-id="${mealIdToDelete}"]`).closest('tr').remove();
            showToast('Meal deleted successfully!');
          } else {
            showToast('Delete failed: ' + (data.error || 'Unknown error'), false);
          }
        })
        .catch(err => {
          showToast('Something went wrong: ' + err.message, false);
        });
    }

    if (userIdToDelete !== null) {
      // Send delete request for user
      fetch('./MVC/controller/delete_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: userIdToDelete }) // Use userIdToDelete instead of mealIdToDelete
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            modal.hide();

            // Remove the user row from the table
            document.querySelector(`button[data-id="${userIdToDelete}"]`).closest('tr').remove();
            showToast('User deleted successfully!');
          } else {
            showToast('Delete failed: ' + (data.error || 'Unknown error'), false);
          }
        })
        .catch(err => {
          showToast('Something went wrong: ' + err.message, false);
        });
    }
  });

  addSaveMealButtonEventListener();
  addSaveUserButtonEventListener();
});

// ///////////////////



