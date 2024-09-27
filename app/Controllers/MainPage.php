<?php
/**
 *  LeHMR is a health metadata resource used to capture information regarding metadata to allow discovery.
 * This has been created by Brookeslab for which Prof Tony Brookes is the lead.
 * @author Umar Riaz
 * Created at 1/03/2021
 * Updated at 18/01/2024
 */

namespace App\Controllers;

use App\Models\UIModel;

class MainPage extends BaseController
{
    public function index()
	{
		return view('main/mainpage');
	}

    public function developing(){
        return view('underDev/dev');
    }
    public function adddataset(){

    }
    public function viewdataset(){

    }
}

?>