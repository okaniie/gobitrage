// View Mode Controller
const ViewModeController = {
    init() {
        this.viewport = document.querySelector('meta[name="viewport"]');
        this.applyViewMode();
    },

    applyViewMode() {
        if (!this.viewport) {
            this.viewport = document.createElement('meta');
            this.viewport.name = 'viewport';
            document.head.appendChild(this.viewport);
        }
        
        // Set viewport to 1.0 scale
        this.viewport.setAttribute('content', 'width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes');
    }
};

// Initialize view mode controller when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    ViewModeController.init();
}); 