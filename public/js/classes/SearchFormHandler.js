class SearchFormHandler {
    constructor(formId, inputId, buttonId, filterSelectors, orderSelector) {
        this.searchForm = document.getElementById(formId);
        this.searchInput = document.getElementById(inputId);
        this.searchBtn = document.getElementById(buttonId);
        this.filterSelectors = filterSelectors.map((selector) =>
            document.getElementById(selector)
        );

        this.orderSelector = document.getElementById(orderSelector);

        this.initializeEvents();
    }

    initializeEvents() {
        // Prevent form submission if input is empty
        this.searchForm.addEventListener("submit", (e) => {
            if (
                this.searchInput.value.trim() === "" &&
                !this.isAnyFilterSelected() &&
                !this.isAnyOptionSelected()
            ) {
                e.preventDefault();
                alert(
                    "Veuillez entrer un terme de recherche ou choisir un filtre ou sélectionner un ordre de tri."
                );
            }
        });

        // Handle click on the search button to focus on the input if empty
        this.searchBtn.addEventListener("click", (e) => {
            if (
                this.searchInput.value.trim() === "" &&
                !this.isAnyFilterSelected() &&
                !this.isAnyOptionSelected()
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

    // Check if an ordering option is selected
    isAnyOptionSelected() {
        return this.orderSelector && this.orderSelector.value.trim() !== "";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new SearchFormHandler(
        "search-form",
        "search-input",
        "search-btn",
        ["color", "country", "size"],
        "order"
    );
});
