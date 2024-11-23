$(document).ready(function() {
    function loadProducts() {
        $.ajax({
            url: 'http://localhost:8000/api/product.php',
            type: 'GET',
            success: function(data) {
                let rows = '';
                data.forEach(product => {
                    rows += `
                        <tr>
                            <td>${product.id}</td>
                            <td>${product.name}</td>
                            <td>${product.category}</td>
                            <td>
                                <button onclick="editProduct(${product.id}, '${product.name}', ${product.category_id})">Edit</button>
                                <button onclick="deleteProduct(${product.id})">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#productTable tbody').html(rows);
            }
        });
    }

    loadProducts();

    window.deleteProduct = function(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: 'http://localhost:8000/api/product.php',
                type: 'DELETE',
                data: JSON.stringify({ id: id }),
                success: function(response) {
                    alert(response.message);
                    loadProducts();
                }
            });
        }
    }

    window.editProduct = function(id, name, categoryId) {
        // Redirect to edit form with query parameters
        window.location.href = `add_product.html?id=${id}&name=${name}&category_id=${categoryId}`;
    }
});
