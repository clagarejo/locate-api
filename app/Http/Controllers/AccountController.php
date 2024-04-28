<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $accounts = Account::select('accounts.*', 'users.name as user_name', 'transaction_types.name as transaction_type_name')
            ->join('users', 'accounts.user_id', '=', 'users.id')
            ->leftJoin('transactions', 'accounts.id', '=', 'transactions.account_id')
            ->leftJoin('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('accounts.is_active', 1)
            ->get();

        return response()->json($accounts);
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos del formulario
        $request->validate([
            'user_id' => 'required|integer',
            'total_amount' => 'required|numeric',
        ]);

        // Crea una nueva instancia de Account con los datos recibidos
        $account = new Account();
        $account->user_id = $request->user_id;
        $account->total_amount = $request->total_amount;
        $account->is_active = 1;
        // Otros campos que necesites asignar

        // Guarda la cuenta en la base de datos
        $account->save();

        // Inserta un registro en la tabla transactions
        DB::table('transactions')->insert([
            'account_id' => $account->id,
            'transaction_type_id' => 1,
            'amount' => $request->total_amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Devuelve una respuesta exitosa
        return response()->json(['message' => 'Cuenta creada correctamente'], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        dd($account);
        $account = Account::find($account);
        dd($account);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Obtener el valor que llega en la solicitud
        $amountToUpdate = $request->amount;
        $typeTransaction = $request->typeTransaction;

        // Obtener la cuenta según el ID
        $account = Account::findOrFail($id);

        // Actualizar el campo total_amount según el tipo de movimiento
        if ($typeTransaction == 2) {
            // Sumar el valor existente con el valor que llega
            $account->total_amount += $amountToUpdate;
        } elseif ($typeTransaction == 3) {
            // Restar el valor existente con el valor que llega
            $account->total_amount -= $amountToUpdate;
        }

        // Guardar los cambios en la base de datos
        $account->save();

        // Actualizar el campo transaction_type_id en la tabla transactions
        Transaction::insert(['account_id' => $id, 'transaction_type_id' => $typeTransaction, 'amount' => $amountToUpdate]);

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Total amount actualizado correctamente y campo transaction_type_id actualizado en la tabla transactions'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        // Buscar el usuario por su ID
        $account = Account::findOrFail($id);

        // Cambiar el valor de is_active a 2
        $account->is_active = 2;

        // Guardar los cambios en la base de datos
        $account->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Cuenta eliminado correctamente']);
    }
}
