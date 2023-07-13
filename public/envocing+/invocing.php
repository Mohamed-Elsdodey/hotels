<?php

class Invocing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        if ($this->session->userdata('is_logged_in') == 0) {
          //  redirect('login');
        }
        $this->load->helper(array('url', 'text', 'permission', 'form'));
        //$this->load->model('trainers/Instructor_model');

    }


    public function invoice() //Invocing/invoice
    {


        $invoice =
            [
                "issuer" => array(
                    "address" => array(
                        "branchID" => "0",
                        "country" => "EG",
                        "governate" => '',
                        "regionCity" => '',
                        "street" => '',
                        "buildingNumber" => '',
                    ),
                    "type" => 'B',
                    "id" => 493940162,
                    "name" => 'الاثير تيك لتكنولوجيا المعلومات',
                ),

                "receiver" => array(
                    "address" => array(),
                    "type" => 'P',

                ),
                "documentType" => 'I',
                "documentTypeVersion" => "1.0",
                "dateTimeIssued" => '01-02-2023' . "T" . date("h:i:s") . "Z",
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
            $invoice['invoiceLines'][$i] = $Data;
        }

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


        $myFileToJson = fopen($_SERVER['DOCUMENT_ROOT'] . "/almgdalgaded/envocing/SourceDocumentJson.json", "w") or die("unable to open file");

        // $myFileToJson = fopen("D:\xampp\htdocs\almgdalgaded\envocing\SourceDocumentJson.json", "w") or die("unable to open file");
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

        shell_exec($_SERVER['DOCUMENT_ROOT'] . "/almgdalgaded/envocing/SubmitInvoices2.bat");
        $path = $_SERVER['DOCUMENT_ROOT'] . "/almgdalgaded/envocing/FullSignedDocument.json";
        $path2 = $_SERVER['DOCUMENT_ROOT'] . "/almgdalgaded/envocing/Cades.txt";
        $path3 = $_SERVER['DOCUMENT_ROOT'] . "/almgdalgaded/envocing/CanonicalString.txt";
        $path4 = $_SERVER['DOCUMENT_ROOT'] . "/almgdalgaded/envocing/SourceDocumentJson.json";

        $fullSignedFile = file_get_contents($path);

        echo $fullSignedFile;
        return;


        $response = Http::asForm()->post('https://id.eta.gov.eg/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => 222,
            'client_secret' => 222,
            'scope' => "InvoicingAPI",
        ]);

/*        //26.342998057121072, 43.96608484418012*/

        $invoice = Http::withHeaders([
            "Authorization" => 'Bearer ' . $response['access_token'],
            "Content-Type" => "application/json",
        ])->withBody($fullSignedFile, "application/json")->post('https://api.invoicing.eta.gov.eg/api/v1/documentsubmissions');

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


}