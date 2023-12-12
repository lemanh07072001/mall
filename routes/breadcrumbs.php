<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('dashboard.index'));
});

// Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('category.index'));
});

Breadcrumbs::for('createCategory', function (BreadcrumbTrail $trail) {
    $trail->parent('category');
    $trail->push('Thêm danh mục', route('category.create'));
});

Breadcrumbs::for('editCategory', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('category');
    $trail->push('Sửa danh mục: '.$category->name, route('category.edit',$category));
});

Breadcrumbs::for('trashCategory', function (BreadcrumbTrail $trail) {
    $trail->parent('category');
    $trail->push('Thùng rác ', route('category.trash'));
});

//Slide
Breadcrumbs::for('slide', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('slide.index'));
});

Breadcrumbs::for('createSlide', function (BreadcrumbTrail $trail) {
    $trail->parent('slide');
    $trail->push('Thêm slide', route('slide.create'));
});

Breadcrumbs::for('editSlide', function (BreadcrumbTrail $trail,$silde) {
    $trail->parent('slide');
    $trail->push('Sửa : '.$silde->name, route('slide.edit',$silde));
});