<?php 

namespace Limanweb\ValidationRulesExt\ValidationRules;

class RUS_IdentifierRules extends ValidationRulesPackage
{
    
    /**
     * List of packege validation rules
     *
     * @var array
     */
    protected $rules = [
        'rus_inn',
        'rus_person_inn',
        'rus_ogrn',
        'rus_ogrnip',
        'rus_snils',
    ];
    
    /**
     * rus_inn 
     */
    public function validateRusInn ($attribute, $value, $parameters, $validator)
    {
        // Check for is a string
        if (!is_string($value)) {
            return false;
        }
        
        // Check format
        if (!preg_match('/^\d{10}$/',$value)) {
            return false;
        }
        
        // Calculate and check control number
        $digits = str_split($value);
        $weights = [2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber = $sum % 11 % 10;
        
        return ($controlNumber == $digits[9]);
    }
    
    /**
     * rus_repson_inn
     */
    public function validateRusPersonInn ($attribute, $value, $parameters, $validator)
    {
        // Check for is a string
        if (!is_string($value)) {
            return false;
        }
        
        // Check format
        if (!preg_match('/^\d{12}$/',$value)) {
            return false;
        }
        
        // Calculate control number 1
        $digits = str_split($value);
        $weights = [7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber1 = $sum % 11 % 10;
        
        // Calculate control number 2
        $weights = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber2 = $sum % 11 % 10;
        
        // Check control numbers
        return ($controlNumber1 == $digits[10] && $controlNumber2 == $digits[11]);
    }
    
    /**
     * rus_ogrnip
     */
    public function validateRusOgrnip ($attribute, $value, $parameters, $validator)
    {
        // Check for is a string
        if (!is_string($value)) {
            return false;
        }
        
        // Check format
        if (!preg_match('/^\d{15}$/',$value)) {
            return false;
        }
        
        // Calculate and check control number
        $digits = str_split($value);
        $controlNumber = ((int) substr($value, 0, 14)) % 13 % 10;
        
        return ($controlNumber == $digits[14]);
    }
    
    /**
     * rus_ogrn
     */
    public function validateRusOgrn ($attribute, $value, $parameters, $validator)
    {
        // Check for is a string
        if (!is_string($value)) {
            return false;
        }
        
        // Check format
        if (!preg_match('/^\d{13}$/',$value)) {
            return false;
        }
        
        // Calculate and check control number
        $digits = str_split($value);
        $controlNumber = ((int) substr($value, 0, 12)) % 11 % 10;
        
        return ($controlNumber == $digits[12]);
    }
    
    /**
     * rus_snils
     */
    public function validateRusSnils ($attribute, $value, $parameters, $validator)
    {
        // Check for is a string
        if (!is_string($value)) {
            return false;
        }
        
        // Check format
        if (!preg_match('/^\d{3}-\d{3}-\d{3}(-| )\d{2}$/',$value)) {
            return false;
        }
        
        $value = str_replace(['-', ' '], ['', ''], $value);
        
        // Additional checking
        if (preg_match('/(000|111|222|333|444|555|666|777|888|999)/',$value)) {
            return false;
        }
        
        // Calculate and check control number
        $digits = str_split($value);
        
        $weights = [9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        if ($sum < 100) {
            $controlNumber = $sum;
        } else if ($sum == 100 || $sum == 101) {
            $controlNumber = 0;
        } else {
            $controlNumber = $sum % 101;
        }
        
        return ($controlNumber == ((int) substr($value, 9, 2)));
    }
    
    /**
     * Custom replacer example
     */
    // public function replaceCustom ($message, $attribute, $rule, $parameters, $validator)
    // {
    //     return trans(
    //         'validation-rules-ext::validation.rule',
    //         ['attribute' => $attribute]
    //     );
    // }
    
}