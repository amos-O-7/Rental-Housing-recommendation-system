<?php

namespace App\Http\Controllers;

use App\Area;
use App\Booking;
use App\House;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $houses = House::where('status', 1)->latest()->paginate(12);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function highToLow()
    {
        $houses = House::where('status', 1)->orderBy('rent', 'DESC')->paginate(12);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function lowToHigh()
    {
        $houses = House::where('status', 1)->orderBy('rent', 'ASC')->paginate(12);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function details($id){
        $house = House::findOrFail($id);
        $area = Area::all();
//        $house_rent = House::latest()->where('rent', $house->rent )->orderBy('house_type','ASC')->paginate(12);
        $similar_house = House::where('house_type','LIKE', $house->house_type)
            ->where('parking_lot', 'LIKE', $house->parking_lot)
            ->where('house_name', '!=', $house->house_name)
            ->where('pet_policy', 'LIKE', $house->pet_policy)
            ->where('water', 'LIKE', $house->water)
            ->where('water', 'LIKE', $house->water)->orderBy('rent', 'ASC')->paginate(12);
        $similar_rent = House::where('rent', $house->rent)
            ->where('house_name', '!=', $house->house_name)
            ->where('internet_connection',$house->internet_connection )
            ->orderBy('house_name', 'ASC')->paginate(12);
        return view('houseDetails', compact('house', 'similar_rent', 'similar_house'));
    }


    public function allHouses(){
        $houses = House::latest()->where('status', 1)->orderBy('house_type', 'ASC')->paginate(12);
        return view('allHouses', compact('houses'));
    }

    public function threeBedrooms(){
        $houses = House::latest()->where('house_type', 'Three Bedroom')->orderBy('rent', 'ASC')->paginate(12);
        return view('houseTypes/threeBedrooms', compact('houses'));
    }

    public function singles(){
        $houses = House::latest()->where('house_type', 'Single Room')->orderBy('rent', 'ASC')->paginate(12);
        return view('houseTypes/singles', compact('houses'));
    }

    public function bedSitters(){
        $houses = House::latest()->where('house_type', 'Bedsitter')->orderBy('rent', 'DESC')->paginate(12);
        return view('houseTypes/bedsitters',compact('houses'));
    }

    public function oneBedrooms(){
        $houses = House::latest()->where('house_type', 'One Bedroom')->orderBy('rent', 'DESC')->paginate(12);
        return view('houseTypes/oneBedrooms',compact('houses'));
    }

    public function twoBedrooms(){
        $houses = House::latest()->where('house_type', 'Two Bedroom')->orderBy('rent', 'ASC')->paginate(12);
        return view('houseTypes/twoBedrooms',compact('houses'));
    }

    public function areaWiseShow($id){
        $area = Area::findOrFail($id);
        $houses = House::where('area_id', $id)->get();
        return view('areaWiseShow', compact('houses', 'area'));
    }

    public function similar($id){
        $house = House::findOrFail($id);
        $houses = House::latest()->where('status', 1);
        $similarHouse = $house->house_type->get();
        $similarHouses = $houses->house_type->get();
        $showHouse = House::where('similarHouse', 'similarHouses')->paginate(12);
        return view('houseDetails', compact('showHouse'));
    }




    public function search(Request $request){

//        $area = $request->area;
        $pet_policy = $request->pet_policy;
        $house_type = $request->house_type;
        $parking_lot = $request->parking_lot;
//        $internet_connection = $request->internet_connection;
        $water = $request->water;
        $rent = $request->rent;


        if($parking_lot == null && $rent == null){
            session()->flash('search', 'Your have to fill up');
            return redirect()->back();
        }

        $houses = House::where('rent', 'LIKE', $rent)
//            ->where('area', 'LIKE', $area)
            ->where('pet_policy', 'LIKE', $pet_policy)
            ->where('house_type', 'LIKE', $house_type)
            ->where('parking_lot', 'LIKE', $parking_lot)
//            ->where('internet_connection', 'LIKE', $internet_connection)
            ->where('water', 'LIKE', $water)
//            ->where('address', 'LIKE', "%$address%")
            ->get();
        return view('search', compact('houses'));
    }



    public function searchByRange(Request $request){
        $digit1 =  $request->digit1;
        $digit2 =  $request->digit2;
        if($digit1 > $digit2){
            $temp = $digit1;
            $digit1 =  $digit2;
            $digit2 = $temp;
        }
        $houses = House::whereBetween('rent', [$digit1, $digit2])
                        ->orderBy('rent', 'ASC')->get();
        return view('searchByRange', compact('houses'));
    }


    public function booking($house){

        // if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
        //     session()->flash('danger', 'Sorry admin and landlord are not able to book any houses. Please login with renter account');
        //     return redirect()->back();
        // }


        $house = House::findOrFail($house);
        $landlord = User::where('id', $house->user_id)->first();

        if(Booking::where('address', $house->address)->where('booking_status', "booked")->count() > 0){
            session()->flash('danger', 'This house has already been booked!');
            return redirect()->back();
        }



        if(Booking::where('address', $house->address)->where('renter_id', Auth::id())->where('booking_status', "requested")->count() > 0){
            session()->flash('danger', 'Your have already sent booking request of this home');
            return redirect()->back();
        }





        //find current date month year
        // $now = Carbon::now();
        // $now = $now->format('F d, Y');


        $booking = new Booking();
        $booking->address = $house->address;
        $booking->rent = $house->rent;
        $booking->landlord_id = $landlord->id;
        $booking->renter_id = Auth::id();
        $booking->save();


        session()->flash('success', 'House Booking Request Send Successfully');
        return redirect()->back();


    }

        public function similarHouse(){
        $houses        = House::where('status', 1);
        $selectedId      = intval(app('request')->input('id') ?? '8');
        $selectedHouse = $houses[0];

        $selectedHouses = array_filter($houses, function ($house) use ($selectedId) { return $house->id === $selectedId; });
        if (count($selectedHouses)) {
            $selectedHouse = $selectedHouses[array_keys($selectedHouses)[0]];
        }

        $houseSimilarity = new App\ProductSimilarity($houses);
        $similarityMatrix  = $houseSimilarity->calculateSimilarityMatrix();
        $houses          = $houseSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);

        compact('selectedId','selectedHouse', 'houses');
    }

    public function houseType($house_type){
        $house_type = house_type::findOrFail($house_type);
        $houses = House::where('house_type', $house_type)->get();
        return view('house_type', compact('houses','house_type'));
    }

}
