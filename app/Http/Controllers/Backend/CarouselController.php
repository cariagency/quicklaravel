<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Carousel;
use App\Http\Requests\CarouselForm;

class CarouselController extends Controller {

    public function index() {
        return view('backend.carousels.index', [
            'carousels' => Carousel::ordered()->get()
        ]);
    }

    public function create() {
        return view('backend.carousels.form', [
            'carousel' => new Carousel()
        ]);
    }

    public function store(CarouselForm $request) {
        $carousel = new Carousel();
        $carousel->fill($request->all());
        $carousel->save();
        return redirect()->route('carousels.index');
    }

    public function edit(Carousel $carousel) {
        return view('backend.carousels.form', [
            'carousel' => $carousel
        ]);
    }

    public function update(CarouselForm $request, Carousel $carousel) {
        $carousel->fill($request->all());
        $carousel->save();
        return redirect()->route('carousels.index');
    }

    public function destroy(Carousel $carousel) {
        $carousel->delete();

        Carousel::ordered()->get()->each(function(Carousel $c, $key) {
            $c->update(['order' => $key + 1]);
        });

        return redirect()->route('carousels.index');
    }

    public function sort(Carousel $carousel, $sort) {
        if ($sort === 'up') {
            $carousel->moveOrderUp();
        } else {
            $carousel->moveOrderDown();
        }
        return redirect()->route('carousels.index');
    }

}
