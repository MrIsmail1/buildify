
document.addEventListener("DOMContentLoaded", function() {
    
    var sidebar = document.getElementById('sidebar');
    var toggleButton = document.getElementById('toggleSidebar');

    toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
    });
    
});


