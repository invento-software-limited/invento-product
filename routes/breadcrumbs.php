<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('blogs.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(__('blog::blogs.Blogs'), route('admin.blogs.index'));
});


Breadcrumbs::for('blogs.create', function (BreadcrumbTrail $trail) {
    $trail->parent('breadcrumbs.blogs.index');
    $trail->push(__('blog::blogs.add_blog'), route('admin.blogs.create'));
});
