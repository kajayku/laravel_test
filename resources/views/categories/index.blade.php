@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    <button id="createCategoryBtn">Create Category</button>
    <ul id="categoriesList"></ul>
    <div id="paginationLinks"></div>
    <div id="categoryForm" style="display:none;">
        <input type="text" id="categoryName" placeholder="Category Name">
        <button id="saveCategoryBtn">Save</button>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            fetchCategories();

            $('#createCategoryBtn').click(function() {
                $('#categoryForm').toggle();
            });

            $('#saveCategoryBtn').click(function() {
                var name = $('#categoryName').val();
                $.ajax({
                    url: '/api/categories',
                    type: 'POST',
                    data: {
                        name: name,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        fetchCategories();
                        $('#categoryName').val('');
                        $('#categoryForm').hide();
                    }
                });
            });

            function fetchCategories(page = 1) {
                $.ajax({
                    url: `/api/categories?page=${page}`,
                    type: 'GET',
                    success: function(response) {
                        $('#categoriesList').empty();
                        response.data.forEach(function(category) {
                            $('#categoriesList').append('<li>' + category.name + 
                            ' <button class="editCategoryBtn" data-id="' + category.id + '">Edit</button>' +
                            ' <button class="deleteCategoryBtn" data-id="' + category.id + '">Delete</button></li>');
                        });

                        $('#paginationLinks').html(response.links);
                    }
                });
            }

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetchCategories(page);
            });

            $(document).on('click', '.deleteCategoryBtn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/api/categories/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        fetchCategories();
                    }
                });
            });

            $(document).on('click', '.editCategoryBtn', function() {
                var id = $(this).data('id');
                var name = prompt("Enter new name");
                if (name) {
                    $.ajax({
                        url: '/api/categories/' + id,
                        type: 'PUT',
                        data: {
                            name: name,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            fetchCategories();
                        }
                    });
                }
            });
        });
    </script>
@endsection
