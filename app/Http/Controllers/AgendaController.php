<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgendaResource;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::all();
        return AgendaResource::collection($agenda);
    }

    public function store(Request $request)
    {
        $request->validate([
            'agenda' => 'required|string|max:255|unique:agendas',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255'
        ]);

        $agenda = Agenda::create($request->all());

        return (new AgendaResource($agenda))->additional([
            'success' => true,
            'message' => 'Agenda created successfully'
        ]);
    }

    public function show(string $id)
    {
        $agenda = Agenda::findOrFail($id);
        return response()->json($agenda);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'agenda' => 'required|string|max:255|unique:agendas,agenda,' . $id . ',agenda',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi' => 'required|string|max:100',
            'penyelenggara' => 'required|string|max:255'
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->all());

        return (new AgendaResource($agenda))->additional([
            'success' => true,
            'message' => 'Agenda updated successfully'
        ]);
    }

    public function destroy(string $id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return (new AgendaResource($agenda))->additional([
            'success' => true,
            'message' => 'Agenda deleted successfully'
        ]);
    }

    public function exportPdf()
    {
        $agenda = Agenda::all();
        $pdf = Pdf::loadView('agenda.export_pdf', compact('agenda'));
        return $pdf->download('data-agenda-kegiatan.pdf');
    }
}
