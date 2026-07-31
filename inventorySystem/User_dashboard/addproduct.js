let addProduct = document.getElementById("addProduct");

addProduct.addEventListener("click", () => {
    window.location.href = "addProduct.html";
});

let deleteProduct = document.querySelectorAll(".deleteProduct");

deleteProduct.forEach((button) => {
    button.addEventListener("click", () => {
       const productId = button.getAttribute("data-id");

       if(confirm("Are you sure you want to delete this product?")) {
        window.location.href = `deleteProduct.php?id=${productId}`;
       }
        
    });
});