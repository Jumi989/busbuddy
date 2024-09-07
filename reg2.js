 // JavaScript to handle popup functionality
const popup = document.getElementById('popup');
const closeBtn = document.querySelector('.close');
const goBackBtn = document.querySelector('.go-back');  // Get the 'Go Back' button

// Show popup when the Submit button is clicked
document.querySelector('.btn').addEventListener('click', function (e) {
    e.preventDefault();  // Prevent form submission
    popup.style.display = 'block';  // Show the popup
});

// Close popup when the Close button is clicked
closeBtn.addEventListener('click', function () {
    popup.style.display = 'none';  // Hide the popup
});

// Redirect to home page or a specific link when 'Go Back' button is clicked
goBackBtn.addEventListener('click', function () {
    window.location.href = 'index.html';  // Redirect to home page (or any other link)
});
