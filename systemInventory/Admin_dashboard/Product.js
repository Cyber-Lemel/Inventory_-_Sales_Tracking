let addProduct = document.getElementById("addProduct");
addProduct.addEventListener("click", () => {
    window.location.href = "addProduct.html";
});

let deleteProduct = document.querySelectorAll(".deleteProduct");
deleteProduct.forEach((button) => {
    button.addEventListener("click", () => {
        const productId = button.getAttribute("data-id");
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = `deleteProduct.php?id=${productId}`;
        }
    });
});

let acceptButtons = document.querySelectorAll(".acceptOrder");
acceptButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const orderId = button.getAttribute("data-id");
        if (confirm("Accept this order?")) {
            window.location.href = `acceptOrder.php?id=${orderId}`;
        }
    });
});

let rejectButtons = document.querySelectorAll(".rejectOrder");
rejectButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const orderId = button.getAttribute("data-id");
        if (confirm("Reject this order?")) {
            window.location.href = `rejectOrder.php?id=${orderId}`;
        }
    });
});