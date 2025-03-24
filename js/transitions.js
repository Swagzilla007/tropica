document.addEventListener('DOMContentLoaded', function() {
    document.body.classList.add('page-transition');
    
    // Handle link clicks for smooth transitions
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.href.includes('#') && this.href.includes(window.location.origin)) {
                e.preventDefault();
                document.body.classList.add('fade-out');
                setTimeout(() => {
                    window.location.href = this.href;
                }, 300);
            }
        });
    });
});
