let orderProduct = document.querySelectorAll(".orderProduct");
orderProduct.forEach((button) => {
    button.addEventListener("click", () => {
        const productId = button.getAttribute("data-id");
        const qtyInput = button.previousElementSibling; // the quantity input right before this button
        const quantity = qtyInput ? parseInt(qtyInput.value, 10) : 1;

        if (!quantity || quantity < 1) {
            alert("Please enter a valid quantity.");
            return;
        }

        if (confirm(`Add ${quantity} of this product to your order?`)) {
            window.location.href = `orderProduct.php?id=${productId}&qty=${quantity}`;
        }
    });
});

let clearHistory = document.querySelector(".clearHistory");
if (clearHistory) {
    clearHistory.addEventListener("click", () => {
        if (confirm("Clear your entire order history? This can't be undone.")) {
            window.location.href = "clearOrderHistory.php";
        }
    });
}