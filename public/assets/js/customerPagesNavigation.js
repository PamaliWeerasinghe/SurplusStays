document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname;
    const navMenu = document.querySelector(".buttons");
    
    // Use event delegation to handle click events
    navMenu.addEventListener("click", function (event) {
        const button = event.target.closest(".btn-nonSelected");
        if (!button) return;

        const targetPaths = button.dataset.paths ? button.dataset.paths.split(",") : [button.dataset.path];
        
        // Remove 'active' class from all buttons and add to the clicked one
        document.querySelectorAll(".btn-nonSelected").forEach((btn) => btn.classList.remove("btn-Selected"));
        button.classList.add("btn-Selected");

        // Navigate to the first target path
        const targetPath = targetPaths[0];
        if (targetPath) {
            window.location.href = targetPath;
        }
    });

    // Set the active class based on the current URL
    document.querySelectorAll(".btn-nonSelected").forEach((button) => {
        const targetPaths = button.dataset.paths ? button.dataset.paths.split(",") : [button.dataset.path];
        if (targetPaths.includes(currentPath)) {
            button.classList.add("btn-Selected");
        }
    });
});