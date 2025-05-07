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