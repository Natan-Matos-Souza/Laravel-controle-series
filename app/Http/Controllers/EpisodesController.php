<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Episode;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', ['episodes' => $season->episodes]);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push();
    }
}