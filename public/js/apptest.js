// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle'); // Hamburger button
    const wrapper = document.getElementById('wrapper'); // Main wrapper

    // Add a click event listener to the menu toggle button
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            // Toggle the 'toggled' class on the wrapper
            wrapper.classList.toggle('toggled');
        });
    }
});
