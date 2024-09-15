document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('th').forEach(header => {
        header.addEventListener('click', function() {
            const dropdown = header.querySelector('.dropdown-content');
            if (dropdown) {
                dropdown.classList.toggle('show');
            }
        });
    });

    window.addEventListener('click', function(event) {
        if (!event.target.matches('th')) {
            document.querySelectorAll('.dropdown-content').forEach(dropdown => {
                if (dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            });
        }
    });
});
