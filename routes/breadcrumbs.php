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
