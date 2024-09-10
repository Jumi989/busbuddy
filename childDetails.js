function loadBusDetails() {
    fetch('http://localhost/busbuddy/childdetails.php')
        .then(response => {
            console.log('Fetch response:', response);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched data:', data);
            const childList = document.getElementById('child-list');

            childList.innerHTML = '';

            data.forEach(child => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${child.user_name}</td>
                    <td>${child.contact_no}</td>
                    <td>${child.child_name}</td>
                    <td>${child.dob}</td>
                    <td>${child.school_name}</td>
                    <td>${child.student_id}</td>
                    <td>${child.service_status}</td>
                    <td>${child.bus_no}</td>
                    <td>${child.password_user}</td>

                `;
                
                childList.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching child details:', error);
        });
}

window.onload = function() {
    loadBusDetails();
};
