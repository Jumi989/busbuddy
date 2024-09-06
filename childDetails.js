// Function to load and display child details in the table
function loadChildDetails() {
    fetch('fetch-child-details.php')  // Fetch data from PHP
        .then(response => response.json())
        .then(data => {
            const childList = document.getElementById('child-list');

            // Clear the table
            childList.innerHTML = '';

            // Populate the table with child details
            data.forEach(child => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${child.id}</td>
                    <td>${child.name}</td>
                    <td>${child.school}</td>
                    <td>${child.contact}</td>
                    <td class="actions">
                        <button onclick="viewChild(${child.id})">View</button>
                        <button onclick="deleteChild(${child.id})">Delete</button>
                    </td>
                `;
                
                childList.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching child details:', error);
        });
}

// Function to handle viewing child details
function viewChild(id) {
    alert(`Viewing details for child ID: ${id}`);
}

// Function to handle deleting child details
function deleteChild(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        // Send a request to the server to delete the child from the database
        fetch(`delete-child.php?id=${id}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            loadChildDetails();  // Refresh the table after deletion
        })
        .catch(error => {
            console.error('Error deleting child:', error);
        });
    }
}

// Initialize the table when the page loads
window.onload = function() {
    loadChildDetails();
};
