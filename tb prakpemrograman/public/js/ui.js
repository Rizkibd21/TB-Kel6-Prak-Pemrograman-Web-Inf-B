
// Mobile Sidebar Toggle
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('aside');
    const mobileMenuBtn = document.querySelector('header button'); // Assuming the first button in header is the menu toggle
    const overlay = document.createElement('div');
    
    // Setup Overlay
    overlay.className = 'fixed inset-0 bg-black/50 z-10 hidden transition-opacity opacity-0';
    document.body.appendChild(overlay);

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', function() {
            // Toggle sidebar visibility
            const isHidden = sidebar.classList.contains('hidden');
            
            if (isHidden) {
                // Show Sidebar
                sidebar.classList.remove('hidden');
                sidebar.classList.add('fixed', 'inset-y-0', 'left-0', 'u-shadow-2xl');
                // Show Overlay
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                // Hide Sidebar
                sidebar.classList.add('hidden');
                sidebar.classList.remove('fixed', 'inset-y-0', 'left-0', 'u-shadow-2xl');
                // Hide Overlay
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        });

        // Close when clicking overlay
        overlay.addEventListener('click', function() {
             sidebar.classList.add('hidden');
             sidebar.classList.remove('fixed', 'inset-y-0', 'left-0', 'u-shadow-2xl');
             overlay.classList.add('opacity-0');
             setTimeout(() => overlay.classList.add('hidden'), 300);
        });
    }
});
