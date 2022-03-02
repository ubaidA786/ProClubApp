<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MediaController extends Controller
{
    public function index()
    {
        $paginate = Request::only('paginate')
            ? Request::only('paginate')['paginate']
            : null;
        return Inertia::render('Media/Index', [
            'filters' => Request::all('search', 'sort_by', 'sort_direction'),
            'mediaList' => Media::filter(
                Request::only('search', 'sort_by', 'sort_direction')
            )
                ->paginate(100)
                ->withQueryString()
                ->through(
                    fn($media) => [
                        'id' => $media->id,
                        'title' => $media->title,
                        'url' => $media->url,
                        'status' => $media->status,
                    ]
                ),
        ]);
    }

    public function create()
    {
        return Inertia::render('Media/Create', [
            'statusList' => [
                ['id' => 1, 'name' => 'Active'],
                ['id' => 0, 'name' => 'Inactive'],
            ],
        ]);
    }

    public function store()
    {
        $form = Request::validate([
            'title' => ['required', 'max:100'],
            'url' => ['max:255'],
            'description' => ['max:255'],
        ]);

        Media::create($form);

        return Redirect::route('media')->with('success', 'Media created.');
    }

    public function edit(Media $media)
    {
        return Inertia::render('Media/Edit', [
            'mediaobj' => [
                'id' => $media->id,
                'title' => $media->title,
                'url' => $media->url,
                'description' => $media->description,
                'status' => $media->status,
            ],
            'statusList' => [
                ['id' => 1, 'name' => 'Active'],
                ['id' => 0, 'name' => 'Inactive'],
            ],
        ]);
    }

    public function update(Media $media)
    {
        $media->update(
            Request::validate([
                'title' => ['required', 'max:100'],
                'url' => ['max:255'],
                'description' => ['max:255'],
                'status' => ['required', 'numeric'],
            ])
        );

        return Redirect::route('media')->with('success', 'Media updated.');
    }

    public function destroy(Media $media)
    {
        $media->delete();

        return Redirect::route('media')->with('success', 'Media deleted.');
    }

    public function restore(Media $media)
    {
        $media->restore();

        return Redirect::route('media')->with('success', 'Media restored.');
    }
}
