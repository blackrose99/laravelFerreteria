<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de todos los clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los clientes de la base de datos
        $clientes = Cliente::all();
        
        // Devolver la vista con la lista de clientes
        return view('pages.client.list', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     * Muestra un formulario para crear un nuevo cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Devolver la vista del formulario de creación de clientes
        return view('pages.client.create');
    }

    /**
     * Store a newly created resource in storage.
     * Almacena un nuevo cliente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_documento' => 'required|string|max:255',
            'documento' => 'required|string|max:255|unique:clientes',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:clientes',
        ]);

        // Crear un nuevo cliente con los datos validados
        $cliente = Cliente::create($request->all());

        // Redireccionar a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }

    /**
     * Display the specified resource.
     * Muestra un cliente específico.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        // Devolver la vista con los detalles del cliente
        return view('pages.client.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra un formulario para editar un cliente existente.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        // Devolver la vista del formulario de edición de clientes
        return view('pages.client.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     * Actualiza un cliente existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_documento' => 'required|string|max:255',
            'documento' => 'required|string|max:255|unique:clientes,documento,' . $cliente->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:clientes,correo,' . $cliente->id,
        ]);

        // Actualizar el cliente con los datos validados
        $cliente->update($request->all());

        // Redireccionar a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * Elimina un cliente específico de la base de datos.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        // Eliminar el cliente de la base de datos
        $cliente->delete();

        // Redireccionar a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
