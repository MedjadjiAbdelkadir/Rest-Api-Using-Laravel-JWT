<?php

namespace App\Traits;

Trait General{
    
    public function returnError($errNum, $msg){
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    } // End returnError function


    public function returnSuccessMessage($msg = "", $errNum = "S000"){
        return [
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg
        ];
    } // End returnSuccessMessage function

    public function returnData($key, $value, $msg = ""){
        return response()->json([
            'status' => true,
            'errNum' => "S000",
            'msg' => $msg,
            $key => $value
        ]);
    } // End returnData function


} // End GeneralTrait

?>