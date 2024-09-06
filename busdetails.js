// Function to load and display bus details in the table
function loadBusDetails() {
    fetch('fetch-bus-details.php')  // Fetch data from PHP
        .then(response => response.json())
        .then(data => {
            const busList = document.getElementById('bus-list');

            // Clear the table
            busList.innerHTML = '';

            // Populate the table with bus details
            data.forEach(bus => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${bus.number}</td>
                    <td>${bus.license}</td>
                    <td>${bus.location}</td>
                    
                    <td class="actions">
                        <button onclick="viewBus(${bus.id})">View</button>
                        <button onclick="deleteBus(${bus.id})">Delete</button>
                    </td>
                `;
                
                busList.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching bus details:', error);
        });
}

// Function to handle viewing bus details
function viewBus(id) {
    alert(`Viewing details for bus ID: ${id}`);
}

// Function to handle deleting bus details
function deleteBus(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        // Send a request to the server to delete the bus from the database
        fetch(`delete-bus.php?id=${id}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            loadBusDetails();  // Refresh the table after deletion
        })
        .catch(error => {
            console.error('Error deleting bus:', error);
        });
    }
}

// Initialize the table when the page loads
window.onload = function() {
    loadBusDetails();
};
