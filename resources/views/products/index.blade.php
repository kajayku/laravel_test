@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <button id="createProductBtn">Create Product</button>
    <ul id="productsList"></ul>
    <div id="productForm" style="display:none;">
        <input type="text" id="productTitle" placeholder="Product Title">
        <textarea id="productDescription" placeholder="Product Description"></textarea>
        <input type="number" id="productPrice" placeholder="Product Price" step="0.01">
        <select id="productCategories" multiple></select>
        <button id="saveProductBtn">Save</button>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            fetchProducts();
            fetchCategories();

            $('#createProductBtn').click(function() {
                $('#productForm').toggle();
            });

            $('#saveProductBtn').click(function() {
                var title = $('#productTitle').val();
                var description = $('#productDescription').val();
                var price = $('#productPrice').val();
                var categories = $('#productCategories').val();
                $.ajax({
                    url: '/api/products',
                    type: 'POST',
                    data: {
                        title: title,
                        description: description,
                        price: price,
                        categories: categories,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        fetchProducts();
                        $('#productTitle').val('');
                        $('#productDescription').val('');
                        $('#productPrice').val('');
                        $('#productCategories').val([]);
                        $('#productForm').hide();
                    }
                });
            });

            function fetchProducts() {
                $.ajax({
                    url: '/api/products',
                    type: 'GET',
                    success: function(response) {
                        $('#productsList').empty();
                        response.data.forEach(function(product) {
                            $('#productsList').append('<li>' + product.title + ' - $' + product.price + 
                            ' <button class="editProductBtn" data-id="' + product.id + '">Edit</button>' +
                            ' <button class="deleteProductBtn" data-id="' + product.id + '">Delete</button></li>');
                        });
                    }
                });
            }

            function fetchCategories() {
                $.ajax({
                    url: '/api/categories',
                    type: 'GET',
                    success: function(response) {
                        $('#productCategories').empty();
                        response.forEach(function(category) {
                            $('#productCategories').append('<option value="' + category.id + '">' + category.name + '</option>');
                        });
                    }
                });
            }

            $(document).on('click', '.deleteProductBtn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/api/products/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        fetchProducts();
                    }
                });
            });

            $(document).on('click', '.editProductBtn', function() {
                var id = $(this).data('id');
                var title = prompt("Enter new title");
                var description = prompt("Enter new description");
                var price = prompt("Enter new price");
                var categories = prompt("Enter new categories (comma separated)");

                if (title && description && price && categories) {
                    $.ajax({
                        url: '/api/products/' + id,
                        type: 'PUT',
                        data: {
                            title: title,
                            description: description,
                            price: price,
                            categories: categories.split(','),
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            fetchProducts();
                        }
                    });
                }
            });
        });
    </script>
@endsection
