<?php

namespace App\Http\Controllers;

use App\Cat;
use Illuminate\Http\Request;

class SearchByLocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search_by_location');
    }

    /*
	 *	The MIT License (MIT)
	 *
	 *	Copyright (c) 2015 Ben Poulson <ben@terravita.co.uk>
	 *
	 *	Permission is hereby granted, free of charge, to any person obtaining a copy
	 *	of this software and associated documentation files (the "Software"), to deal
	 *	in the Software without restriction, including without limitation the rights
	 *	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 *	copies of the Software, and to permit persons to whom the Software is
	 *	furnished to do so, subject to the following conditions:
	 *
	 *	The above copyright notice and this permission notice shall be included in all
	 *	copies or substantial portions of the Software.
	 *
	 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 *	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 *	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 *	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 *	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 *	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	 *	SOFTWARE.
	 *
	 */

    private function convexHull($points)
    {
        /* Ensure point doesn't rotate the incorrect direction as we process the hull halves */
        $cross = function($o, $a, $b) {
            return ($a[0] - $o[0]) * ($b[1] - $o[1]) - ($a[1] - $o[1]) * ($b[0] - $o[0]);
        };

        $pointCount = count($points);
        sort($points);
        if ($pointCount > 1) {

            $n = $pointCount;
            $k = 0;
            $h = array();

            /* Build lower portion of hull */
            for ($i = 0; $i < $n; ++$i) {
                while ($k >= 2 && $cross($h[$k - 2], $h[$k - 1], $points[$i]) <= 0)
                    $k--;
                $h[$k++] = $points[$i];
            }

            /* Build upper portion of hull */
            for ($i = $n - 2, $t = $k + 1; $i >= 0; $i--) {
                while ($k >= $t && $cross($h[$k - 2], $h[$k - 1], $points[$i]) <= 0)
                    $k--;
                $h[$k++] = $points[$i];
            }

            /* Remove all vertices after k as they are inside of the hull */
            if ($k > 1) {

                /* If you don't require a self closing polygon, change $k below to $k-1 */
                $h = array_splice($h, 0, $k);
            }

            return $h;

        }
        else if ($pointCount <= 1)
        {
            return $points;
        }
        else
        {
            return null;
        }
    }

    public function calc() {
        $x = doubleval($_POST['x_cord']);
        $y = doubleval($_POST['y_cord']);

        $result = array();
        foreach (Cat::all() as $cat) {
            $input_array = array();
            foreach ($cat->spots()->get() as $spot) {
                array_push($input_array, array($spot->x, $spot->y));
            }
            array_push($input_array, array($x, $y));

            $found_spots = $this->convexHull($input_array);

            $epsilon = 0.000001;
            $flag = true;
            foreach ($found_spots as $spot) {
                if (abs($spot[0] - $x) < $epsilon and abs($spot[1] - $y) < $epsilon) {
                    $flag = false;
                    break;
                }
            }
            // flag가 false일 때 convex hull 알고리즘의 결과에 포함되었다는 뜻이므로 기존의 범위 내에 포함되지 않는다는 뜻임

            if ($flag) {
                array_push($result, array($cat->id, $cat->name));
            }
        }

        return json_encode(array('result' => $result));
    }
}
