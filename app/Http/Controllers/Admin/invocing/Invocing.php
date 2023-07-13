<?php
namespace App\Http\Controllers\Admin\invocing;
use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;

use App\repositoryinterface\RoomInterface;
class Invocing extends Controller
{
    public function __construct()
    {
      //  parent::__construct();

    }


    public function no_signature()
    {
        $i='I';
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

      for($i=0 ;$i<1 ;$i++) {
      $invoiceLines[] = array(
        "description" => "Computer1",
        "itemType" => "EGS",
        "itemCode" => "EG-113317713-123456",
        "unitType" => "EA",
        "quantity" => 32,
        "internalCode" => "IC0",
        "salesTotal" => 2222,
        "total" => 111111111111,
        "valueDifference" => 0,
        "totalTaxableFees" => 0,
        "netTotal" => 111111111111,
        "itemsDiscount" => 0,
        "unitValue" => [
            "currencySold" => "EGP",
            "amountEGP" => 111111111111
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
        //echo "<pre>";
 //print_r($invoice['documents'][0]['invoiceLines']);

 //echo json_encode($invoice['documents'][0]['invoiceLines']);



        $document['documents'][0]['invoiceLines']=$invoiceLines ;


        $document['documents'][0]['totalDiscountAmount']=33 ;


        $document['documents'][0]['totalSalesAmount']=333 ;



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


    public function invoice() //Invocing/invoice
    {


        $invoice =
            [
                "issuer" => array(
                    "address" => array(
                        "branchID" => "155",
                        "country" => "EG",
                        "governate" => '',
                        "regionCity" => '',
                        "street" => '',
                        "buildingNumber" => '',
                    ),
                    "type" => 'B',
                    "id" => 554681412,
                    "name" => 'عمرو السيد كامل حسني اول سيزون تريد',
                ),

                "receiver" => array(
                    "address" => array(),
                    "type" => 'P',

                ),
                "documentType" => 'I',
                "documentTypeVersion" => "0.9",
                "dateTimeIssued" => '11-07-2023' . "T" . date("h:i:s") . "Z",
                "taxpayerActivityCode" => 1234,
                "internalID" => 2,
                "invoiceLines" => [

                ],
                "totalDiscountAmount" => floatval(10),
                "totalSalesAmount" => floatval(2),
                "netAmount" => floatval(2),
                "taxTotals" => array(
                    array(
                        "taxType" => "T4",
                        "amount" => floatval(0),
                    ),
                    array(
                        "taxType" => "T1",
                        "amount" => floatval(0),
                    ),
                ),
                "totalAmount" => floatval(100),
                "extraDiscountAmount" => floatval(0),
                "totalItemsDiscountAmount" => floatval(0),
            ];

        for ($i = 0; $i < 1; $i++) {
            $Data = [

                "description" => 'Business Management & Consulting Services',
                "itemType" => "EGS",
                "itemCode" => 'EG-542747146-1',
                // "itemCode" => "10003834",
                "unitType" => "EA",
                "quantity" => floatval(1),
                "internalCode" => "100",
                "salesTotal" => floatval(1),
                "total" => floatval(1),
                "valueDifference" => 0.00,
                "totalTaxableFees" => 0.00,
                "netTotal" => floatval(1),
                "itemsDiscount" => floatval(0),

                "unitValue" => [
                    "currencySold" => "EGP",
                    "amountSold" => 0.00,
                    "currencyExchangeRate" => 0.00,
                    "amountEGP" => floatval(1),
                ],
                "discount" => [
                    "rate" => 0.00,
                    "amount" => floatval(0),
                ],
                "taxableItems" => [
                    [

                        "taxType" => "T4",
                        "amount" => floatval(0),
                        "subType" => (0),
                        "rate" => floatval(0),
                    ],
                    [
                        "taxType" => "T1",
                        "amount" => floatval(0),
                        "subType" => (0),
                        "rate" => floatval(0),
                    ],
                ],

            ];
        }
            $invoice['invoiceLines'][$i] = $Data;


        /*// this is for receiver address
       // ($request->receiverName ? $invoice['receiver']['name'] = $request->receiverName : "");
      //  ($request->receiverCountry ? $invoice['receiver']["address"]['country'] = $request->receiverCountry : "");
      //  ($request->receiverBuildingNumber ? $invoice['receiver']["address"]['buildingNumber'] = $request->receiverBuildingNumber : "");
      //  ($request->street ? $invoice['receiver']["address"]['street'] = $request->street : "");
       // ($request->receiverRegionCity ? $invoice['receiver']["address"]['regionCity'] = $request->receiverRegionCity : "");
       // ($request->receiverGovernate ? $invoice['receiver']["address"]['governate'] = $request->receiverGovernate : "");
       // ($request->receiverPostalCode ? $invoice['receiver']["address"]['postalcode'] = $request->receiverPostalCode : "");
       // ($request->receiverFloor ? $invoice['receiver']["address"]['floor'] = $request->receiverFloor : "");
      //  ($request->receiverRoom ? $invoice['receiver']["address"]['room'] = $request->receiverRoom : "");
       // ($request->receiverLandmark ? $invoice['receiver']["address"]['landmark'] = $request->receiverLandmark : "");
      //  ($request->receiverAdditionalInformation ? $invoice['receiver']["address"]['additionalInformation'] = $request->receiverAdditionalInformation : "");
       // ($request->receiverId ? $invoice['receiver']['id'] = $request->receiverId : "");

        // this is for reference debit or credit note
      //  ($request->referencesInvoice ? $invoice['references'] = [$request->referencesInvoice] : "");
        // End reference debit or credit note

        // this is for Bank payment

      //  ($request->bankName ? $invoice['payment']["bankName"] = $request->bankName : "");
       // ($request->bankAddress ? $invoice['payment']["bankAddress"] = $request->bankAddress : "");
        //($request->bankAccountNo ? $invoice['payment']["bankAccountNo"] = $request->bankAccountNo : "");
        //($request->bankAccountIBAN ? $invoice['payment']["bankAccountIBAN"] = $request->bankAccountIBAN : "");
       // ($request->swiftCode ? $invoice['payment']["swiftCode"] = $request->swiftCode : "");
       // ($request->Bankterms ? $invoice['payment']["terms"] = $request->Bankterms : "");
        // End Bank payment*/

        $trnsformed = json_encode($invoice, JSON_UNESCAPED_UNICODE);


       // $myFileToJson = fopen($_SERVER['DOCUMENT_ROOT'] . "/envocing/SourceDocumentJson.json", "w") or die("unable to open file");

         $myFileToJson = fopen('E:\xampp\htdocs\zidan\hotels\envocing\SourceDocumentJson.json', 'w') or die("unable to open file");
        fwrite($myFileToJson, $trnsformed);

        echo "<pre>";

        print_r($invoice);

        /*  //echo 10 ;
         // return;

         // $treasury = TreasuryAccount::where('id', $request->treasury_id)->update([
            //  'type' => 1,
         // ]);
       //   return redirect()->route('cer');*/

    }

    /*// this function for signature*/

    public function openBat()
    {


      shell_exec("E:/xampp/htdocs/zidan/hotels/envocing/SubmitInvoices2.bat");

        $path = "E:/xampp/htdocs/zidan/hotels/envocing/FullSignedDocument.json";
        $path2 = "E:/xampp/htdocs/zidan/hotels/envocing/Cades.txt";
        $path3 = "E:/xampp/htdocs/zidan/hotels/envocing/CanonicalString.txt";
        $path4 = "E:/xampp/htdocs/zidan/hotels/envocing/SourceDocumentJson.json";

       $fullSignedFile = file_get_contents($path);




//        $curl = curl_init();
//
//        curl_setopt($curl, CURLOPT_URL, 'https://id.preprod.eta.gov.eg/connect/token');
//
//        curl_setopt($curl, CURLOPT_POST, true);
//
//        $data = array('grant_type' => 'client_credentials', 'client_id' => '001d7f53-0810-4b9e-b6d3-3a3789c28dc6','client_secret' => '5d58f591-a6c3-4f09-88cd-40177a19f851','scope' => 'InvoicingAPI' );
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//
//        $headers = array(
//          //  'Authorization: Bearer ' . $access_token,
//          //  'Content-Type: application/x-www-form-urlencoded',
//        );
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//
//        $response = curl_exec($curl);
//
//      //  curl_close($curl);




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


  return $invoice['submissionId'] ;


        if ($invoice['submissionId'] == !null) {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            return redirect()->route('sentInvoices', '1')->with('success', 'تم تسجيل الفاتورة بنجاح ');
            /*// return $invoice->body();*/

        } else {
            unlink($path);
            unlink($path2);
            unlink($path3);
            unlink($path4);
            /*  // return $invoice->body();*/
            return redirect()->route('sentInvoices', '1')->with('error', "يوجد خطأ فى الفاتورة من فضلك اعد تسجيلها");
        }
    }

    public function invoice3()
    {
        $fullSignedFile='{
        "documents": [
        {
            "issuer": {
            "address": {
                "branchID": "0",
                    "country": "EG",
                    "governate": "Cairo",
                    "regionCity": "Nasr City",
                    "street": "580 Clementina Key",
                    "buildingNumber": "Bldg. 0",
                    "postalCode": "68030",
                    "floor": "1",
                    "room": "123",
                    "landmark": "7660 Melody Trail",
                    "additionalInformation": "beside Townhall"
                },
                "type": "B",
                "id": "554681412",
                "name": "Issuer Company"
            },
            "receiver": {
            "address": {
                "country": "EG",
                    "governate": "Egypt",
                    "regionCity": "Mufazat al Ismlyah",
                    "street": "580 Clementina Key",
                    "buildingNumber": "Bldg. 0",
                    "postalCode": "68030",
                    "floor": "1",
                    "room": "123",
                    "landmark": "7660 Melody Trail",
                    "additionalInformation": "beside Townhall"
                },
                "type": "B",
                "id": "313717919",
                "name": "Receiver"
            },
            "documentType": "I",
            "documentTypeVersion": "0.9",
            "dateTimeIssued": "2023-07-11T02:01:45Z",
            "taxpayerActivityCode": "4620",
            "internalID": "IID1",
            "purchaseOrderReference": "P-233-A6375",
            "purchaseOrderDescription": "purchase Order description",
            "salesOrderReference": "1231",
            "salesOrderDescription": "Sales Order description",
            "proformaInvoiceNumber": "SomeValue",
            "payment": {
            "bankName": "SomeValue1",
                "bankAddress": "SomeValue",
                "bankAccountNo": "SomeValue",
                "bankAccountIBAN": "",
                "swiftCode": "",
                "terms": "SomeValue"
            },
            "delivery": {
            "approach": "SomeValue",
                "packaging": "SomeValue",
                "dateValidity": "2020-09-28T09:30:10Z",
                "exportPort": "SomeValue",
                "grossWeight": 10.50,
                "netWeight": 20.50,
                "terms": "SomeValue"
            },
            "invoiceLines": [
                {
                    "description": "Computer1",
                    "itemType": "EGS",
                    "itemCode": "EG-113317713-123456",
                    "unitType": "EA",
                    "quantity": 11,
                    "internalCode": "IC0",
                    "salesTotal": 111111111111.00,
                    "total": 111111111111.00,
                    "valueDifference": 0.00,
                    "totalTaxableFees": 0,
                    "netTotal": 111111111111,
                    "itemsDiscount": 0,
                    "unitValue": {
                    "currencySold": "EGP",
                        "amountEGP": 111111111111.00
                    },
                    "discount": {
                    "rate": 0,
                        "amount": 0
                    },
                    "taxableItems": [
                        {
                            "taxType": "T1",
                            "amount": 0,
                            "subType": "V001",
                            "rate": 0
                        }
                    ]
                },
                {
                    "description": "Computer1",
                    "itemType": "EGS",
                    "itemCode": "EG-113317713-123456",
                    "unitType": "EA",
                    "quantity": 1,
                    "internalCode": "IC0",
                    "salesTotal": 111111111111.00,
                    "total": 111111111111.00,
                    "valueDifference": 0.00,
                    "totalTaxableFees": 0,
                    "netTotal": 111111111111,
                    "itemsDiscount": 0,
                    "unitValue": {
                    "currencySold": "EGP",
                        "amountEGP": 111111111111.00
                    },
                    "discount": {
                    "rate": 0,
                        "amount": 0
                    },
                    "taxableItems": [
                        {
                            "taxType": "T1",
                            "amount": 0,
                            "subType": "V001",
                            "rate": 0
                        }
                    ]
                },
                {
                    "description": "Computer1",
                    "itemType": "EGS",
                    "itemCode": "EG-113317713-123456",
                    "unitType": "EA",
                    "quantity": 1,
                    "internalCode": "IC0",
                    "salesTotal": 111111111111.00,
                    "total": 111111111111.00,
                    "valueDifference": 0.00,
                    "totalTaxableFees": 0,
                    "netTotal": 111111111111,
                    "itemsDiscount": 0,
                    "unitValue": {
                    "currencySold": "EGP",
                        "amountEGP": 111111111111.00
                    },
                    "discount": {
                    "rate": 0,
                        "amount": 0
                    },
                    "taxableItems": [
                        {
                            "taxType": "T1",
                            "amount": 0,
                            "subType": "V001",
                            "rate": 0
                        }
                    ]
                },
                {
                    "description": "Computer1",
                    "itemType": "EGS",
                    "itemCode": "EG-113317713-123456",
                    "unitType": "EA",
                    "quantity": 1,
                    "internalCode": "IC0",
                    "salesTotal": 33333.00,
                    "total": 333333.00,
                    "valueDifference": 0.00,
                    "totalTaxableFees": 0,
                    "netTotal": 111111111111,
                    "itemsDiscount": 0,
                    "unitValue": {
                    "currencySold": "EGP",
                        "amountEGP": 111111111111.00
                    },
                    "discount": {
                    "rate": 0,
                        "amount": 0
                    },
                    "taxableItems": [
                        {
                            "taxType": "T1",
                            "amount": 0,
                            "subType": "V001",
                            "rate": 0
                        }
                    ]
                },
                {
                    "description": "Computer1",
                    "itemType": "EGS",
                    "itemCode": "EG-113317713-123456",
                    "unitType": "EA",
                    "quantity": 1,
                    "internalCode": "IC0",
                    "salesTotal": 111111111111.00,
                    "total": 111111111111.00,
                    "valueDifference": 0.00,
                    "totalTaxableFees": 0,
                    "netTotal": 111111111111,
                    "itemsDiscount": 0,
                    "unitValue": {
                    "currencySold": "EGP",
                        "amountEGP": 111111111111.00
                    },
                    "discount": {
                    "rate": 0,
                        "amount": 0
                    },
                    "taxableItems": [
                        {
                            "taxType": "T1",
                            "amount": 0,
                            "subType": "V001",
                            "rate": 0
                        }
                    ]
                }
            ],
            "totalDiscountAmount": 0,
            "totalSalesAmount": 555555555555.00,
            "netAmount": 555555555555.00,
            "taxTotals": [
                {
                    "taxType": "T1",
                    "amount": 0
                }
            ],
            "totalAmount": 555555555555.00,
            "extraDiscountAmount": 0,
            "totalItemsDiscountAmount": 0,
            "signatures": [
                {
                    "signatureType": "I",
                    "value":"eyJhbGciOiJSUzI1NiIsImtpZCI6Ijk2RjNBNjU2OEFEQzY0MzZDNjVBNDg1MUQ5REM0NTlFQTlCM0I1NTQiLCJ0eXAiOiJhdCtqd3QiLCJ4NXQiOiJsdk9tVm9yY1pEYkdXa2hSMmR4Rm5xbXp0VlEifQ.eyJuYmYiOjE2ODkwODY4ODksImV4cCI6MTY4OTA5MDQ4OSwiaXNzIjoiaHR0cHM6Ly9pZC5wcmVwcm9kLmV0YS5nb3YuZWciLCJhdWQiOiJJbnZvaWNpbmdBUEkiLCJjbGllbnRfaWQiOiIwMDFkN2Y1My0wODEwLTRiOWUtYjZkMy0zYTM3ODljMjhkYzYiLCJJc1RheFJlcHJlcyI6IjEiLCJJc0ludGVybWVkaWFyeSI6IjAiLCJJbnRlcm1lZElkIjoiMCIsIkludGVybWVkUklOIjoiIiwiSW50ZXJtZWRFbmZvcmNlZCI6IjIiLCJuYW1lIjoiNTU0NjgxNDEyOjAwMWQ3ZjUzLTA4MTAtNGI5ZS1iNmQzLTNhMzc4OWMyOGRjNiIsIlNTSWQiOiIyZjY1MWEzZS1mOTA0LTgyZTctNTliNC1lMDMyMDZiNDQxNmQiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJ0YWlsb3JzLWVycCIsIlRheElkIjoiMjc4ODQ3IiwiVGF4UmluIjoiNTU0NjgxNDEyIiwiUHJvZklkIjoiMzQwMjA0IiwiSXNUYXhBZG1pbiI6IjAiLCJJc1N5c3RlbSI6IjEiLCJOYXRJZCI6IiIsIlRheFByb2ZUYWdzIjpbIkIyQiIsIkIyQyJdLCJzY29wZSI6WyJJbnZvaWNpbmdBUEkiXX0.NzPwTtVeMj-ZlUg2EQusa3lRmazT_kCgB19nCCmJ3akCoNBCN1oNfqTLME_MeNAbEoXieLIYgilHdDJHAK7M6FGqdERXcqB-smBfyq32OcONc7yVmny1U5fxVfWdSzzvgHPilU4NYFGp3bk2MUO4HoEcVPMHeVf1z0mln2BRnGdhKYxMTGppvWIscn9RB6XUUpb69h8AXtKPgVSQbjINedQdXrhmOz6Cz26cmmr6gnfphSm5_tNYZOWGCgZeuRsjOlPn0ZxWSsUCmlfYN_MYJXqF_SDOycS5MT4UTR5v7geTqc-QqM6TvT8xFlfSBAdekFCrIBV08aXeoXNNPswZeQ"
                      }
            ]
        }
    ]
}';
        echo "<pre>";
        print_r(json_decode($fullSignedFile))  ;
    }


}
