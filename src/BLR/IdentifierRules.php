<?php 

namespace Limanweb\ValidationRulesExt\BLR;

class IdentifierRules extends \Limanweb\ValidationRulesExt\ValidationRulesExtensionPackage
{
    protected $rules = [
        'blr_unp',
        'blr_person_unp',
    ];

    /**
     * blr_unp
     */
    public static function validateBlrUnp ($attribute, $value, $parameters, $validator)
    {
        // Check for string
        if (!is_string($value)) {
            return false;
        }
        
        // Check fromat
        if (!preg_match('/^\d{9}$/',$value)) {
            return false;
        }
        
        // Calculate and check control number
        $digits = str_split($value);
        $weights = [29, 23, 19, 17, 13, 7, 5, 3, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber = $sum % 11 % 10;
        
        return ($controlNumber != 10 && $controlNumber == $digits[8]);
    }
    
    /**
     * blr_person_unp
     */
    public static function validateBlrPersonUnp ($attribute, $value, $parameters, $validator)
    {
        // Check for string
        if (!is_string($value)) {
            return false;
        }
        
        // Translate cyrilic symbols
        $value = str_replace(
            ['А', 'В', 'С', 'Е', 'Н', 'К', 'М', 'О', 'Р', 'Т'],
            ['A', 'B', 'C', 'E', 'H', 'K', 'M', 'O', 'P', 'T'],
            $value
        );
        
        // Check fromat
        if (!preg_match('/^[ABCEHKM]{1}[ABCEHKMOPT]{1}\d{7}$/',$value)) {
            return false;
        }
        
        // Calculate and check control number
        $digits = str_split($value);
        $weights = [29, 23, 19, 17, 13, 7, 5, 3, 0];
        $trans = [
            'A' => [10, 0], 'B' => [11, 1], 'C' => [12, 2], 'E' => [14, 3], 'H' => [17, 4],
            'K' => [20, 5], 'M' => [22, 6], 'O' => [0,  7], 'P' => [0,  8], 'T' => [0,  9],
        ];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            if ($key < 2 && isset($trans[$digit])) {
                $digit = $trans[$digit][$key];
            }
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber = $sum % 11;
        
        return ($controlNumber != 10 && $controlNumber == $digits[8]);
    }
}