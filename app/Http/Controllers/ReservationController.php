<?php

namespace App\Http\Controllers;


use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ressources;
use App\Models\typeressources;
use App\Models\reservations;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    /**
     * Create a new reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function addReservation(Request $request, $id,$iduser)
    {
      
        // Validate request data
        $validatedData = $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
            'etat'=>'required',

            // Add any other validation rules you need for the reservation fields
        ]);
    
       $myuser=User::find($iduser);
       $ressource=Ressources::find($id);
        // Create new reservation
        $reservation = new Reservations();
    
        $reservation->datedebut = $validatedData['datedebut'];
     
        $reservation->datefin = $validatedData['datefin'];
   
        $reservation->etat=$validatedData['etat'];

     
        $reservation->user_id=$iduser;
  
        $reservation->demandeur=$myuser->nom;
     
        $reservation->ressource=$ressource->name;
        $reservation->ressources_id=$id;
   
        $reservation->save();

        // Return success response
        return response()->json(['reservation' => $reservation]);
    }
    /**
     * Update a reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateReservation(Request $request, $id,$idres)
    {  
        
 
        // Find reservation
        $reservation = Reservations::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        // Validate request data
        $validatedData = $request->validate([
            'datedebut' => 'required',
            'datefin' => 'required',
            'etat'=> 'required'
            // Add any other validation rules you need for the reservation fields
        ]);
       

        // Update reservation
       $res=Ressources::find($idres);
     
            $reservation->datedebut = $validatedData['datedebut'];
            $reservation->etat = $validatedData['etat'];
            $reservation->datefin = $validatedData['datefin'];
         //   $reservation->demandeur=$myuser->nom;
          $reservation->ressource=$res->name;
       
        // Set any other fields you need for the reservation
        $reservation->ressources_id=$idres;
        $reservation->save();

        // Return success response
        return response()->json(['Reservation' => $reservation]);
    }

    /**
     * Delete a reservation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteReservation($id)
    {
        // Find reservation
        $reservation = Reservations::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        // Delete reservation
        $reservation->delete();

        // Return success response
        return response()->json(['Reservation' => $reservation]);
    }

    /**
     * Find a reservation by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findReservation($id)
    {
        // Find reservation
        $reservation = Reservations::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
     
        return $reservation;
       
    }
     /**
     * findDetailsReservation by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findDetailsReservation()
    {
      
        $reservation = Reservations::all();    

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
        $ressources=Ressources::find($reservation->ressources_id);
        $type=typeRessources::find($ressources->type_id);
        $user= $reservation->user;;
      //  
      
        return response()->json([
        'id'=>$reservation->id,
        'user' => $user->nom
        ,'ressources' => $ressources->name 
        ,'etat'=>$reservation->etat
        ,'type'=>$type->nom
        ,'datedebut'=>$reservation->datedebut ,'datefin'=>$reservation->datefin
    ]);
       
    }
    public function index()
    {
        return Reservations::all();    
    }
    
}

   public function findReservationByIdUser($iduser){
   $user=User::find($iduser)
   //$reservation=Reservations::find($id)
   $reservations = Reservation::where('user_id', $userId)->get();
  return $reservations;
   }