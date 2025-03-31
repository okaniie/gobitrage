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
        
        // Set viewport to 0.1 scale
        this.viewport.setAttribute('content', 'width=device-width, initial-scale=0.1, maximum-scale=0.1, user-scalable=no');
    }
};

// Initialize view mode controller when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    ViewModeController.init();
}); 