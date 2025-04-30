/**
 * Handle blog post view toggle between grid and list views
 */
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const viewToggleButtons = document.querySelectorAll('.view-toggle__btn');
        const postsContainer = document.querySelector('.posts-container');
        
        // Get the saved view preference from localStorage
        const savedView = localStorage.getItem('blogViewPreference') || 'grid';
        
        // Apply the saved view preference
        if (savedView === 'list') {
            postsContainer.classList.remove('view-grid');
            postsContainer.classList.add('view-list');
            document.querySelector('.view-toggle__btn--list').classList.add('active');
            document.querySelector('.view-toggle__btn--grid').classList.remove('active');
        }

        viewToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const view = this.dataset.view;
                
                // Remove active class from all buttons
                viewToggleButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Update container class
                postsContainer.classList.remove('view-grid', 'view-list');
                postsContainer.classList.add('view-' + view);
                
                // Save preference to localStorage
                localStorage.setItem('blogViewPreference', view);
            });
        });
    });
})(); 