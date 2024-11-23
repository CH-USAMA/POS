$(document).ready(function() {
    // Load categories
    $.ajax({
        url: 'http://localhost:8000/api/category.php',
        type: 'GET',
        success: function(categories) {
            categories.forEach(category => {
                $('#productCategory').append(`<option value="${category.id}">${category.name}</option>`);
            });

            // If editing, fill form with existing data
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('id')) {
                $('#formTitle').text('Edit Product');
                $('#productId').val(urlParams.get('id'));
                $('#productName').val(urlParams.get('name'));
                $('#productCategory').val(urlParams.get('category_id'));
            }
        }
    });

    // Handle form submission
    $('#productForm').submit(function(event) {
        event.preventDefault();

        const productData = {
            name: $('#productName').val(),
            category_id: $('#productCategory').val()
        };

        const isEditing = $('#productId').val() !== '';
        if (isEditing) {
            productData.id = $('#productId').val();
            $.ajax({
                url: 'http://localhost:8000/api/product.php',
                type: 'PUT',
                data: JSON.stringify(productData),
                success: function(response) {
                    alert(response.message);
                    window.location.href = 'dashboard.html';
                }
            });
        } else {
            $.ajax({
                url: 'http://localhost:8000/api/product.php',
                type: 'POST',
                data: JSON.stringify(productData),
                success: function(response) {
                    alert(response.message);
                    window.location.href = 'dashboard.html';
                }
            });
        }
    });
});
