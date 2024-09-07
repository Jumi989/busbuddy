window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    const status = params.get('status');

    if (status === 'success') {
        document.getElementById('popup').style.display = 'block';
    }

    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('popup').style.display = 'none';
    });
};
