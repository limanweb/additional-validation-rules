<?php 

namespace Limanweb\ValidationRulesExt\ValidationRules;

class InternationalIdentifiersRules extends ValidationRulesPackage
{

    /**
     * List of packege validation rules
     *
     * @var array
     */
    protected $rules = [
        'bank_card_number',
        'isin',
    ];

    /**
     * bank_card_number
     */
    public function validateBankCardNumber ($attribute, $value, $parameters, $validator)
    {
        // Check for string
        if (!is_string($value)) {
            return false;
        }
        
        // Remove spaces and separators
        $value = str_replace([' ', '-'], ['', ''], $value);
        
        // Check fromat
        if (!preg_match('/^(\d{16}|\d{13})$/',$value)) {
            return false;
        }

        return $this->checkIsin($attribute, $value, $parameters, $validator);
    }

    /**
     * isin 
     */
    public function validateIsin ($attribute, $value, $parameters, $validator)
    {
        // Check for string
        if (!is_string($value)) {
            return false;
        }
        
        // Check fromat
        if (!preg_match('/^[A-Z]{2}\d{10}$/',$value)) {
            return false;
        }
        
        $a1 = (string) (ord(substr($value, 0, 1)) - ord('A') + 10);
        $a2 = (string) (ord(substr($value, 1, 1)) - ord('A') + 10);
        $value = $a1.$a2.substr($value, 2);

        return $this->checkIsin($attribute, $value, $parameters, $validator);
    }
    
    /**
     * isin check algorithm
     */
    protected function checkIsin ($attribute, $value, $parameters, $validator)
    {
        $digits = str_split($value);
        
        // Calculate and check control number
        $len = count($digits);
        $weights = [2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1];
        $sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $x = $weights[(15 - $i)] * (int) $digits[($len - 1 - $i)];
            if ($x > 9) {
                $x = $x - 9;
            }
            $sum += $x;
        }
        $controlNumber = $sum % 10;
        
        return ($controlNumber == 0);
    }
}