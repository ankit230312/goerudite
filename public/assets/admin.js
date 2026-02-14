document.addEventListener("click", function (e) {

    // ADD ROW
    if (e.target.classList.contains("add-row")) {
        const currentRow = e.target.closest(".book-row");
        const newRow = currentRow.cloneNode(true);

        // Clear inputs
        newRow.querySelectorAll("input").forEach(input => {
            input.value = "";
        });

        // Show remove button
        newRow.querySelector(".remove-row").classList.remove("d-none");
         newRow.querySelector(".add-row").classList.add("d-none");

        document.getElementById("bookRows").appendChild(newRow);
    }

    // REMOVE ROW
    if (e.target.classList.contains("remove-row")) {
        e.target.closest(".book-row").remove();
    }

});
