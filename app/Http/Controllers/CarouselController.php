<?php

namespace App\Http\Controllers;

use App\Carousel;
use Illuminate\Http\Request;
use App\Http\Requests\CarouselForm;
use File;

class CarouselController extends Controller {

    public function index() {
        return view('carousels.index', [
            'carousels' => Carousel::ordered()->get()
        ]);
    }

    public function create() {
        return view('carousels.form', [
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
        return view('carousels.form', [
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
