<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Carousel extends Model implements Sortable {

    use SortableTrait;

    protected $table = 'carousels';
    protected $fillable = ['title', 'description', 'image_front', 'image_mobile', 'image_desktop', 'order'];
    public $timestamps = false;
    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

}
