<?php
namespace App\Library;
use DateTime;
class TimeLibrary
{
    public function TimeLibrary($lower = 0, $upper = 82800, $step = 3600, $format = '' )
        {
        $time_slot= array();
            
            if ( empty( $format ) ) {
                $format = 'H:i';
            }
            $lower = 0;  $upper = 82800; $step = 3600; $format = '';
            $i = 0;
            foreach ( range( $lower, $upper, $step ) as $increment ) {
                $increment = gmdate( 'H:i', $increment );
                $time_slot[$i] = $increment;
                $i++;
                
            }
          return $time_slot;
        }

        
    // public function TimeLibrary($lower = 0, $upper = 86400, $step = 3600, $format = '' )
    // {
    //     $time_slot= array();
        
    //     if ( empty( $format ) ) {
    //         $format = 'H:i';
    //     }
    //     $i = 0;
    //     foreach ( range( $lower, $upper, $step ) as $increment ) {
    //         $increment = gmdate( 'H:i', $increment );
    
    //         list( $hour, $minutes ) = explode( ':', $increment );
    
    //         $date = new DateTime( $hour . ':' . $minutes );
            
    //         $time_slot[(string) $increment] = $date->format( $format );
    //         $i++;
    //     }
    
    //     return $time_slot;
       
        
    //     // $every_60_minutes = hoursRange( 0, 86400, 60 * 60, 'H:i' );
        
        
    //     // print_r( $every_60_minutes );

    // }



}