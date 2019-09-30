<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchProperties extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $distanceScore=0;
       $budgetScore=0;
       $bedroomScore=0;
       $bathroomScore=0;
       $totalScore=0;
       $count=0;
       $properties = DB::table('properties')->get()->toArray();
       foreach ($properties as $key => $propertyValue) 
       {
         $propertyValue=json_decode(json_encode($propertyValue),true); 
         $distanceSCore = DistanceScore($request->userLatitude,$request->userLogitude,$propertyValue);
         $budgetScore = BudgetScore($request->userBudget,$propertyValue);
         $bathroomScore = BathroomScore($request->userBathroom,$propertyValue);
         $bedroomScore = BedroomScore ($request->userBathroom,$propertyValue); 
         $userRecommendation[$count]['property_score'] = ($distanceScore+$budgetScore+$bathroomScore+$bedroomScore)*100;
         $userRecommendation[$count++]['property_name'] = $Singleproperty['name'];
       }

       return $userRecommendation;

    }

    public function DistanceScore($userLatitude,$userLogitude,$Singleproperty)
    {   
        if($userLatitude == $Singleproperty['property_latitude'] && $userLongitude == $Singleproperty['property_longitude'])
        {
            $distanceScore = 0.3;
        }

        $distanceFromUser = math.sqrt(pow(($Singleproperty['property_latitude']-$userLatitude), 2)+pow(($Singleproperty['property_longitude']-$userLogitude), 2));
        if($distanceFromUser <=2)
        {
            $distanceScore = 0.3
        }
        elseif ($distanceFromUser >2 && $distanceFromUser <= 5) 
        {
            $distanceScore = 0.3 - (0.7*0.3);
        }
        elseif ($distanceFromUser >5 && $distanceFromUser <= 7) 
        {
            $distanceScore = 0.3 - (0.7*0.3);
        }

        elseif ($distanceFromUser >7 && $distanceFromUser <= 10) 
        {
            $distanceScore = 0.3 - (0.5*0.3);
        }

        elseif ($distanceFromUser >7 && $distanceFromUser <= 10) 
        {
            $distanceScore = 0.3 - (0.4*0.3);
        }

        elseif ($distanceFromUser >10) 
        {
            $distanceScore = 0;
        }

        return $distanceScore;
    }


    public function BudgetScore($userBudget,$Singleproperty)
    {
        if($Singleproperty['price']>(($userBudget['max_budget']*0.25)+$userBudget['max_budget'])){
            
            $budgetScore = 0.3-(0.75*0.3);

        }
        elseif($Singleproperty['price']>(($userBudget['max_budget']*0.5)+$userBudget['max_budget'])){

            $budgetScore = 0;
        }
        elseif ($Singleproperty['price']<=$userBudget['max_budget']) 
        {
            $budgetScore = 0.3;
        }
        return $budgetScore;
    }

    public function BathroomScore($userBathroom,$Singleproperty)
    {
        if($Singleproperty['bathroom']<($userBathroom['min']-2))
        {
            $bathroomScore = 0;
        }
        elseif ($Singleproperty['bathroom'] =($userBathroom['min']-2))  {
            
            $bathroomScore = 0.2- (0.2*0.5);
        }
        elseif ($Singleproperty['bathroom'] = ($userBathroom['min']-1)) {
            $bathroomScore = 0.2 -(0.2*0.75);
        }
        elseif ( $Singleproperty['bathroom'] >= $userBathroom['min'] ) {
            $bathroomScore = 0.2
        }

        return $bathroomScore;
    }

    public function BedroomScore($userBedroom,$Singleproperty)
    {
        if($Singleproperty['bedroom']<($userBathroom['min']-2))
        {
            $bedroomScore = 0;
        }
        elseif ($Singleproperty['bedroom'] =($userBedroom['min']-2))  {
            
            $bedroomScore = 0.2- (0.2*0.5);
        }
        elseif ($Singleproperty['bedroom'] = ($userBedroom['min']-1)) {
            $bedroomScore = 0.2 -(0.2*0.75);
        }
        elseif ( $Singleproperty['bedroom'] >= $userBedroom['min'] ) {
            $bedroomScore = 0.2
        }

        return $bedroomScore ;
    }

}
