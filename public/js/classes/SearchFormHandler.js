class SearchFormHandler {
    constructor(formId, inputId, buttonId, filterSelectors) {
        this.searchForm = document.getElementById(formId);
        this.searchInput = document.getElementById(inputId);
        this.searchBtn = document.getElementById(buttonId);
        this.filterSelectors = filterSelectors.map((selector) =>
            document.getElementById(selector)
        );

        this.initializeEvents();
    }

    initializeEvents() {
        // Prevent form submission if input is empty
        this.searchForm.addEventListener("submit", (e) => {
            if (
                this.searchInput.value.trim() === "" &&
                !this.isAnyFilterSelected()
            ) {
                e.preventDefault();
                alert(
                    "Veuillez entrer un terme de recherche ou choisir un filtre."
                );
            }
        });

        // Handle click on the search button to focus on the input if empty
        this.searchBtn.addEventListener("click", (e) => {
            if (
                this.searchInput.value.trim() === "" &&
                !this.isAnyFilterSelected()
            ) {
                e.preventDefault();
                this.searchInput.focus();
            }
        });
    }
    // Check if any filter option is selected
    isAnyFilterSelected() {
        return this.filterSelectors.some(
            (filter) => filter.value.trim() !== ""
        );
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new SearchFormHandler("search-form", "search-input", "search-btn", [
        "color",
        "country",
        "size",
    ]);
});
