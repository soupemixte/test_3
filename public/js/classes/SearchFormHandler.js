class SearchFormHandler {
    constructor(formId, inputId, buttonId) {
        this.searchForm = document.getElementById(formId);
        this.searchInput = document.getElementById(inputId);
        this.searchBtn = document.getElementById(buttonId);

        this.initializeEvents();
    }

    initializeEvents() {
        // Prevent form submission if input is empty
        this.searchForm.addEventListener("submit", (e) => {
            if (this.searchInput.value.trim() === "") {
                e.preventDefault();
            }
        });

        // Handle click on the search button to focus on the input if empty
        this.searchBtn.addEventListener("click", (e) => {
            if (this.searchInput.value.trim() === "") {
                e.preventDefault();
                this.searchInput.focus();
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new SearchFormHandler("search-form", "search-input", "search-btn");
});
