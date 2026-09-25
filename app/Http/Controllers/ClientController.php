<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('dashboard', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|unique:clients,dni|max:20',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'comments' => 'nullable|string',
        ]);

        Client::create($validated);

        return redirect()->route('dashboard')->with('success', 'Cliente registrado correctamente.');
    }

    public function edit(Client $client)
    {
        return view('edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:clients,dni,' . $client->id,
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'comments' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->route('dashboard')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('dashboard')->with('success', 'Cliente eliminado correctamente.');
    }

    public function exportCsv()
    {
        $clients = Client::all();
        $csv = "Nombre,DNI,Correo,Telefono,Comentarios\n";
        foreach($clients as $c) {
            $csv .= "{$c->name},{$c->dni},{$c->email},{$c->phone},\"{$c->comments}\"\n";
        }
        return response($csv)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="clientes_registro.csv"');
    }

    public function exportPdf()
    {
        $clients = Client::all();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.clients', compact('clients'));
        return $pdf->download('reporte_clientes.pdf');
    }
}
