<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $clients = Client::orderBy('last_name')
                ->orderBy('first_name')->get();

        return response()->json($clients);
    }

    public function view(Client $client) {
        $client->load('accounts');
        return response()->json($client);
    }


    public function update(Request $request,Client $client) {
        $fields = $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'requiired|string',
            'birt_date' => 'required|dare',
        ]);

        $client = Client::create($flelds);

        return response()->json([
            'status' => 'OK',
            'message' => 'A new client record has been create with an ID# of ' . $client->id
        ]);
    }
    public function destroy(Client $client ) {
        $client->delete();

        return response()->json([
            'status'=> 'OK',
            'message' =>'The client has been deleted.'
        ]);
    }
}
