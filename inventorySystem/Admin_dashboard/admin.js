let acceptButtons = document.querySelectorAll(".acceptProduct");
acceptButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const productId = button.getAttribute("data-id");
        if (confirm("Accept this product? It will become visible to users.")) {
            window.location.href = `productAccept.php?id=${productId}`;
        }
    });
});
