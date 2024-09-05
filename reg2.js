 // JavaScript to handle popup functionality
 const popup = document.getElementById('popup');
 const closeBtn = document.querySelector('.close');

 // Show popup when the Submit button is clicked
 document.querySelector('.btn').addEventListener('click', function (e) {
     e.preventDefault();  // Prevent form submission
     popup.style.display = 'block';  // Show the popup
 });

 // Close popup when the Close button is clicked
 closeBtn.addEventListener('click', function () {
     popup.style.display = 'none';  // Hide the popup
 });