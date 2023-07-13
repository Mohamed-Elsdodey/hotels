<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Admin\RoomFeatures\RoomFeature;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetails;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Client;
use App\repositoryinterface\BookingInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class Bookings extends Controller
{
    //

    private $bookingRepository;

    function __construct(BookingInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            return   $this->bookingRepository->all();
        }
        return view('Admin.booking.show');

    }

    public function create(Request $request)
    {
        $categories=\App\Models\RoomsCategory::get();
        $hotels=Hotel::get();
        $clients=Client::get();
        return view('Admin.booking.index',compact('categories','hotels','clients'));
    }



    public function getRoomsInBooking(Request $request){
//        $rooms= $this->bookingRepository->getRoomsInBooking($request);

        $rooms=Room::where('hotel_id',$request->hotel_id)->where('room_category',$request->room_category)->get();
        $hotel=Hotel::find($request->hotel_id);
        return view('Admin.booking.parts.rooms',compact('rooms','hotel'));

    }
    public function getRoomPrice($id){
        $room=Room::find($id);
        return view('Admin.booking.parts.roomPrice',compact('room'));


    }

    public function store()
    {

    }

    public function store_booking(Request $request){



        $data = $request->validate([
            'hotel_id' => 'required',
            'category_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required' ,
            'rooms' => 'required' ,
            'client_id' => 'required' ,
            'num_of_adult' => 'required' ,
            'num_of_children' => 'required' ,
            'notes' => 'required' ,
            'total_before_discount'=>'required',
            'discount'=>'required',
            'total_after_discount'=>'required',
            'paid'=>'required',
            'remain'=>'required',

        ]);
        $data=($request->except('rooms','room_price'));


        $num_days=get_difference_between_two_dates($request->from_date,$request->to_date);
        $data['num_days']=$num_days ;
        $data['from_date']= strtotime($request->from_date)  ;
        $data['to_date']=strtotime($request->to_date)  ;
        $data['date']=strtotime(date('Y-m-d')) ;
        $data['month']=date('m') ;
        $data['year']=date('Y')  ;
        $data['publisher']=auth()->user()->id;
        $booking= Booking::create($data);


        if (!$booking)
        {
            App::abort(500, 'Some Error');
        }else{
            if(isset($request->rooms)&& !empty($request->rooms)) {
                $count = count($request->rooms);
                for ($i = 0; $i < $count; $i++) {
                    $rooms= $request->rooms ;
                    $explode_arr=explode(":",$rooms[$i]);
                    $room_row= $this->bookingRepository->get_by_id($explode_arr[0]);
                    $booking_details['booking_id'] =$booking->id;
                    $booking_details['category_id'] =$request->category_id;
                    $booking_details['floor'] =$room_row->floor;
                    $booking_details['default_price'] =$room_row->price;
                    $booking_details['room_id'] =$explode_arr[0];
                    $booking_details['price'] =$explode_arr[1];

                    $booking_details['date']=strtotime(date('Y-m-d')) ;
                    $booking_details['month']=date('m') ;
                    $booking_details['year']=date('Y')  ;

            }
                BookingDetails::insert($booking_details);

                $rooms=BookingDetails::where('booking_id',$booking->id)->get();
                $single=Booking::where('id',$booking->id)->first();
                //=======================upload to envocing egypt===============================//

               $document = [
                    "documents" => [
                        [
                            "issuer" => [
                                "address" => [
                                    "branchID" => "0",
                                    "country" => "EG",
                                    "governate" => "Cairo",
                                    "regionCity" => "Nasr City",
                                    "street" => "580 Clementina Key",
                                    "buildingNumber" => "Bldg. 0",
                                    "postalCode" => "68030",
                                    "floor" => "1",
                                    "room" => "123",
                                    "landmark" => "7660 Melody Trail",
                                    "additionalInformation" => "beside Townhall"
                                ],
                                "type" => "B",
                                "id" => "554681412",
                                "name" => "Issuer Company"
                            ],
                            "receiver" => [
                                "address" => [
                                    "country" => "EG",
                                    "governate" => "Egypt",
                                    "regionCity" => "Mufazat al Ismlyah",
                                    "street" => "580 Clementina Key",
                                    "buildingNumber" => "Bldg. 0",
                                    "postalCode" => "68030",
                                    "floor" => "1",
                                    "room" => "123",
                                    "landmark" => "7660 Melody Trail",
                                    "additionalInformation" => "beside Townhall"
                                ],
                                "type" => "B",
                                "id" => "313717919",
                                "name" => "Receiver"
                            ],
                            "documentType" => "I",
                            "documentTypeVersion" => "0.9",
                            "dateTimeIssued" =>date('Y-m-d')."T"."01:01:22Z",
                            "taxpayerActivityCode" => "4620",
                            "internalID" => "IID1",
                            "purchaseOrderReference" => "P-233-A6375",
                            "purchaseOrderDescription" => "purchase Order description",
                            "salesOrderReference" => "1231",
                            "salesOrderDescription" => "Sales Order description",
                            "proformaInvoiceNumber" => "SomeValue",


                            "signatures" => [
                                [
                                    "signatureType" => "I",
                                    "value" => "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"
                                ]
                            ]
                        ]
                    ]
                ];
                if(isset($rooms)&& !empty($rooms)) {
                    $count = count($rooms);
                    for ($i = 0; $i < $count; $i++) {

                        //$explode_arr=explode(":",$rooms[$i]);
                        $invoiceLines[] = array(
                            "description" => "Computer1",
                            "itemType" => "EGS",
                            "itemCode" => "EG-113317713-123456",
                            "unitType" => "EA",
                            "quantity" => 1,
                            "internalCode" => "IC0",
                            "salesTotal" => $rooms[0]->price,
                            "total" => $rooms[0]->id ,
                            "valueDifference" => 0,
                            "totalTaxableFees" => 0,
                            "netTotal" => 0,
                            "itemsDiscount" => 0,
                            "unitValue" => [
                                "currencySold" => "EGP",
                                "amountEGP" => 0
                            ],
                            "discount" => [
                                "rate" => 0,
                                "amount" => 0
                            ],
                            "taxableItems" => [
                                [
                                    "taxType" => "T1",
                                    "amount" => 0,
                                    "subType" => "V001",
                                    "rate" => 0
                                ]
                            ]
                        );
                    }
                }



                $document['documents'][0]['invoiceLines']=$invoiceLines ;
                if(isset($single->discount)&& $single->discount!=0 && $single->discount!=null)
                {
                    $discount=$single->discount;
                }else{
                    $discount= 0 ;
                }
                if(isset($single->total_after_discount)&& $single->total_after_discount!=0 && $single->total_after_discount!=null)
                {
                    $total_after_discount=$single->total_after_discount;
                }else{
                    $total_after_discount= 0 ;
                }

                $document['documents'][0]['totalDiscountAmount']=$discount ;


                $document['documents'][0]['totalSalesAmount']=$total_after_discount ;
                $document['documents'][0]['netAmount']= 0 ;
                $document['documents'][0]['taxTotals'][]=['taxType'=>'T1' , 'amount'=>0] ;
                $document['documents'][0]['totalAmount']=$i ;
                $document['documents'][0]['extraDiscountAmount']=0 ;
                $document['documents'][0]['totalItemsDiscountAmount']=$discount ;
                $fullSignedFile = json_encode($document, JSON_UNESCAPED_UNICODE);
                $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
                    'grant_type' => 'client_credentials',
                    'client_id' => '001d7f53-0810-4b9e-b6d3-3a3789c28dc6',
                    'client_secret' => '5d58f591-a6c3-4f09-88cd-40177a19f851',
                    'scope' => "InvoicingAPI",
                ]);

                $invoice = Http::withHeaders([
                    "Authorization" => 'Bearer ' . $response['access_token'],
                    "Content-Type" => "application/json",
                ])->withBody($fullSignedFile, "application/json")->post('https://api.preprod.invoicing.eta.gov.eg/api/v1/documentsubmissions');


              //  return $invoice ;


                if ($invoice['submissionId'] == !null) {
                    return response()->json(
                        [
                            'code' => 200,
                            'message' => 'success!'
                        ]);
                }else{
                    return response()->json(
                        [
                            'code' => 500,
                            'message' => 'some thing error!'
                        ]);
                }
















            }


        }



    }


    public function test_invoice()
    {

        $rooms=BookingDetails::where('booking_id',1)->get();
        $single=BookingDetails::where('id',1)->first();

        $document = [
            "documents" => [
                [
                    "issuer" => [
                        "address" => [
                            "branchID" => "0",
                            "country" => "EG",
                            "governate" => "Cairo",
                            "regionCity" => "Nasr City",
                            "street" => "580 Clementina Key",
                            "buildingNumber" => "Bldg. 0",
                            "postalCode" => "68030",
                            "floor" => "1",
                            "room" => "123",
                            "landmark" => "7660 Melody Trail",
                            "additionalInformation" => "beside Townhall"
                        ],
                        "type" => "B",
                        "id" => "554681412",
                        "name" => "Issuer Company"
                    ],
                    "receiver" => [
                        "address" => [
                            "country" => "EG",
                            "governate" => "Egypt",
                            "regionCity" => "Mufazat al Ismlyah",
                            "street" => "580 Clementina Key",
                            "buildingNumber" => "Bldg. 0",
                            "postalCode" => "68030",
                            "floor" => "1",
                            "room" => "123",
                            "landmark" => "7660 Melody Trail",
                            "additionalInformation" => "beside Townhall"
                        ],
                        "type" => "B",
                        "id" => "313717919",
                        "name" => "Receiver"
                    ],
                    "documentType" => "I",
                    "documentTypeVersion" => "0.9",
                    "dateTimeIssued" => "2023-07-12T01:01:45Z",
                    "taxpayerActivityCode" => "4620",
                    "internalID" => "IID1",
                    "purchaseOrderReference" => "P-233-A6375",
                    "purchaseOrderDescription" => "purchase Order description",
                    "salesOrderReference" => "1231",
                    "salesOrderDescription" => "Sales Order description",
                    "proformaInvoiceNumber" => "SomeValue",


                    "signatures" => [
                        [
                            "signatureType" => "I",
                            "value" => "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"
                        ]
                    ]
                ]
            ]
        ];
        if(isset($rooms)&& !empty($rooms)) {
            $count = count($rooms);
            for ($i = 0; $i < $count; $i++) {

                //$explode_arr=explode(":",$rooms[$i]);
                $invoiceLines[] = array(
                    "description" => "Computer1",
                    "itemType" => "EGS",
                    "itemCode" => "EG-113317713-123456",
                    "unitType" => "EA",
                    "quantity" => 1,
                    "internalCode" => "IC0",
                    "salesTotal" => $rooms[0]->price,
                    "total" => $rooms[0]->id ,
                    "valueDifference" => 0,
                    "totalTaxableFees" => 0,
                    "netTotal" => 0,
                    "itemsDiscount" => 0,
                    "unitValue" => [
                        "currencySold" => "EGP",
                        "amountEGP" => 0
                    ],
                    "discount" => [
                        "rate" => 0,
                        "amount" => 0
                    ],
                    "taxableItems" => [
                        [
                            "taxType" => "T1",
                            "amount" => 0,
                            "subType" => "V001",
                            "rate" => 0
                        ]
                    ]
                );
            }
        }



        $document['documents'][0]['invoiceLines']=$invoiceLines ;

      //  echo "<pre>";
        //echo json_encode($invoiceLines);
       // return;
    if(isset($single->discount)&& $single->discount!=0 && $single->discount!=null)
    {
        $discount=$single->discount;
    }else{
        $discount= 0 ;
    }
        if(isset($single->total_after_discount)&& $single->total_after_discount!=0 && $single->total_after_discount!=null)
        {
            $total_after_discount=$single->total_after_discount;
        }else{
            $total_after_discount= 0 ;
        }

        $document['documents'][0]['totalDiscountAmount']=$discount ;


        $document['documents'][0]['totalSalesAmount']=$total_after_discount ;


        echo json_encode($document);
        return;
        $document['documents'][0]['netAmount']=222 ;
        $document['documents'][0]['taxTotals'][]=['taxType'=>'T1' , 'amount'=>0] ;
        $document['documents'][0]['totalAmount']=555555555555 ;
        $document['documents'][0]['extraDiscountAmount']=0 ;
        $document['documents'][0]['totalItemsDiscountAmount']=0 ;



        $fullSignedFile = json_encode($document, JSON_UNESCAPED_UNICODE);
        $response = Http::asForm()->post('https://id.preprod.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => '001d7f53-0810-4b9e-b6d3-3a3789c28dc6',
            'client_secret' => '5d58f591-a6c3-4f09-88cd-40177a19f851',
            'scope' => "InvoicingAPI",
        ]);

        /*        //26.342998057121072, 43.96608484418012*/

        $invoice = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->withBody($fullSignedFile, "application/json")->post('https://api.preprod.invoicing.eta.gov.eg/api/v1/documentsubmissions');


        return $invoice ;

    }







}
