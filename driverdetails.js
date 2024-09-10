function loadBusDetails() {
    fetch('http://localhost/busbuddy/driverdetails.php')
        .then(response => {
            console.log('Fetch response:', response);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched data:', data);
            const driverList = document.getElementById('driver-list');

            // Clear the table
            driverList.innerHTML = '';

            // Populate the table with bus details
            data.forEach(driver => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${driver.driver_id}</td>
                    <td>${driver.driver_name}</td>
                    <td>${driver.bus_no}</td>
                    <td>${driver.phone_number}</td>
                `;
                
                driverList.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching driver details:', error);
        });
}

// Initialize the table when the page loads
window.onload = function() {
    loadBusDetails();
};
