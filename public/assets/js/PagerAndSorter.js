 // Save scroll position before sorting
 function saveScrollAndSort(selectElement) {
    // Save current scroll position
    localStorage.setItem('sortScrollPosition', window.scrollY || window.pageYOffset);
    
    // Navigate to the selected URL
    window.location.href = selectElement.value;
}

// Restore scroll position after page loads
window.addEventListener('load', function() {
    // Check if we have a saved scroll position from sorting
    const savedPosition = localStorage.getItem('sortScrollPosition');
    if (savedPosition) {
        // Restore the scroll position
        window.scrollTo(0, parseInt(savedPosition));
        
        // Clear the stored position
        localStorage.removeItem('sortScrollPosition');
        
        // Additional scroll after short delay to ensure it works
        setTimeout(function() {
            window.scrollTo(0, parseInt(savedPosition));
        }, 50);
    }
});
     document.addEventListener('DOMContentLoaded', function() {
   
    // Add click handler to all pagination links
    document.querySelectorAll('a[href*="_page="]').forEach(link => {
        link.addEventListener('click', function() {
            localStorage.setItem('pagerScrollPos', window.scrollY);
        });
    });
    
    // Restore position
    const savedPos = localStorage.getItem('pagerScrollPos');
    if (savedPos) {
        window.scrollTo(0, parseInt(savedPos));
        localStorage.removeItem('pagerScrollPos');
    }
});