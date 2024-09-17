const toggleOptions = document.querySelectorAll('.toggle-option');

toggleOptions.forEach(option => {
    option.addEventListener('click', () => {
        // Remove 'active' class from all options
        toggleOptions.forEach(btn => btn.classList.remove('active'));

        // Add 'active' class to clicked option
        option.classList.add('active');

        // You can now use the 'data-status' attribute to handle different logic
        const status = option.getAttribute('data-status');
        console.log(`Selected status: ${status}`);
    });
});
