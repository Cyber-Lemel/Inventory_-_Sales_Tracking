let orderProduct = document.querySelectorAll(".orderProduct");
orderProduct.forEach((button) => {
    button.addEventListener("click", () => {
        const productId = button.getAttribute("data-id");
        if (confirm("Add this product to your order?")) {
            window.location.href = `orderProduct.php?id=${productId}`;
        }
    });
});