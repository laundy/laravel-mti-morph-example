<?php

namespace App\Http\Controllers;

use App\Element;
use App\TextElement;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        //echo json_encode(Element::find(2)->elementable);
        return response()->json(Element::whereHasMorph('elementable', '*')->with('elementable')->get());
    }

    public function test(Request $request)
    {
        $node = Element::find(4);
        $node2 = TextElement::create([
            'x' => 2.39,
            'y' => 9.39,
            'font' => 'Open Sans Bold',
            'color' => '#12eh37',
            'size' => 12.0
        ]);
        $node2->appendToNode($node)->save();
        print_r($node->ancestors);
        return response()->json();
    }
}
