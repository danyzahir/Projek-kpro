<?php

namespace App\Helpers;

class DropdownHelper
{
    public static function datels()
    {
        return [
            'CIREBON',
            'INDRAMAYU',
            'MAJALENGKA',
            'KUNINGAN',
            'SUBANG'
        ];
    }

    public static function stos()
    {
        return [
          
            'JBN','JWG','KAD',
            'CKC','KRA','KYM','KNG','LGJ',
            'LSR','LOS','PAB','PTR',
            'PLD','RGA','SDU','SUB','JCG',
            'PMN','PGD','KIA','CAS'
        ];
    }

    public static function mitras()
    {
        return [
            'PT UPAYA TEKNIK',
            'PT SARANA MITRA PERSADA',
            'PT LINEA',
            'PT TRIPOLA'
        ];
    }
}
