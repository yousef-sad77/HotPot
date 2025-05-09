
document.addEventListener('DOMContentLoaded', function () {

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
    
    <td>
    <button class="btn btn-sm btn-warning" onclick="">Save</button>
      <button class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">Delete</button>
      </td>
  `;

    // Autofocus the Meal Name field
    row.querySelector('input[type="text"]').focus();
  });
  function showToast(message, isSuccess = true) {
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toastMessage');

    if (!toastEl || !toastBody) {
      console.error("Toast elements not found!");
      return;  // Skip if toast elements don't exist
    }

    toastBody.textContent = message;

    // Set color
    toastEl.classList.remove('bg-success', 'bg-danger');
    toastEl.classList.add(isSuccess ? 'bg-success' : 'bg-danger');

    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  }

  document.querySelectorAll('.update-btn').forEach(button => {
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


});