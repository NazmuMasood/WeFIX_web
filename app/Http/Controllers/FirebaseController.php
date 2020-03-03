<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    public function index(){

        $factory = new Factory();

        $database = $factory->createDatabase();

        $reference = $database->getReference('pollution-tracker/reports');
    
        $reports = $reference->getValue();

        /*
         *   Get a specific report via its id
         */
        // $rid = '-Lzbohgi7ih-CdOVzFBK';
        // //Get its value
        // $tempR = $database->getReference('pollution-tracker/reports')
        //                             ->getChild($rid)->getValue();
        // //Delete that report
        // $tempRef = $database->getReference('pollution-tracker/reports')
        //                             ->getChild($rid)->orderByChild($rid)->getReference();
        // $path = $tempRef->getUri()->getPath();
        // $tempRef->remove();

        $counter = 0;
        foreach($reports as $report){
            $all_reports []= $report;
            //if($counter==0){return $report['address'];}
                $counter++;
            // foreach($report['imagesUrl'] as $imagesUrl){
            //     $all_imagesUrl []= $imagesUrl;
            // }
        }
        
        // $data []= $all_reports;
        // $data []= $all_imagesUrl;

        // $encoded = json_encode($reports);
        // $decoded = json_decode($encoded, true);
        // var_dump($decoded);
        // $msg = "";
        // foreach ( $decoded->address as $id => $address ) {
        //     $msg .= $id;
        //     var_dump($address);
        //     $msg .= '<hr />';
        // }
        // $json_reports = response()->json($all_reports); 
        // $obj2 = json_decode($json_reports,true);
        //$obj2 = json_decode(response()->json($reports),true);

        // if(array_key_exists('imagesUrl',$all_reports[1])){
        //     return ($all_reports[1]['imagesUrl']);
        // }
        // else{
        //     return "no image";
        // }

        // opening the file "data.csv" for writing 
        // $myfile = fopen("data.csv", "w"); 
        // foreach ($all_reports as $report) 
        // { 
        //     $category = $report['category'];
        //     $address = $report['address'];
        //     $extent = $report['extent'];
        //     $source = $report['source'];
        //     $postedAt = $report['postedAt'];
        //     $audiosUrl = "NA";
        //     $imagesUrl = "NA";
        //     if(array_key_exists('audiosUrl',$report)){
        //         $audiosUrl = $report['audiosUrl'];
        //     }
        //      if(array_key_exists('imagesUrl',$report)){
        //         foreach($report['imagesUrl'] as $imageUrl){
        //             if($imagesUrl != "NA"){
        //                 $imagesUrl = $imagesUrl . ';' . $imageUrl;
        //             }
        //             else{ $imagesUrl = $imageUrl; }
        //         }
        //     }
        //     $line = [$category, $address, $extent, $source, $postedAt, $audiosUrl, $imagesUrl];
        //     fputcsv($myfile, $line);
        // } 
        // fclose($myfile); 

        //return var_dump($all_reports);
        session(['reportsCount' => $counter]);
        //$anchor = 'target';
        return view('pages.reports',compact('all_reports','reports'));
        //print_r($reports);
        //$this->array_to_csv($all_reports);
    } ///---index


    public function array_to_csv( $array, $filename = "export.csv", $delimiter=";" ){
        header( 'Content-Type: application/csv' );
        header( 'Content-Disposition: attachment; filename="' . $filename . '";' );

        $handle = fopen( 'php://output', 'w' );

        // setting up column headers
        $headers = [ 'Polution Type', 'Address', 'Extent', 'Source', 'Posted At', 'Audio Url', 'Image Url'];
        fputcsv( $handle, $headers );

        // foreach ($array as $value){
        //     fputcsv($handle, $value, $delimiter);
        //     // foreach ( $array as $value ) {
        //     //     fputcsv( $handle, $value , $delimiter );
        //     // }
        // }

        fclose( $handle );

        // use exit to get rid of unexpected output afterward
        exit();
    }

    public function static_array_to_csv( $filename = 'wefix_', $delimiter=";" ){
        $filename = $filename.date('m-d-Y_H-i').'.csv';
        $factory = new Factory();
        $database = $factory->createDatabase();
        $reference = $database->getReference('pollution-tracker/reports');
        $reports = $reference->getValue();
        foreach($reports as $report){
            $all_reports []= $report;  
        }

        header( 'Content-Type: application/csv' );
        header( 'Content-Disposition: attachment; filename="' . $filename . '";' );

        $handle = fopen( 'php://output', 'w' );

        // setting up column headers
        $headers = [ 'Pollution Type', 'Address', 'Location', 'Extent', 'Source', 'Posted At', 'Audio Url', 'Image Url'];
        fputcsv( $handle, $headers );

        foreach ($all_reports as $report) 
        { 
            $category = $report['category'];
            $address = $report['address'];
            $location = $report['location']['latitude'].';'.$report['location']['longitude'];
            $extent = $report['extent'];
            $source = $report['source'];
            $postedAt = $report['postedAt'];
            $audiosUrl = "NA";
            $imagesUrl = "NA";
            if(array_key_exists('audiosUrl',$report)){
                $audiosUrl = $report['audiosUrl'];
            }
            if(array_key_exists('imagesUrl',$report)){
                foreach($report['imagesUrl'] as $imageUrl){
                    if($imagesUrl != "NA"){
                        $imagesUrl = $imagesUrl . ';' . $imageUrl;
                    }
                    else{ $imagesUrl = $imageUrl; }
                }
            }
            $line = [$category, $address, $location, $extent, $source, $postedAt, $audiosUrl, $imagesUrl];
            fputcsv($handle, $line);
        } 

        fclose( $handle );

        // use exit to get rid of unexpected output afterward
        exit();
    }

    public function delete(Request $request){
        if ( $request->has('del_ids')  ) {
            $del_ids = $request -> input('del_ids');
            $factory = new Factory();
            $database = $factory->createDatabase();
            //$tobeprinted = "";
            foreach($del_ids as $del_id){
                $reference = $database->getReference('pollution-tracker/reports');
                //Delete that report
                $tempRef = $database->getReference('pollution-tracker/reports')
                                            ->getChild($del_id)->orderByChild($del_id)->getReference();
                $tempRef->remove();
                //$tobeprinted = $tobeprinted ." ". $del_id;
            }
            //printf($tobeprinted);
            return redirect('/reports')->with('success', 'Delete successful');
        }
        else{ 
            return redirect('/reports')->with('failure', 'No row selected');
        }
    }
}
