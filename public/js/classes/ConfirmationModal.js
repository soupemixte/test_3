class ConfirmationModal {
    constructor(deleteBtnSelector, popupOverlaySelector, cancelBtnSelector) {
        this.deleteBtnSelector = deleteBtnSelector;
        this.popupOverlaySelector = popupOverlaySelector;
        this.cancelBtnSelector = cancelBtnSelector;

        this.init();
    }

    init() {
        document.addEventListener("DOMContentLoaded", () => {
            this.setupEventListeners();
        });
    }

    setupEventListeners() {
        const deleteBtns = document.querySelectorAll(this.deleteBtnSelector);
        const popupOverlay = document.querySelector(this.popupOverlaySelector);

        deleteBtns.forEach((deleteBtn) => {
            deleteBtn.addEventListener("click", () => {
                popupOverlay.classList.remove("hide");
            });
        });

        const cancelBtn = popupOverlay.querySelector(this.cancelBtnSelector);
        cancelBtn.addEventListener("click", () => {
            popupOverlay.classList.add("hide");
        });
    }
}

// Initialize the PopupHandler with appropriate selectors
new ConfirmationModal("#delete-btn", ".popup-overlay", "#cancel-btn");
