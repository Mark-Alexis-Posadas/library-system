document.addEventListener("DOMContentLoaded", () => {
    const bookModal = document.getElementById("bookModal");
    const bookForm = document.getElementById("bookForm");
    const bookModalTitle = document.getElementById("bookModalTitle");

    if (!bookModal) return;

    const bookCategory = document.getElementById("bookCategory");
    const bookTitle = document.getElementById("bookTitle");
    const bookIsbn = document.getElementById("bookIsbn");
    const bookAuthor = document.getElementById("bookAuthor");
    const bookPublisher = document.getElementById("bookPublisher");
    const bookPublicationYear = document.getElementById("bookPublicationYear");
    const bookQuantity = document.getElementById("bookQuantity");
    const bookShelfLocation = document.getElementById("bookShelfLocation");
    const bookDescription = document.getElementById("bookDescription");

    window.openCreateModal = function () {
        bookModalTitle.textContent = "Add Book";
        bookForm.action = window.bookRoutes?.store || "/books";

        bookForm.querySelector('input[name="_method"]')?.remove();

        bookCategory.value = "";
        bookTitle.value = "";
        bookIsbn.value = "";
        bookAuthor.value = "";
        bookPublisher.value = "";
        bookPublicationYear.value = "";
        bookQuantity.value = 0;
        bookShelfLocation.value = "";
        bookDescription.value = "";

        bookModal.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");
        bookCategory.focus();
    };

    window.openEditModal = function (
        id,
        categoryId,
        title,
        isbn,
        author,
        publisher,
        publicationYear,
        quantity,
        shelfLocation,
        description,
    ) {
        bookModalTitle.textContent = "Edit Book";
        bookForm.action = `/books/${id}`;

        bookForm.querySelector('input[name="_method"]')?.remove();

        const methodInput = document.createElement("input");
        methodInput.type = "hidden";
        methodInput.name = "_method";
        methodInput.value = "PUT";
        bookForm.appendChild(methodInput);

        bookCategory.value = categoryId ?? "";
        bookTitle.value = title ?? "";
        bookIsbn.value = isbn ?? "";
        bookAuthor.value = author ?? "";
        bookPublisher.value = publisher ?? "";
        bookPublicationYear.value = publicationYear ?? "";
        bookQuantity.value = quantity ?? 0;
        bookShelfLocation.value = shelfLocation ?? "";
        bookDescription.value = description ?? "";

        bookModal.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");
        bookCategory.focus();
    };

    window.closeBookModal = function () {
        bookModal.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
    };

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeBookModal();
        }
    });
});
