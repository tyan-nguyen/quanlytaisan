<?php
namespace app\modules\dungchung\models;

use Yii;
use yii\base\Model;

class Import extends Model
{
    CONST FOLDER_EXCEL_UP = '/uploads/excel/up/';
    public $file;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'required'],
            [['file'], 'file'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'file' => 'File import',
        ];
    }
    
    /**
     * kiem tra file tam upload con ton tai khong
     * @param string $file
     * @return boolean
     */
    public static function checkFileExist($file){
        $fxls = Yii::getAlias('@webroot') . Import::FOLDER_EXCEL_UP . $file;
        if(file_exists($fxls)){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * xoa file excel tam sau khi kiem tra loi hoac import thanh cong
     * @param string $file
     */
    public static function deleteFileTemp($file){
        $fxls = Yii::getAlias('@webroot') . Import::FOLDER_EXCEL_UP . $file;
        if(file_exists($fxls)){
            unlink($fxls);
        }
    }
    
    /**
     * doc file excel va tra ve $spreadsheet
     * @param string $file: ten file
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public static function readExcel($file){
        $fxls = Yii::getAlias('@webroot') . Import::FOLDER_EXCEL_UP . $file;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        //read excel data and store it into an array and return
        return $spreadsheet;
    }
    
    /**
     * lay mang du lieu tu file excel
     * @param string $file: ten file
     * @return array|mixed|string
     */
    public static function readExcelToArr($file){
        $spreadsheet = Import::readExcel($file);
        return $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    }
    
    /**
     * lay du lieu cot excel theo mot range
     * @param string $file
     * @param string $range, ex: B1:B8
     * @return array|mixed|string
     */
    public static function readExcelColsToArr($file, $range){
        $spreadsheet = Import::readExcel($file);
        return $spreadsheet->getActiveSheet()->rangeToArray($range);
    }
    
    /**
     * convert data colums range in excel to simle array
     * exam: [0=>[0=>a], 1=>[0=>b],] => [a,b,..]
     * @param array $dataArr
     * @return array
     */
    public static function convertColsToSimpleArr($dataArr){
        $list = array();
        foreach ($dataArr as $val){
            if($val[0] != null){
                $list[] = $val[0];
            }
        }
        return $list;
    }
    
    /**
     * convert data column range in excel to sql string "IN" with col name and list
     * exam: "ma_bo_phan IN ('ma1', 'ma2')"
     * @param array $dataArr
     * @param string $colInBb
     * @param bool $isNum
     * @return string
     */
   /*  public static function convertColsToSqlStr($dataArr, $colInBb, $isNum){
        $list = Import::convertColsToSimpleArr($dataArr);
        
        if(!empty($list)){
            if($isNum == true){
                $string = implode(',', $list);
                return $colInBb . ' IN (' . $string . ')';
            } else {
                $string = implode("','", $list);
                return $colInBb . " IN ('" . $string . "')";
            }
        } else 
            return '';
    } */
    
}
