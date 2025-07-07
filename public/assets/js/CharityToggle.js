const toggleOptions = document.querySelectorAll('.toggle-option1');

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

const toggleOptions2 = document.querySelectorAll('.toggle-option2');

toggleOptions2.forEach(option => {
    option.addEventListener('click', () => {
        // Remove 'active' class from all options
        toggleOptions2.forEach(btn => btn.classList.remove('active'));

        // Add 'active' class to clicked option
        option.classList.add('active');

        // You can now use the 'data-status' attribute to handle different logic
        const status = option.getAttribute('data-status');
        console.log(`Selected status: ${status}`);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.toggle-option1');
    const rows = document.querySelectorAll('.admin-order-table tbody tr');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const statusFilter = button.getAttribute('data-status');

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(4) button');
                if (!statusCell) return;

                const statusText = statusCell.textContent.trim().toLowerCase();

                if (statusFilter === 'all') {
                    row.style.display = '';
                } else if (
                    (statusFilter === 'yet-to-decide' && statusText === 'pending') ||
                    (statusFilter === 'accepted' && statusText === 'accepted') ||
                    (statusFilter === 'rejected' && statusText === 'rejected')
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.toggle-option2');
    const rows = document.querySelectorAll('.admin-order-table2 tbody tr');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const statusFilter = button.getAttribute('data-status');

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(4)');
                const hasActionDiv = statusCell.querySelector('.take-action-container');
                const buttonText = statusCell.querySelector('button')?.textContent.trim().toLowerCase();

                if (statusFilter === 'all') {
                    row.style.display = '';
                } else if (
                    (statusFilter === 'yet-to-decide' && hasActionDiv) ||
                    (statusFilter === 'accepted' && buttonText === 'accepted') ||
                    (statusFilter === 'rejected' && buttonText === 'rejected')
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});
