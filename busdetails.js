function loadBusDetails() {
    fetch('http://localhost/busbuddy/busdetails.php')
        .then(response => {
            console.log('Fetch response:', response);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched data:', data);
            const busList = document.getElementById('bus-list');

            busList.innerHTML = '';

            data.forEach(bus => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${bus.bus_no}</td>
                    <td>${bus.bus_license}</td>
                    <td>${bus.location}</td>
                    <td>${bus.capacity}</td>
                `;
                
                busList.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching bus details:', error);
        });
}

window.onload = function() {
    loadBusDetails();
};
