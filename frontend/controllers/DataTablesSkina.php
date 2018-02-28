<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-16 15:17:07
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-19 07:49:30
 */

namespace frontend\controllers;

use fedemotta\datatables\DataTables;

/**
* data tables skina, proyectado para administración de DataTables
*/
class DataTablesSkina extends DataTables
{
	/*public function clientOptions()
   	{
   		return $clientOptions = [

    	"info"=>false,
    	"responsive"=>true,
    	"dom"=> 'lfTrtip',
    	"tableTools"=>[
    		 "aButtons"=> [
            [
            "sExtends"=> "copy",
            "sButtonText"=> Yii::t('app', 'Copy to clipboard'),
            ],[
            "sExtends"=> "csv",
            "sButtonText"=> "Save to CSV"
            ],[
            "sExtends"=> "xls",
            "oSelectorOpts"=> ["page"=> 'current']
            ],[
            "sExtends"=> "pdf",
            "sButtonText"=> "Save to PDF"
            ],[
            "sExtends"=> "print",
            "sButtonText"=> "Print"
            ],
        ]
    	]
    ];
   	}*/

   	public $clientOptions = [

    	"info"=>false,
    	"responsive"=>true,
    	"dom"=> 'lfTrtip',
    	"tableTools"=>[
    		 "aButtons"=> [
            [
            "sExtends"=> "copy",
            "sButtonText"=> 'Copy to clipboard',
            ],[
            "sExtends"=> "csv",
            "sButtonText"=> "Save to CSV"
            ],[
            "sExtends"=> "xls",
            "oSelectorOpts"=> ["page"=> 'current']
            ],[
            "sExtends"=> "pdf",
            "sButtonText"=> "Save to PDF"
            ],[
            "sExtends"=> "print",
            "sButtonText"=> "Print"
            ],
        ]
    	]
    ];

	//public $clientOptions = $this->prueba();

}
?>