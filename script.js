function checkAvailability() {
  const size = document.getElementById("size").value;
  const color = document.getElementById("color").value;
  const tbody = document.querySelector("#results-table tbody");

  tbody.innerHTML = "";

  if (!size || !color) {
    alert("Please select both size and color.");
    return;
  }

  const availability = Math.random() > 0.5 ? "In Stock" : "Out of Stock";

  const row = document.createElement("tr");
  row.innerHTML = `
    <td>${size}</td>
    <td>${color}</td>
    <td>${availability}</td>
  `;

  tbody.appendChild(row);
}
