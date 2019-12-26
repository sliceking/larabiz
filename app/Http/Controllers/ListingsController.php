<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class ListingsController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth', ['except' => ['index', 'show']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $listings = Listing::orderBy('created_at', 'desc')->get();
    return view('index')->with('listings', $listings);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'address' => 'required',
      'website' => 'required',
      'email' => 'required|email',
      'phone' => 'required|integer',
      'bio' => 'required',
    ]);

    $listing = new Listing;
    $listing->user_id = Auth::id();
    $listing->name = $request->input('name');
    $listing->address = $request->input('address');
    $listing->website = $request->input('website');
    $listing->email = $request->input('email');
    $listing->phone = $request->input('phone');
    $listing->bio = $request->input('bio');
    $listing->save();

    return redirect()->to('/home')->with('success', 'Listing created Successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $listing = Listing::find($id);
    return view('show', ['listing' => $listing]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $listing = Listing::find($id);
    return view('edit', ['listing' => $listing]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $listing = Listing::find($id);
    $listing->name = $request->input('name');
    $listing->address = $request->input('address');
    $listing->website = $request->input('website');
    $listing->email = $request->input('email');
    $listing->phone = $request->input('phone');
    $listing->bio = $request->input('bio');
    $listing->save();

    return redirect()->to('/home')->with('success', 'Listing Edited Successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $listing = Listing::find($id);
    $listing->delete();
    return redirect()->to('/home')->with('success', 'Listing Deleted Successfully.');
  }
}
